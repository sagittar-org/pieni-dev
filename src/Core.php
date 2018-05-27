<?php
namespace pieni\core;

class Core
{
	public function segments()
	{
		if (php_sapi_name() === 'cli') {
			$segments = end($GLOBALS['argv']);
		} else {
			$segments = $_SERVER['PATH_INFO'];
		}
		return $segments;
	}

	public function c(string $path, string $namespace = '')
	{
		$arr = explode('.', $path);
		$g = constant($namespace.strtoupper(array_shift($arr)));
		while (count($arr) > 0) {
			$g = $g[array_shift($arr)];
		}
		return $g;
	}

	public function cartesian(array $array)
	{
		$cartecian = [];
		foreach (array_shift($array) as $value) {
			if (count($array) > 0) {
				foreach ($this->cartesian($array) as $child) {
					$cartesian[] = array_merge([$value], $child);
				}
			} else {
				$cartesian[] = [$value];
			}
		}
		return $cartesian;
	}

	public function fallback(array $array)
	{
		foreach ($this->cartesian($array) as $cartesian) {
			$fallback = implode('/', $cartesian);
			if (file_exists($fallback)) {
				return realpath($fallback);
			}
		}
		return null;
	}

	public function request(array $packages, string $segments)
	{
		define('CONFIG', json_decode(file_get_contents($this->fallback([$packages, ['config'], ['core.json']])), true));
		return [];
	}
}
