<?php
    if(isset($_COOKIE['session_token'])){
        $user = (new UserController())->getByToken($_COOKIE['session_token']);
    }
    else{
        header("Location: login");
    }
?>
<div class="container-md d-flex flex-column gap-4 mb-5">
    <div class="row">
        <div class="col-md-3"></div>
        <h2 class="col-md-6">Данные пользователя</h2>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <p class="bold">ФИО</p>
        </div>
        <div class="col-md-3">
            <p><?php echo $user["name"]??"не указано"?></p>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <p class="bold">Пол</p>
        </div>
        <div class="col-md-3">
            <p><?php echo $user["sex"]==0?"Женский":"Мужской"??"не указано"?></p>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <p class="bold">Дата рождения</p>
        </div>
        <div class="col-md-3">
            <p><?php echo $user["birthday"]??"не указано"?></p>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <p class="bold">Адрес</p>
        </div>
        <div class="col-md-3">
            <p><?php echo $user["address"]??"не указано"?></p>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <p class="bold">Интересы</p>
        </div>
        <div class="col-md-3">
            <p><?php echo $user["description"]??"не указано"?></p>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <p class="bold">Ссылка на vk</p>
        </div>
        <div class="col-md-3">
            <p><?php echo $user["vk_link"]??"не указано"?></p>
        </div>
        <div class="col-md-3"></div>
    </div>
    
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <p class="bold">Группа крови</p>
        </div>
        <div class="col-md-3">
            <p><?php 
                switch($user["blood_type"]){
                    case 1:
                        echo "I";
                        break;
                    case 2:
                        echo "II";
                        break;
                    case 3:
                        echo "III";
                        break;
                    case 4:
                        echo "IV";
                        break;
                    default:
                        echo "не указано";
                        break;
            };
            ?></p>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <p class="bold">Резус фактор</p>
        </div>
        <div class="col-md-3">
            <p><?php echo $user["rh_factor"]==0?"Отрицательный":"Положительный"??"не указано"?></p>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-3"></div>
        <a class="btn btn-primary text-white col-md-6" href="./account-edit">Редактировать</a>
        <div class="col-md-3"></div>
    </div>
</div>