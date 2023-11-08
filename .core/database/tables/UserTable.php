<?php

class UserTable {

    private $pdo;
    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function create($login, $password_hash){
        $query = $this->pdo->prepare("INSERT INTO `users`(login, password) VALUES(:login, :password)");
        $executed = $query->execute([':login' => $login, ':password' => $password_hash]);
        if(!$executed){
            throw new PDOException();
        }
    }

    public function getId($login, $password){
        $query = $this->pdo->prepare("SELECT id, password FROM `users` WHERE login = :login LIMIT 1");
        $query->bindParam(':login', $login);
        $query->execute();
        $user = $query->fetch();
        if(!password_verify($password, $user["password"])){
            return null;
        }
        unset($user["password"]);
        return $user;
    }

    public function getByToken($token){
        $query = $this->pdo->prepare("SELECT `users`.* FROM `users` JOIN `sessions` ON `users`.id = `sessions`.user_id WHERE `sessions`.token=:session_token");
        $query->bindParam(':session_token', $token);
        $query->execute();
        $user = $query->fetch();
        unset($user["password"]);
        return $user;
    }

    public function createSessionToken($id){
        $token = md5(uniqid(rand(), TRUE));
        $query = $this->pdo->prepare("INSERT INTO `sessions`(user_id, token, created_at, expires_at) VALUES(:user_id, :token, NOW(), NOW()+INTERVAL 1 HOUR)");
        $query->bindParam(':user_id', $id);
        $query->bindParam(':token', $token);
        $executed = $query->execute();
        if(!$executed){
            throw new PDOException();
        }
        return $token;
    }

    public function checkLoginExist($login){
        $query = $this->pdo->prepare("SELECT id FROM `users` WHERE login = :login LIMIT 1");
        $query->bindParam(':login', $login);
        $query->execute();
        $user = $query->fetchAll();
        return !empty($user);
    }
}

?>