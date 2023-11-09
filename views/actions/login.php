<?php

//запрос к базе данных
$user = new UserController();
$response = $user->login($_POST['login'], $_POST['password']);
//обработка ответа
if(empty($response["errors"]) && !empty($response["session_token"])){
    setcookie("session_token", $response["session_token"], time()+3600, '/', NULL, 0);
    header('Location: account');
}
else{
    $_SESSION['errors'] = $response["errors"];
    header('Location: login');
}

?>