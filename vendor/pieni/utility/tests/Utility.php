<?php
namespace pieni\utility\tests\units;

require_once __DIR__.'/../../core/src/Core.php';
require_once __DIR__.'/../src/Utility.php';

class Utility extends \atoum
{
	public function testH()
	{
		$this->
			output(function(){
				\pieni\utility\Utility::h('<>"\'');
			})->
			isEqualTo('&lt;&gt;&quot;&apos;')
		;
		$this->
			string(
				\pieni\utility\Utility::h('<>"\'', true)
			)->
			isEqualTo('&lt;&gt;&quot;&apos;')
		;
	}

	public function testHref()
	{
		$_SERVER['DOCUMENT_ROOT'] = '/var/www/html';
		$_SERVER['SCRIPT_FILENAME'] = '/var/www/html/index.php';
		define('pieni\core\CONFIG', [
			'segments' => ['language' => 'languages', 'actor' => 'actors'],
			'languages' => ['en' => []],
			'actors' => ['g' => []],
		]);
		define('pieni\core\REQUEST', ['type' => 'view', 'language' => 'en', 'actor' => 'g']);
		$this->
			given($this->newTestedInstance)->
			output(function(){
				\pieni\utility\Utility::href('member/view/1');
			})->
			isEqualTo('/member/view/1')
		;
		$this->
			given($this->newTestedInstance)->
			string(
				\pieni\utility\Utility::href('member/view/1', [], true)
			)->
			isEqualTo('/member/view/1')
		;
	}
}
