<?php

require_once __DIR__ . "/../vendor/autoload.php";

require_once 'Bank/TestCase.php';
require_once 'Bank/Mysql.php';
require_once 'Bank/Model/User.php';
require_once 'Bank/Model/UserMapper.php';
require_once 'Bank/Model/UserRecord.php';

\Bank\Bank::setConfig(include __DIR__ . '/Bank/config/bank.php');