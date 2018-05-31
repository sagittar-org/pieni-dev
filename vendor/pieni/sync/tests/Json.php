<?php
namespace pieni\sync\tests\units;

require_once __DIR__.'/../../sync/src/Driver.php';
require_once __DIR__.'/../../sync/src/Json.php';

class Json extends \atoum
{
	public function testMtime()
	{
		$this->
			given($this->newTestedInstance(['path' => __DIR__.'/../../../../sync']))->
			if(
				$this->testedInstance->put(['hoge' => 'HOGE'], 123, 'test')
			)->
			integer(
				$this->testedInstance->mtime('test')
			)->
			isEqualTo(123)
		;
		shell_exec('rm -r '.__DIR__.'/../../../../sync');
	}

	public function testGet()
	{
		$data = ['hoge' => 'HOGE'];
		$this->
			given($this->newTestedInstance(['path' => __DIR__.'/../../../../sync']))->
			if(
				$this->testedInstance->put($data, 123, 'test')
			)->
			array(
				$this->testedInstance->get('test')
			)->
			isEqualTo($data)
		;
		shell_exec('rm -r '.__DIR__.'/../../../../sync');
	}
}
