<?php
require_once __DIR__.'/vendor/pieni/sync/src/Driver.php';
require_once __DIR__.'/vendor/pieni/sync/src/Json.php';
require_once __DIR__.'/vendor/pieni/sync/src/Handler.php';
require_once __DIR__.'/vendor/pieni/core/src/Config.php';

require_once __DIR__.'/vendor/pieni/core/src/Core.php';
require_once __DIR__.'/vendor/pieni/utility/src/Utility.php';

\pieni\core\Core::response(
	\pieni\core\Core::request(
		[
			__DIR__.'/application',
			__DIR__.'/vendor/pieni/site',
			__DIR__.'/vendor/pieni/utility',
			__DIR__.'/vendor/pieni/core',
		],
		\pieni\core\Core::segments()
	)
);
