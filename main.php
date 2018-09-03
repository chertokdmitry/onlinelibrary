<?php

error_reporting(-1);

define('ROOT', dirname(__FILE__).'/');
define('IDEAL',dirname(__FILE__).'/ideal/');
define('APP',dirname(__FILE__).'/application/');
include IDEAL.'framework.php';
include IDEAL.'functions.php';

App::gi()->start();
