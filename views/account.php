<?php
    $user = (new User())->getByToken();
    var_dump($user);
?>
<div>
    <h2>Данные пользователя</h2>
    <div>
        <p>ФИО</p>
        <p></p>
    </div>
</div>