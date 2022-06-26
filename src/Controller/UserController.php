<?php

namespace Controller;

use Twig\Environment;


class UserController
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invokeMenuLog()
    {
        echo $this->twig->render('menuLog.html.twig');
    }

    public function __invokeMain($result, $login)
    {
        echo $this->twig->render('main.html.twig',['t' => $result, 'login' => $login]);
    }
}
