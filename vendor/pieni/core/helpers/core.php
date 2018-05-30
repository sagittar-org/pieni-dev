<?php
function segments()
{
	\pieni\core\Core::segments();
}

function cartesian(array $array)
{
	\pieni\core\Core::cartesian($array);
}

function fallback(array $array)
{
	\pieni\core\Core::fallback($array);
}

function request(array $packages, string $segments)
{
	\pieni\core\Core::request($packages, $segments);
}

function response($vars)
{
	\pieni\core\Core::response($vars);
}
