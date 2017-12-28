<?php

require_once "base.php";

use Db\Mysql;
use DB\Mdb;

$mysql = new Mysql();
$sql = "select * from city limit 10";
print_r($mysql->queryFetchAssoc($sql));

