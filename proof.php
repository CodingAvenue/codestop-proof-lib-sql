<?php

require_once('vendor/autoload.php');

use CodingAvenue\Proof\SQL;

$sql = new SQL('./code');

$select = $sql->find('where[operator="between"]');
$bet = $select->find('filter[type="column", value="basr"]');
print_r($bet);
