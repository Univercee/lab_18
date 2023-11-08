<div>
    <div>
        <?php
            if(!empty($_SESSION['signup_errors'])){
                foreach($_SESSION['signup_errors'] as $error){
                    echo $error;
                }
            }
            unset($_SESSION['signup_errors']);
        ?>
    </div>
    <h4>Регистрация</h4>
    <form action="signup-action" method="POST">
        <div>
            <input type="text" name="login" placeholder="Имя пользователя">
        </div>
        <div>
            <input type="text" name="password" placeholder="Пароль">
        </div>
        <div>
            <input type="text" name="password_verification" placeholder="Повторите пароль">
        </div>
        <div>
            <input type="submit">
        </div>
    </form>
</div>