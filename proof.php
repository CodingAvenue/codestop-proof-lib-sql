<?php

require_once('vendor/autoload.php');

use CodingAvenue\Proof\SQL;

$sql = new SQL('./code');

$ins = $sql->find('INSERT');
print_r($ins);
