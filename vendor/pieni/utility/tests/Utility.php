<?php
namespace pieni\utility\tests\units;

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
		$this->
			given($this->newTestedInstance)->
			output(function(){
				$this->testedInstance->href('member/view/1');
			})->
			isEqualTo('member/view/1')
		;
	}
}
