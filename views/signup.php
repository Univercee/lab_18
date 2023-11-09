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
    <form action="signup-action" method="POST" class="d-flex flex-column gap-3">
        <div>
            <input class="form-control" type="text" name="login" placeholder="Имя пользователя">
        </div>
        <div>
            <input class="form-control" type="password" name="password" placeholder="Пароль">
        </div>
        <div>
            <input class="form-control" type="password" name="password_verification" placeholder="Повторите пароль">
        </div>
        <div class="mt-3">
            <input class="btn btn-primary w-100" type="submit" value="Зарегистрироваться">
        </div>
        <div class="text-center">
            <a href="login">Войти</a>
        </div>
    </form>
</div>