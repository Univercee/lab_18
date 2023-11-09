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
    <h4>Вход</h4>
    <form action="login-action" method="POST" class="d-flex flex-column gap-3">
        <div>
            <input class="form-control" type="text" name="login" placeholder="Имя пользователя">
        </div>
        <div>
            <input class="form-control" type="password" name="password" placeholder="Пароль">
        </div>
        <div class="mt-3">
            <input class="btn btn-primary w-100" type="submit" value="Войти">
        </div>
        <div class="text-center">
            <a href="signup">Зарегистрировться</a>
        </div>
    </form>
</div>