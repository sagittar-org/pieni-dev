<?php
namespace pieni\sync\tests\units;

require_once __DIR__.'/../../sync/src/Driver.php';

class Driver extends \atoum
{
	public function testGet()
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
}
