<?php

require_once dirname(__DIR__) . "/vendor/autoload.php";

use Controller\UserController;

$login = $_POST['login'];
$password = $_POST['password'];

if($login != '' && $password != '')
{
    $userController = new UserController();
    $userController->registration($login, $password);
}

header("LOCATION: " . 'http' . '://' . $_SERVER['HTTP_HOST'] . '/');