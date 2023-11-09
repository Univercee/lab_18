<?php

class User {

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

    public function getIdByToken($token){
        $query = $this->pdo->prepare("SELECT `users`.id FROM `users` JOIN `sessions` ON `users`.id = `sessions`.user_id WHERE `sessions`.token=:session_token");
        $query->bindParam(':session_token', $token);
        $query->execute();
        $user = $query->fetch();
        if(empty($user)){
            throw new PDOException();
        }
        return $user["id"];
    }

    public function createSessionToken($id){
        $token = $this->generateToken();
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

    public function edit($id, $name, $sex, $birthday_timestamp, $address, $description, $vk_link, $blood_type, $rh_factor){
        $query = $this->pdo->prepare("UPDATE `users`
                                    SET name = :name, sex = :sex, birthday = FROM_UNIXTIME(:birthday_timestamp), address = :address,
                                                description = :description, vk_link = :vk_link, blood_type = :blood_type,
                                                rh_factor = :rh_factor
                                    WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->bindParam(':name', $name);
        $query->bindParam(':sex', $sex);
        $query->bindParam(':birthday_timestamp', $birthday_timestamp);
        $query->bindParam(':address', $address);
        $query->bindParam(':description', $description);
        $query->bindParam(':vk_link', $vk_link);
        $query->bindParam(':blood_type', $blood_type);
        $query->bindParam(':rh_factor', $rh_factor);
        $executed = $query->execute();
        if(!$executed){
            throw new PDOException();
        }
    }

    private function generateToken(){
        return md5(uniqid(rand(), TRUE));
    }
}

?>