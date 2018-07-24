<?php

require_once('vendor/autoload.php');

use CodingAvenue\Proof\SQL;

$sql = new SQL('./code');

$insert = $sql->find('INSERT[table="employee_records"]');
print_r($sql);
