<?php
namespace pieni\core;

class Core
{
	public static function segments()
	{
		return isset($_SERVER['argv']) ? end($_SERVER['argv']) : $_SERVER['PATH_INFO'];
	}

	public static function c(string $path, string $namespace = '')
	{
		$arr = explode('.', $path);
		if ($namespace === '') {
			$namespace = __NAMESPACE__;
		}
		if ($namespace !== '') {
			$namespace .= '\\';
		}
		$c = constant('\\'.$namespace.strtoupper(array_shift($arr)));
		while (count($arr) > 0) {
			$c = $c[array_shift($arr)];
		}
		return $c;
	}

	public static function cartesian(array $array)
	{
		$cartecian = [];
		foreach (array_shift($array) as $value) {
			if (count($array) > 0) {
				foreach (self::cartesian($array) as $child) {
					$cartesian[] = array_merge([$value], $child);
				}
			} else {
				$cartesian[] = [$value];
			}
		}
		return $cartesian;
	}

	public static function fallback(array $array)
	{
		foreach (self::cartesian($array) as $cartesian) {
			$fallback = implode('/', $cartesian);
			if (file_exists($fallback)) {
				return realpath($fallback);
			}
		}
		return null;
	}

	public static function request(array $packages, string $segments)
	{
		define(__NAMESPACE__.'\FCPATH', realpath(__DIR__.'/../../../..'));
		define(__NAMESPACE__.'\PACKAGES', $packages);
		define(__NAMESPACE__.'\CONFIG', json_decode(file_get_contents(self::fallback([$packages, ['config.json']])), true));
		$trimed = trim($segments, '/');
		$params = $trimed !== '' ? explode('/', $trimed) : [];
		$request['type'] = isset($params[0]) && in_array($params[0], ['api']) ? array_shift($params) : 'view';
		foreach (self::c('config.segments') as $key => $value) {
			$request[$key] = isset($params[0]) && in_array($params[0], array_slice(array_keys(self::c("config.{$value['value']}")), 1)) ? array_shift($params) : array_keys(self::c("config.{$value['value']}"))[0];
		}
		$request['class'] = isset($params[0]) ? array_shift($params) : 'welcome';
		$request['method'] = isset($params[0]) ? array_shift($params) : 'index';
		$request['params'] = $params;
		define(__NAMESPACE__.'\REQUEST', $request);
		$class_name = ucfirst(self::c('request.class'));
		$namespace = '';
		$fallback = self::fallback([self::c('packages'), ['controllers'], ["{$class_name}.php"]]);
		if (preg_match('#^'.self::c('fcpath').'/vendor/#', $fallback)) {
			$namespace = str_replace('/', '\\', preg_replace('#^'.self::c('fcpath').'/vendor/#', '', dirname(dirname($fallback))));
		}
		$class_name_with_namespace = $namespace.'\\'.$class_name;
		require_once self::fallback([self::c('packages'), ['controllers'], ["{$class_name}.php"]]);
		$controller = new $class_name_with_namespace();
		return call_user_func_array([$controller, self::c('request.method')], self::c('request.params'));
	}

	public static function response($vars)
	{
		if (self::c('request.type') === 'api') {
			echo json_encode($vars, JSON_PRETTY_PRINT)."\n";
			return;
		}
		require_once self::fallback([self::c('packages'), ['views'], [self::c('request.class'), ''], ['response.php']]);
	}
}
