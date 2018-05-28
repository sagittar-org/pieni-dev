<?php
namespace pieni\utility\tests\units;

require_once __DIR__.'/../src/Utility.php';

class Utility extends \atoum
{
	public function testH()
	{
		$this->
			given($this->newTestedInstance)->
			output(function(){
				$this->testedInstance->h('<>"\'');
			})->
			isEqualTo('&lt;&gt;&quot;&apos;')
		;
		$this->
			given($this->newTestedInstance)->
			string(
				$this->testedInstance->h('<>"\'', true)
			)->
			isEqualTo('&lt;&gt;&quot;&apos;')
		;
	}
}
