<?php
namespace pieni\core\tests\units;

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

	public function testC()
	{
		define('pieni\core\CONFIG', ['segments' => ['language' => 'languages', 'actor' => 'actors']]);
		$this->
			array(\pieni\core\Core::c('config.segments', '\pieni\core\\'))->
			isEqualTo(['language' => 'languages', 'actor' => 'actors'])
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
		$this->
			array(\pieni\core\Core::request([
				__DIR__.'/../../../../vendor/pieni/core',
			], 'api'))->
			isEqualTo([])
		;
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
