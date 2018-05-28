<?php
namespace pieni\core\tests\units;

require_once __DIR__.'/../src/Core.php';

class Core extends \atoum
{
	public function testCartesian()
	{
		$this->
			given($this->newTestedInstance)->
			array($this->testedInstance->cartesian([
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
		define('CONFIG', ['segments' => ['language' => 'languages', 'actor' => 'actors']]);
		$this->
			given($this->newTestedInstance)->
			array($this->testedInstance->c('config.segments'))->
			isEqualTo(['language' => 'languages', 'actor' => 'actors'])
		;
	}

	public function testFallback()
	{
		$this->
			given($this->newTestedInstance)->
			string($this->testedInstance->fallback([
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
			given($this->newTestedInstance)->
			array($this->testedInstance->request([
				__DIR__.'/../../../../vendor/pieni/core',
			], 'api'))->
			isEqualTo([])
		;
	}

	public function testResponse()
	{
		$this->
			given($this->newTestedInstance)->
			output(function(){
				$this->testedInstance->response($this->testedInstance->request([
					__DIR__.'/../../../../vendor/pieni/core',
				], 'api'));
			})->
			isEqualTo("[]\n")
		;
	}
}
