<?php

class UserController {
    private $user_table;
    private $errors;
    public function __construct()
    {
        $this->user_table = new User;
        $this->errors = [];
    }

    public function add(string $login, string $password, string $password_verification){
        $this->errors = [];

        if(empty($login) || empty($password) || empty($password_verification)){
            array_push($this->errors, 'Не все поля заполнены');
        }
        if($password != $password_verification){
            array_push($this->errors, 'Пароли не совпадают');
        }
        if($this->user_table->checkLoginExist($login)){
            array_push($this->errors, 'Пользователь с таким логином уже существует');
        }
        if(empty($this->errors)){
            $this->user_table->create($login, password_hash($password, PASSWORD_DEFAULT));
        }
        return $this->errors;
        
    }

    public function getByToken(string $token){
        $user = $this->user_table->getByToken($token);
        return $user;
    }

    public function login(string $login, string $password){
        $this->errors = [];
        $user = null;
        $session_token = null;

        if(empty($login) || empty($password)){
            array_push($this->errors, 'Не все поля заполнены');
        }
        if(empty($this->errors)){
            $user = $this->user_table->getId($login, $password);
            if(empty($user)){
                array_push($this->errors, 'Логин или пароль введены неверно');
            }
            else{
                $session_token = $this->user_table->createSessionToken($user["id"]);
            }
        }
        return ["errors"=>$this->errors, "session_token"=>$session_token];
    }

    public function edit(string $name = null, int $sex = null, int $birthday_timestamp = null, string $address = null,
                        string $description = null, string $vk_link = null, int $blood_type = null,
                        int $rh_factor = null){
        $this->errors = [];

        $id = $this->user_table->getIdByToken($_COOKIE['session_token']);
        $updated = $this->user_table->edit($id, $name, $sex, $birthday_timestamp, $address, $description, $vk_link, $blood_type, $rh_factor);
        if(!$updated){
            array_push($this->errors, 'Не удалось обновить профиль');
        }
        return $this->errors;
    }

    public function delete($id){

    }
}

?>