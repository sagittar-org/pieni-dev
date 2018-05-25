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
			isEqualTo('hoge')
		;
	}
}
