<?php
namespace pieni\core;

class Config extends FallbackSync
{
	public static $columns = [
		'segments' => ['value'],
		'languages' => [],
		'actors' => [],
	];
}
