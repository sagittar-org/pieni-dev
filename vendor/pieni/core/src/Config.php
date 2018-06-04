<?php
namespace pieni\core;

class Config implements \pieni\sync\Driver
{
	public static $columns = [
		'segments' => ['value'],
		'languages' => [],
		'actors' => [],
	];

	public function __construct(array $params = [])
	{
	}

	public function mtime(string $name = '')
	{
		return 0;
	}

	public function get(string $name = '')
	{
		return [
			'segments' => [
				'language' => ['value' => 'languages'],
				'actor' => ['value' => 'actors'],
			],
			'languages' => [
				'en' => [],
			],
			'actors' => [
				'g' => [],
			],
		];
	}

	public function put(array $data, int $mtime, string $name = '')
	{
	}
}
