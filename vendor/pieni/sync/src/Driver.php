<?php
namespace pieni\sync;

class Driver
{
	public function __construct(array $params = []);
	public function mtime(string $name = '');
	public function get(string $name = '');
	public function put(array $data, int $mtime, string $name = '');
}
