<?php

//если пользователь не авторизован
if(!isset($_COOKIE['session_token'])){
    header('Location: login');
}

//запрос к базе данных
$user = new UserController();
$response = $user->edit($_POST['name']??null, $_POST['sex']??null, strtotime($_POST['birthday'])??null, $_POST['address']??null,
                        $_POST['description']??null, $_POST['vk_link']??null,
                        empty($_POST['blood_type'])?null:$_POST['blood_type'], $_POST['rh_factor']??null);

//обработка ответа
header('Location: account');

?>