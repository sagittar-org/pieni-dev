<?php
namespace pieni\utility;

class Utility
{
	public static function h(string $str, bool $return = false)
	{
		$h = htmlentities($str, ENT_QUOTES | ENT_HTML5);
		if ($return === true) {
			return $h;
		}
		echo $h;
	}

	public static function href(string $path, array $params = [], bool $return = false)
	{
		$segments = [];
		$segments['type'] = isset($params['type']) ? $params['type'] : \pieni\core\REQUEST['type'];
		if ($segments['type'] === 'view') {
			$segments['type'] = '';
		}
		foreach (\pieni\core\CONFIG['segments'] as $key => $value)
		{
			$segments[$key] = isset($params[$key]) ? $params[$key] : \pieni\core\REQUEST[$key];
			if ($segments[$key] === array_keys(\pieni\core\CONFIG[$value['value']])[0]) {
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

	public static function pub(string $path, bool $return = false)
	{
		$url = preg_replace('#^'.\pieni\core\FCPATH.'/#', '', \pieni\core\Core::fallback([\pieni\core\PACKAGES, ["public/{$path}"]]));
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

	public static function loadView(string $path, array $vars = [], string $indent = '', bool $return = false)
	{
		ob_start();
		require \pieni\core\Core::fallback([\pieni\core\PACKAGES, ['views'], [\pieni\core\REQUEST['class'], ''], ["{$path}.php"]]);
		$result = $indent.str_replace("\n", "\n{$indent}", trim(ob_get_clean()))."\n";
		if ($return === true) {
			return $result;
		}
		echo $result;
	}
}
