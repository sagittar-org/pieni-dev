<?php
namespace pieni\core;

class FallbackSync implements \pieni\sync\Driver
{
	public function __construct(array $params = [])
	{
		$this->array = $params['array'];
	}

	public function mtime(string $name = '')
	{
		return 0;
	}

	public function get(string $name = '')
	{
		return json_decode(file_get_contents(Core::fallback($this->array)), true);
	}

	public function put(array $data, int $mtime, string $name = '')
	{
	}
}
