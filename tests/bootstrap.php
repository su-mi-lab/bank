<?php

require_once __DIR__ . "/../vendor/autoload.php";

require_once 'Bank/TestCase.php';
require_once 'Bank/Mysql.php';
require_once 'Bank/ORM/User.php';
require_once 'Bank/ORM/UserMapper.php';
require_once 'Bank/ORM/UserRecord.php';

\Bank\Bank::setConfig(include __DIR__ . '/Bank/config/bank.php');