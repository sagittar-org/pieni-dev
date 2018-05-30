<?php
function h(string $str, bool $return = false)
{
	return \pieni\utility\Utility::h($str, $return);
}

function href(string $path, array $params = [], bool $return = false)
{
	return \pieni\utility\Utility::href($path, $params, $return);
}

function pub(string $path, bool $return = false)
{
	return \pieni\utility\Utility::pub($path, $return);
}

function load_view(string $path, array $vars = [], string $indent = '', bool $return = false)
{
	return \pieni\utility\Utility::loadView($path, $vars, $indent, $return);
}
