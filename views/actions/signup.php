<?php

//запрос к базе данных
$user = new UserController();
$errors = $user->add($_POST['login'], $_POST['password'], $_POST['password_verification']);

//обработка ответа
if(empty($errors)){
    header('Location: /lr');
}
else{
    $_SESSION['errors'] = $errors;
    header('Location: signup');
}

?>