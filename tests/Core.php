<?php
namespace pieni\core\tests\units;

require_once __DIR__.'/../src/Core.php';

class Core extends \atoum
{
	public function testSegments()
	{
		$this->
			given($this->newTestedInstance)->
			string($this->testedInstance->segments())->
			isEqualTo('-')
		;
	}

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
}
