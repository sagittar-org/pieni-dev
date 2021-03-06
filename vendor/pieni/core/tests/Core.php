<?php
namespace pieni\core\tests\units;

require_once __DIR__.'/../../sync/src/Driver.php';
require_once __DIR__.'/../../sync/src/Json.php';
require_once __DIR__.'/../../sync/src/Handler.php';
require_once __DIR__.'/../src/FallbackSync.php';
require_once __DIR__.'/../src/Config.php';
require_once __DIR__.'/../src/Core.php';

class Core extends \atoum
{
	public function testSegments()
	{
		unset($_SERVER['argv']);
		$_SERVER['PATH_INFO'] = 'member/view/1';
		$this->
			string(\pieni\core\Core::segments())->
			isEqualTo('member/view/1')
		;
		$_SERVER['argv'] = ['member/view/2'];
		$this->
			string(\pieni\core\Core::segments())->
			isEqualTo('member/view/2')
		;
	}

	public function testCartesian()
	{
		$this->
			array(\pieni\core\Core::cartesian([
				['a', 'b'],
				['x', 'y', 'z'],
				['i'],
			]))->
			isEqualTo([
				['a', 'x', 'i'],
				['a', 'y', 'i'],
				['a', 'z', 'i'],
				['b', 'x', 'i'],
				['b', 'y', 'i'],
				['b', 'z', 'i'],
			])
		;
	}

	public function testFallback()
	{
		$this->
			string(\pieni\core\Core::fallback([
				[__DIR__.'/../'],
				['src', 'tests', ''],
				['composer.json'],
			]))->
			isEqualTo(realpath(__DIR__.'/../composer.json'))
		;
	}

	public function testRequest()
	{
		shell_exec('rm -r '.__DIR__.'/../../../../application');
		$this->
			array(\pieni\core\Core::request([
				__DIR__.'/../../../../vendor/pieni/core',
			], 'api'))->
			isEqualTo([])
		;
		shell_exec('rm -r '.__DIR__.'/../../../../application');
	}

	public function testResponse()
	{
		$this->
			output(function(){
				\pieni\core\Core::response(\pieni\core\Core::request([
					__DIR__.'/../../../../vendor/pieni/core',
				], 'api'));
			})->
			isEqualTo("[]\n")
		;
	}
}
