<?php

require_once('vendor/autoload.php');

use CodingAvenue\Proof\SQL;

$sql = new SQL('./code');

$op = $sql->find('where[operator="between"]');
$re = $op->find('filter[type="range", start="2010-01-01", end="2010-12-30"]');
