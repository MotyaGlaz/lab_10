<?php

namespace Repository;

use Model\BD\UserBD;

class UserRepository{

    private array $users;
    private UserBD $userBD;

    public function __construct()
    {
        $this->userBD = new UserBD();
        $this->users = $this->userBD->getAll();
    }

    // Добавление записис
    public function add($login, $password)
    {
        $this->userBD->add($login, $password);
        $this->users = $this->userBD->getAll();
    }

    // Получение массива записей
    public function getAll(): array
    {
        return $this->users;
    }

    // Получение записи по ID
    public function getById($user_id): array
    {
        foreach ($this->users as $user)
                if($user->user_id == $user_id)
                    return array($user);
        return array();
    }

    // Поучение записи по login
    public function getByLogin($login): array
    {
        foreach ($this->users as $user)
            if ($user->login = $login)
                return array($user);
        return array();
    }

    // Удаление записи по Id
    public function deleteById($user_id)
    {
        $this->userBD->deleteById($user_id);
        $this->users = $this->userBD->getAll();
    }
}