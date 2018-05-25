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
}
