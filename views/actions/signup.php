<?php

//запрос к базе данных
$user = new UserController();
$errors = $user->add($_POST['login'], $_POST['password'], $_POST['password_verification']);

//обработка ответа
if(empty($errors)){
    $response = $user->login($_POST['login'], $_POST['password']);
    setcookie("session_token", $response["session_token"], time()+3600, '/', NULL, 0);
    header('Location: account');
}
else{
    $_SESSION['errors'] = $errors;
    header('Location: signup');
}

?>