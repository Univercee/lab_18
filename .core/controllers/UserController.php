<?php

class UserController {
    private $user_table;
    private $errors;
    public function __construct()
    {
        $this->user_table = new UserTable;
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

    public function getByToken(){
        $user = $this->user_table->getByToken($_COOKIE['session_token']);
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

    public function edit(string $__image = null, string $__name = null, string $__address = null, bool $__sex = null,
                        string $__description = null, string $__vk_link = null, int $__blood_type = null, DateTime $__birthday = null,
                        bool $__rh_factor = null){
        
    }

    public function delete($id){

    }
}

?>