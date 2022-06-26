<?php

require_once dirname(__DIR__) . "/vendor/autoload.php";

use Controller\UserController;

$userController = new UserController();
$userController->logout();

header("LOCATION: " . 'http' . '://' . $_SERVER['HTTP_HOST'] . '/');