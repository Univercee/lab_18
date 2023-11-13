<?php

class UserController {
    private $table;
    private $errors;
    public function __construct()
    {
        $this->table = new User();
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
        if($this->table->checkLoginExist($login)){
            array_push($this->errors, 'Пользователь с таким логином уже существует');
        }

        // chatGPT в помощь при составлении regex)
        if(!preg_match("/^[a-zA-Z\d!@#$%^&*(),.?\"':{}|<>]*[a-zA-Z][a-zA-Z\d!@#$%^&*(),.?\":{}|<>]*$/", $password)){
            array_push($this->errors, 'Пароль должен содержать только латинкие буквы');
        }
        if(!preg_match("/^.{6,}$/u", $password)){
            array_push($this->errors, 'Пароль должен содержать как минимум 6 символов');
        }
        if(!preg_match("/^(?=.*[A-Z]).+$/", $password)){
            array_push($this->errors, 'Пароль должен содержать хотя бы одну заглавную латинскую букву');
        }
        if(!preg_match("/[!@#$%^&*(),.?\"':{}|<>]/", $password)){
            array_push($this->errors, 'Пароль должен содержать хотя бы один спецсимвол');
        }
        if(!preg_match("/\d/", $password)){
            array_push($this->errors, 'Пароль должен содержать хотя бы одну цифру');
        }
        if(empty($this->errors)){
            $this->table->create($login, password_hash($password, PASSWORD_DEFAULT));
        }
        return $this->errors;
        
    }

    public function getByToken(string $token){
        $user = $this->table->getByToken($token);
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
            $user = $this->table->getId($login, $password);
            if(empty($user)){
                array_push($this->errors, 'Логин или пароль введены неверно');
            }
            else{
                $session_token = $this->table->createSessionToken($user["id"]);
            }
        }
        return ["errors"=>$this->errors, "session_token"=>$session_token];
    }

    public function edit(string $name = null, int $sex = null, $image = null, int $birthday_timestamp = null, int $shooting_type_id = null, string $address = null,
                        string $description = null, string $vk_link = null, int $blood_type = null,
                        int $rh_factor = null){
        $this->errors = [];

        $id = $this->table->getIdByToken($_COOKIE['session_token']);
        try{
            $img = is_null($image)?null:$id.'.jpg';
            $this->table->edit($id, $name, $sex, $img, $birthday_timestamp, $shooting_type_id, $address, $description, $vk_link, $blood_type, $rh_factor);
            $this->uploadImage($id, $image);
        }catch(Exception $e){
            array_push($this->errors, 'Не удалось обновить профиль');
        }
       
        return $this->errors;
    }

    public function delete($id){

    }


    private function uploadImage($id, $image) {
        $path = $_SERVER['DOCUMENT_ROOT'].'/Lr/inc/catalog_images/'.$id.'.jpg';
        if(is_null($image)){
            if(file_exists($path)){
                unlink($path);
            }
        }
        else{
            move_uploaded_file($image["tmp_name"], $path);
        }
    }
}

?>