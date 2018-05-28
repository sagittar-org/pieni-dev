<?php
namespace pieni\utility;

class Utility
{
	public function h($str, $return = false)
	{
		$h = htmlentities($str, ENT_QUOTES | ENT_HTML5);
		if ($return === true) {
			return $h;
		}
		echo $h;
	}

	public function href($path, $params = [], $return = false)
	{
		$type = isset($params['type']) ? $params['type'] : g('req')->type;
		$language = isset($params['language']) ? $params['language'] : g('req')->language;
		$actor = isset($params['actor']) ? $params['actor'] : g('req')->actor;
		if ($type === 'view') {
			$type = '';
		}
		if ($language === array_keys(g('config')['languages'])[0]) {
			$language = '';
		}
		if ($actor === array_keys(g('config')['actors'])[0]) {
			$actor = '';
		}
		$path = implode('/', [$type, $language, $actor, $path]);
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

	public function pub($path, $return = false)
	{
		$url = preg_replace('#^'.FCPATH.'/#', '', Core::fallback([Core::g('packages'), ["public/{$path}"]]));
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
