<?php
namespace pieni\utility;

class Utility
{
	public static function h($str, $return = false)
	{
		$h = htmlentities($str, ENT_QUOTES | ENT_HTML5);
		if ($return === true) {
			return $h;
		}
		echo $h;
	}

	public static function href($path, $params = [], $return = false)
	{
		$segments = [];
		$segments['type'] = isset($params['type']) ? $params['type'] : \pieni\core\Core::c('request.type');
		if ($segments['type'] === 'view') {
			$segments['type'] = '';
		}
		foreach (\pieni\core\Core::c('config.segments') as $key => $value)
		{
			$segments[$key] = isset($params[$key]) ? $params[$key] : \pieni\core\Core::c("request.{$key}");
			if ($segments[$key] === array_keys(\pieni\core\Core::c("config.{$value['value']}"))[0]) {
				$segments[$key] = '';
			}
		}
		$path = implode('/', $segments)."/{$path}";
		$url = '/'.trim(
			preg_replace('/index.php$/', '',
				preg_replace("#^{$_SERVER['DOCUMENT_ROOT']}#", '', $_SERVER['SCRIPT_FILENAME'])
			),'/'
		)."/{$path}";
		$url = preg_replace('#/+#', '/', $url);
		if ($return === true) {
			return $url;
		}
		echo $url;
	}

	public static function pub($path, $return = false)
	{
		$url = preg_replace('#^'.\pieni\core\Core::c('fcpath').'/#', '', \pieni\core\Core::fallback([\pieni\core\Core::c('packages'), ["public/{$path}"]]));
		$package = preg_replace('#/public/.*#', '', $url);
		@mkdir('public/'.dirname($package), 0755, true);
		@symlink(str_repeat('../', substr_count($package, '/') + 1)."{$package}/public", "public/{$package}");
		$url = '/'.trim(
			preg_replace('/index.php$/', '',
				preg_replace("#^{$_SERVER['DOCUMENT_ROOT']}#", '', $_SERVER['SCRIPT_FILENAME'])
			),'/'
		).'/public/'.preg_replace('#public/#', '', $url);
		$url = preg_replace('#/+#', '/', $url);
		if ($return === true) {
			return $url;
		}
		echo $url;
	}
}
