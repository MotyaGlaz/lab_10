<?php

namespace Model\Entity;

use PDO;

class User{

    public int $user_id;
    public string $login;
    public string $password;
}