<?php

namespace Coded;

use Model\Entity\User;
use Repository\UserRepository;

class CodedUser
{
    private const COOKIE = 'user';
    private const CIPHER = '14Rsad48Asd9gf3';

    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function check(): bool
    {
        if ($this->getLogin() != '') {
            $userCookie = $_COOKIE[self::COOKIE];
            $cookie = explode(':', $userCookie);
            $userPassword = $this->userRepository->getByLogin($cookie[0])->getPassword();
            $codedPassword = $cookie[1];
            return $userPassword == $codedPassword;
        }
        else return false;
    }

    public function getLogin()
    {
        $userCookie = $_COOKIE[self::COOKIE];
        $cookie = explode(':', $userCookie);
        return $cookie[0];
    }

    public function login($login, $password)
    {
        $codedPassword = sha1($password . self::CIPHER);
        $userPassword = $this->userRepository->getByLogin("login", $login)[0]->getPassword();
        if ($userPassword == $codedPassword) {
            setcookie(self::COOKIE, $login . ':' . $codedPassword, mktime() . (time() + 60 * 60 * 24), '/');
        }
    }

    public function registration($login, $password)
    {
        $codedPassword = sha1($password . self::CIPHER);
        setcookie(self::COOKIE, $login . ':' . $codedPassword, mktime() . (time() + 60 * 60 * 24), '/');
        $this->userRepository->add($login, $password);
    }

    public function logout()
    {
        setcookie(self::COOKIE, null, -1, '/');
    }
}