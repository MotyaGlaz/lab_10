<?php

require_once dirname(__DIR__) . "/vendor/autoload.php";

use Controller\UserController;
Use Model\BD\UserBD;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(dirname(__DIR__) . "/templates/");
$twig = new Environment($loader);
$userController = new UserController($twig);

if(!$userController->check())
{
    $userController->__invokeMenuLog();
}else
{
    $user = new UserBD();
    $userController->__invokeMain($user->getAll(), $userController->getLogin());
}

header("LOCATION: " . 'http' . '://' . $_SERVER['HTTP_HOST'] . '/');