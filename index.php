<?php
require_once __DIR__.'/vendor/pieni/core/src/Core.php';

$core = new \pieni\core\Core();
$core->response(
	$core->request(
		[
			__DIR__.'/application',
			__DIR__.'/vendor/pieni/core',
		],
		$core->segments()
	)
);
