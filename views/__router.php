<?php

//парсим url
$path = parse_url($_SERVER['REQUEST_URI'])["path"];
$splited_path = array_filter(explode('/', $path));
$filtered_path = [];
foreach($splited_path as $key => $value){
    array_push($filtered_path, $value);
}
$path_length = count($filtered_path);


//выводим нужную страницу, в зависимости от полученного пути
if($path_length > 2) {
    include('views/notFound.php');
}
else if($path_length == 1) {
    include('views/example.php');
}
else {
    $endpoint = $filtered_path[1];
    switch($endpoint){

        //отображение страниц
        case 'login':
            include('views/login.php');
            break;
        case 'signup':
            include('views/signup.php');
            break;
        case 'account':
            include('views/account.php');
            break;

        //обработка форм
        case 'signup-action':
            include('views/actions/signup.php');
            break;
        case 'login-action':
            include('views/actions/login.php');
            break;
        
        //страница по умолчанию
        default:
            include('views/notFound.php');
            break;
    }
}


?>