<?php
require_once 'src/Core.php';

$core = new \pieni\core\Core();

define('CONFIG', ['segments' => ['language' => 'languages', 'actor' => 'actors']]);
print_r($core->c('config'));
