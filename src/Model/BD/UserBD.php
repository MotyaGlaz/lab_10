<?php

namespace Model\BD;

use Model\Entity\User;
use PDO;

class UserBD{

    private PDO $connection;

    public function __construct()
    {
        $this->connection = new  PDO('mysql:host=localhost;dblogin=user', 'admin', '12345672');
    }

    public function convertToUser($result): User
    {
        $user = new User();
        $user->user_id = $result['user_id'];
        $user->login = $result['login'];
        $user->password = $result['password'];
        return $user;
    }

    // Получение всех записей
    public function getAll(): array
    {
        $query = 'SELECT * from user';
        $sql = $this->connection->prepare($query);
        $sql->execute();
        $results = $sql->fetchAll();
        $func = fn($x) => self::convertToUser($x);
        return array_map($func, $results);
    }

    // Добавление записи
    public function add($login, $password){
        $query = 'INSERT INTO `lab_10`.`user` (`login`, `password`) VALUES (:login, :password);';
        $sql = $this->connection->prepare($query);
        $sql->bindParam('login', $login,PDO::PARAM_STR);
        $sql->bindParam('password', $password,PDO::PARAM_STR);
        $sql->execute();
    }

    // Получение записи по ID
    public function getById($user_id)
    {
        $query = 'SELECT * from user WHERE user_id=:id';
        $sql = $this->connection->prepare($query);
        $sql->bindParam('user_id', $user_id,PDO::PARAM_INT);
        $sql->execute();
        return $sql->fetchAll();
    }

    // Получение записи по login
    public function getByLogin($login)
    {
        $query = 'SELECT * from user WHERE login=:login';
        $sql = $this->connection->prepare($query);
        $sql->bindParam('login', $login,PDO::PARAM_STR);
        $sql->execute();
        return $sql->fetchAll();
    }

    // Удаление записи по ID
    public function deleteById($user_id)
    {
        $query = 'DELETE FROM `lab_10`.`user` WHERE user_id=:user_id;';
        $sql = $this->connection->prepare($query);
        $sql->bindParam('id', $id,PDO::PARAM_INT);
        $sql->execute();
    }
}