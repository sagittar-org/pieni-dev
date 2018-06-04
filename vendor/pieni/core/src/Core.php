<?php
namespace pieni\core;

class Core
{
	public static function segments()
	{
		return isset($_SERVER['argv']) ? end($_SERVER['argv']) : $_SERVER['PATH_INFO'];
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
		define(__NAMESPACE__.'\CONFIG', json_decode(file_get_contents(self::fallback([$packages, ['config/pieni_core.json']])), true));

$config_handler = new \pieni\sync\Handler([
	new \pieni\sync\Json(['path' => FCPATH.'/application/config']),
	new Config(),
]);
$config_handler->get('pieni_core');

		$trimed = trim($segments, '/');
		$params = $trimed !== '' ? explode('/', $trimed) : [];
		$request['type'] = isset($params[0]) && in_array($params[0], ['api']) ? array_shift($params) : 'view';
		foreach (\pieni\core\CONFIG['segments'] as $key => $value) {
			$request[$key] = isset($params[0]) && in_array($params[0], array_slice(array_keys(\pieni\core\CONFIG[$value['value']]), 1)) ? array_shift($params) : array_keys(\pieni\core\CONFIG[$value['value']])[0];
		}
		$request['class'] = isset($params[0]) ? array_shift($params) : 'welcome';
		$request['method'] = isset($params[0]) ? array_shift($params) : 'index';
		$request['params'] = $params;
		define(__NAMESPACE__.'\REQUEST', $request);
		$class_name = ucfirst(\pieni\core\REQUEST['class']);
		$namespace = '';
		$fallback = self::fallback([\pieni\core\PACKAGES, ['controllers'], ["{$class_name}.php"]]);
		if (preg_match('#^'.\pieni\core\FCPATH.'/vendor/#', $fallback)) {
			$namespace = str_replace('/', '\\', preg_replace('#^'.\pieni\core\FCPATH.'/vendor/#', '', dirname(dirname($fallback))));
		}
		$class_name_with_namespace = $namespace.'\\'.$class_name;
		require_once self::fallback([\pieni\core\PACKAGES, ['controllers'], ["{$class_name}.php"]]);
		$controller = new $class_name_with_namespace();
		return call_user_func_array([$controller, \pieni\core\REQUEST['method']], \pieni\core\REQUEST['params']);
	}

	public static function response($vars)
	{
		if ($vars === null) {
			$vars = [];
		}
		if (\pieni\core\REQUEST['type'] === 'api') {
			echo json_encode($vars, JSON_PRETTY_PRINT)."\n";
			return;
		}
		require_once self::fallback([\pieni\core\PACKAGES, ['views'], [\pieni\core\REQUEST['class'], ''], ['response.php']]);
	}
}
