
<link rel="stylesheet" href="css/main.css">

<div class="navigation">
    <div class="row ">
        <div class="container">
            <div class=" col-xs-6"> 
                <div class="nav nav-tabs ">
                    <div class="nav-item">
                        <div class="nav-link " href="#">Главная</div>
                    </div>
                    <div class="nav-item dropdown">
                        <div class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Рубрика</div>
                        <div class="dropdown-menu dropdown-menu-left">
                            <div class="dropdown-item" href="#">Разработка электроники</div>
                            <div class="dropdown-item" href="#">Автомобили</div>
                            <div class="dropdown-item" href="#">Спорт</div>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-item" href="#">Тестовые проекты</div>
                        </div>
                    </div>
                    <div class="nav-item">
                        <div class="nav-link disabled" href="#">Контакты</div>
                    </div>
                    <div class="nav-item">
                        <div class="nav-link " href="#">О сайте</div>
                    </div>
                </div>
            </div>
            <div class=" col-xs-1">

            </div>
            <div class=" col-xs-3"> 
                <div class="row">
                    <div class="nav-tabs">
                        <form class="form-inline my-2 my-xs-4 nav-item" >
                            <input class="form-control mr-xs-2" type="search" placeholder="Найти" aria-label="Search" size="12" style="margin-top: 2px;">
                        </form>
                        <div class="item-search nav-item" ><i class="fab fa-sistrix"></i></div>
                    </div>
                </div>
            </div>
            <div class=" col-xs-2">
                <div class="nav nav-tabs">
                    <div class="nav-item dropdown " style="left: auto; right: 0;">
                        <?php /*
                        if ($userLoggedIn == true) 
                        {
                            echo    "<div class='alert alert-primary' role='alert' style='width: 100%; margin-bottom: 0;'>
                                        <div class='container'>
                                            <strong>Вход пользователем выполнен.</strong>
                                            <div>$userstr</div>
                                        </div>
                                    </div>";
                        } 
                        else 
                        { 
                            echo    "<div class='alert alert-danger' role='alert' style='width: 100%; margin-bottom: 0;'>
                                        <div class='container'>
                                            <strong>Пользователь не зарегистрирован.</strong>
                                        </div>
                                    </div>";

                        }       */
                    ?>      
         <!--               <div class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Sign In</div>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-item" href="#">Action</div>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-item" href="#">Another action</div>
                            <div class="dropdown-item" href="#">Something else here</div>
                            <div class="dropdown-item" href="#">Separated link</div>
                        </div>          -->

                        <div class="media-left media-middle">
                                <img class="avatar" src="images/ava/avamin.jpg" alt="..." style="width: 40px; display: inline; float: left;">
                        </div>

                        <div class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"     aria-haspopup="true" aria-expanded="false" style="display: block; float: right;">
                        </div>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-item" href="#">Action</div>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-item" href="#">Another action</div>
                            <div class="dropdown-item" href="#">Something else here</div>
                            <div class="dropdown-item" href="#">Separated link</div>
                        </div>

                    </div>
                </div> 
            </div>

        </div>

    </div>
</div>



