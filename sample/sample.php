<?php
require_once __DIR__ . "/../vendor/autoload.php";


use Bank\Adapter;

$adapter = new Adapter('mysql:host=localhost;dbname=bank;charset=utf8', 'root', '');
$conn = $adapter->getDriver()->getConnection();
$select = $adapter->getSql()->getSelect();
$select->from('users');

$res = \Bank\Repo::findAll($conn, $select);

echo __CLASS__ . ":" . __line__;
print'<pre>';
var_dump($res);
print'</pre>';
exit;