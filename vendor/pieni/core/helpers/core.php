<?php
function segments()
{
	return \pieni\core\Core::segments();
}

function cartesian(array $array)
{
	return \pieni\core\Core::cartesian($array);
}

function fallback(array $array)
{
	return \pieni\core\Core::fallback($array);
}

function request(array $packages, string $segments)
{
	return \pieni\core\Core::request($packages, $segments);
}

function response($vars)
{
	return \pieni\core\Core::response($vars);
}
