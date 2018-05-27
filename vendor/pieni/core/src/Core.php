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
		$c = constant($namespace.strtoupper(array_shift($arr)));
		while (count($arr) > 0) {
			$c = $c[array_shift($arr)];
		}
		return $c;
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
		define('FCPATH', realpath(__DIR__.'/../../../..'));
		define('PACKAGES', $packages);
		define('CONFIG', json_decode(file_get_contents($this->fallback([$packages, ['config.json']])), true));
		$trimed = trim($segments, '/');
		$params = $trimed !== '' ? explode('/', $trimed) : [];
		$request['type'] = isset($params[0]) && in_array($params[0], ['api']) ? array_shift($params) : 'view';
		foreach ($this->c('config.segments') as $key => $value) {
			$request[$key] = isset($params[0]) && in_array($params[0], array_slice(array_keys($this->c("config.{$value['value']}")), 1)) ? array_shift($params) : array_keys($this->c("config.{$value['value']}"))[0];
		}
		$request['class'] = isset($params[0]) ? array_shift($params) : 'welcome';
		$request['method'] = isset($params[0]) ? array_shift($params) : 'index';
		$request['params'] = $params;
		define('REQUEST', $request);
		$class_name = ucfirst($this->c('request.class'));
		$namespace = '';
		$fallback = $this->fallback([$this->c('packages'), ['controllers'], ["{$class_name}.php"]]);
		if (preg_match('#^'.$this->c('fcpath').'/vendor/#', $fallback)) {
			$namespace = str_replace('/', '\\', preg_replace('#^'.$this->c('fcpath').'/vendor/#', '', dirname(dirname($fallback))));
		}
		$class_name_with_namespace = $namespace.'\\'.$class_name;
		require_once $this->fallback([$this->c('packages'), ['controllers'], ["{$class_name}.php"]]);
		$controller = new $class_name_with_namespace();
		return call_user_func_array([$controller, $this->c('request.method')], $this->c('request.params'));
	}

	public function response($vars)
	{
		if ($this->c('request.type') === 'api') {
			return json_encode($vars, JSON_PRETTY_PRINT)."\n";
			exit(0);
		}
		require_once $this->fallback([$this->c('packages'), ['views'], [$this->c('request.class'), ''], ['response.php']]);
	}
}
