<?php

//если пользователь не авторизован
if(!isset($_COOKIE['session_token'])){
    header('Location: login');
}

//запрос к базе данных
$user = new UserController();
$response = $user->edit($_POST['name'], $_POST['sex'], strtotime($_POST['birthday'])??null, $_POST['address'],
                        $_POST['description'], $_POST['vk_link'], $_POST['blood_type'], $_POST['rh_factor']);

//обработка ответа
header('Location: account');

?>