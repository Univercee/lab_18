<?php
    if(isset($_COOKIE['session_token'])){
        $user = (new UserController())->getByToken($_COOKIE['session_token']);
    }
    else{
        header("Location: login");
    }
?>
<div class="container-sm row d-flex flex-column align-items-center mb-5">
    <h2 class="col-md-6">Данные пользователя</h2>
    <form action="account-edit-action" method="POST" enctype="multipart/form-data" class="col-md-12 d-flex flex-column gap-4">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <p class="bold">Изображение</p>
            </div>
            <div class="col-md-3">
                <input class="form-control" type="file" name="image"></input>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <p class="bold">ФИО</p>
            </div>
            <div class="col-md-3">
                <input class="form-control" type="text" name="name" value="<?php echo $user["name"]?>"></input>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <p class="bold">Пол</p>
            </div>
            <div class="col-md-3">
                <input class="form-check-input" type="radio" name="sex" id="sexFemale" value="0" <?php echo !is_null($user["sex"])&&$user["sex"]==0?"checked":"" ?>></input>
                <label class="form-check-label" for="sexFemale">Женский</label>
                <input class="form-check-input" type="radio" name="sex" id="sexMale" value="1"  <?php echo !is_null($user["sex"])&&$user["sex"]==1?"checked":"" ?>></input>
                <label class="form-check-label" for="sexFemale">Мужской</label>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <p class="bold">Дата рождения</p>
            </div>
            <div class="col-md-3">
                <input class="form-control" type="date" name="birthday" value="<?php echo $user["birthday"]?>"></input>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <p class="bold">Адрес</p>
            </div>
            <div class="col-md-3">
                <input class="form-control" type="text" name="address" value="<?php echo $user["address"]?>"></input>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <p class="bold">Интересы</p>
            </div>
            <div class="col-md-3">
                <textarea class="form-control" name="description" max=255><?php echo $user["description"]?></textarea>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <p class="bold">Ссылка на vk</p>
            </div>
            <div class="col-md-3">
                <input class="form-control" type="text" name="vk_link" value="<?php echo $user["vk_link"]?>"></input>
            </div>
            <div class="col-md-3"></div>
        </div>
        
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <p class="bold">Группа крови</p>
            </div>
            <div class="col-md-3">
                <select class="form-select" type="text" name="blood_type">
                    <option value="">Не указано</option>
                    <option value="1" <?php echo $user["blood_type"]==1?"selected":"" ?>>I</option>
                    <option value="2" <?php echo $user["blood_type"]==2?"selected":"" ?>>II</option>
                    <option value="3" <?php echo $user["blood_type"]==3?"selected":"" ?>>III</option>
                    <option value="4" <?php echo $user["blood_type"]==4?"selected":"" ?>>IV</option>
                </select>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <p class="bold">Резус фактор</p>
            </div>
            <div class="col-md-3">
                <input class="form-check-input" type="radio" name="rh_factor" id="rhMinus" value="0" <?php echo !empty($user["rh_factor"])&&$user["rh_factor"]==0?"checked":"" ?>></input>
                <label class="form-check-label" for="rhMinus">-</label>
                <input class="form-check-label" class="form-check-input" type="radio" name="rh_factor" id="rhPlus" value="1" <?php echo !empty($user["rh_factor"])&&$user["rh_factor"]==1?"checked":"" ?>></input>
                <label for="rhPlus">+</label>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <input type="submit" class="btn btn-primary text-white w-100" value="Сохранить"></input>
            </div>
            <div class="col-md-3"></div>
        </div>
    </form>
</div>