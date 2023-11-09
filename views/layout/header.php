<?php
    
    $auth = false;
    if(isset($_COOKIE['session_token'])){
        $user = (new UserController())->getByToken($_COOKIE['session_token']);
        if($user){
            $auth = true;
        }
    }

?>

<header class="py-3">
    <div class=" container-xl">
        <!--  -->
        <div class="row text-nowrap">
            <div class="col-xl-2 col-md-12 d-flex justify-content-center align-items-center gap-1 mb-3">
                <i class="fa-solid fa-location-dot"></i>
                <p class="m-0">Санкт-Петербург</p>
            </div>
            <div class="col-xl-8 col-md-12 d-flex justify-content-start mb-3" style=" overflow: auto;">
                <!-- <div class="d-flex gap-2 example justify-content-center w-100" style="font-size: 14px; min-width: max-content;">
                    <div><a href="#">Магазины</a></div>
                    <div><a href="#">Доставка и оплата </a></div>
                    <div><a href="#">Гарантия и возврат </a></div>
                    <div><a href="#">Покупка в кредит</a></div>
                    <div><a href="#">Эксперт</a></div>
                    <div><a href="#">Дисконт</a></div>
                    <div><a href="#">Комиссионка</a></div>
                </div> -->
            </div>
            <div class="col-xl-2 col-md-12 d-flex justify-content-center mb-3">
                <p class="text-end">+7 (812) 385 55 39 <span><i class="fa-solid fa-circle-info"></i></span></p>
            </div>
        </div>

        <!--  -->
        <div class="row">
            <div class="col-xl-2 col-md-12 d-flex justify-content-center mb-3">
                <a href="/Lr">
                    <img class="img-responsive" style="max-height: 30px;" src="https://www.fotosklad.ru/local/templates/fotosklad_desktop/frontend/assets/img/logo-d37865cb13fd4afb4e502de9db3b4248.svg" alt="">
                </a>
            </div>
            <div class="col-xl-7 col-md-8 mb-3">
                <div class="d-flex gap-2">
                    <button class="btn btn-primary">Каталог</button>
                    <input class="flex-grow-1" type="text" placeholder="Искать товары...">                    
                </div>
            </div>
            <div class="col-xl-3 col-md-4 text-nowrap mb-3">
                <div class="d-flex gap-3 justify-content-center">
                    <?php if($auth){ ?>

                        <!-- <a class="d-flex flex-column align-items-center">
                            <i class="fa-solid fa-cube fs-5"></i>
                            <p>Статус заказа</p>
                        </a> -->
                        <a class="d-flex flex-column align-items-center" href="/Lr/account">
                            <i class="fa-regular fa-user fs-5"></i>
                            <p>Кабинет</p> 
                        </a>  
                        <!-- <a class="d-flex flex-column align-items-center">  
                            <i class="fa-solid fa-cart-shopping fs-5"></i>
                            <p>Корзина</p>    
                        </a>     -->

                    <?php } else{?>

                        <a class="d-flex flex-column align-items-center" href="/Lr/login">Войти</a>
                        <a class="d-flex flex-column align-items-center" href="/Lr/signup">Зарегистрироваться</a>

                    <?php } ?>     
                </div>
            </div>
        </div>
    </div>
</header>