<?php
require_once 'src/Core.php';

$core = new \pieni\core\Core();
print_r($core->cartesian([['a', 'b'], ['x', 'y', 'z'], ['i']]));
