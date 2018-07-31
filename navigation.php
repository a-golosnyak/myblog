<div class="navigation">
    <div class="row ">
        <div class="container">
            <div class="col-xs-6"> 
                <div class="nav nav-tabs ">
                    <div class="nav-item">
                        <div class="nav-link">
                            <a href="index.php">Главная</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <div class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Рубрика</div>
                        <div class="dropdown-menu dropdown-menu-left">
                            <a href='emb_articles.php'>
                                <div class="dropdown-item">Разработка электроники</div>
                            </a>
                            <a href='car_articles.php'>
                                <div class="dropdown-item">Автомобили</div>
                            </a>
                            <a href='sport_articles.php'>
                                <div class="dropdown-item">Спорт</div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href='index.php?view=1'>
                                <div class="dropdown-item" href="#">Тестовые проекты</div>
                            </a>
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
                        <form class=" nav-item" >
                            <input class="form-control " type="search" placeholder="Найти" aria-label="Search" size="12" ">
                        </form>
                        <div class="item-search nav-item" ><i class="fab fa-sistrix"></i></div>
                    </div>
                </div>
            </div>
            <div class=" col-xs-2">
                <div class="nav nav-tabs">
                    <div class="nav-item dropdown " style="vertical-align: right;">

                    <?php
                        require_once  'login.php' ; 
                        
                        if ($userLoggedIn == true) 
                        {
                            echo    "<div class=' nav-item'>
                                        <img class='avatar'  src='images/ava/$usermail.jpeg' alt='...'>
                                    </div>

                                    <div class='nav-link dropdown-toggle nav-item user_nav_item'data-toggle='dropdown'href='#'role='button'    aria-haspopup='true'aria-expanded='false'>
                                    </div>
                                    <div class='dropdown-menu dropdown-menu-right'>
                                        <div class='dropdown-item'href='#'>Вы вошли как $userstr</div>
                                        <div class='dropdown-divider'></div>
                                        <a href='profile.php'>
                                            <div class='dropdown-item'href='#'>Профиль</div>
                                        </a>
                                        <div class='dropdown-divider'></div>
                                        <a href='logout.php'>
                                            <div class='dropdown-item'>Выход</div>
                                        </a>
                                    </div>";
                        } 
                        else 
                        { 
                            echo "
                                <div class='nav-link dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>Вход
                                </div>
                                <div class='dropdown-menu dropdown-menu-right'>
                                    <form class='form-signin' method='post' action='index.php'>
                                        <div class='dropdown-item' href='#'>
                                            <label for='inputEmail' class='sr-only'></label>
                                            <input type='email' name='usermail' maxlength='30' size='20' class='form-control' placeholder='Email address' required autofocus>
                                        </div>

                                        <div class='dropdown-item' href='#'>
                                            <label for='inputPassword' class='sr-only'>Password</label>
                                            <input type='password' name='pass' class='form-control' size='40' placeholder='Password' required>
                                        </div>
                                        <div class='dropdown-item' href='#'>
                                            <div class='checkbox '>
                                                <label>
                                                    <input type='checkbox' name='remember'>  Запомнить меня  
                                                </label>
                                            </div>
                                        </div>
                                        <div class='dropdown-item' href='#'>
                                            <button class='btn btn-lg btn-primary btn-block' type='submit'>Вход </button>
                                        </div>
                                    </form>
                                    <div class='dropdown-divider'></div>
                                    <a href='index.php?view=1'>
                                        <div class='dropdown-item' href='#'>
                                            <button class='btn btn-md btn-primary btn-block' type='submit'>
                                                Регистрация
                                            </button>
                                        </div> 
                                    </a>
                                </div>
                                "; 
                        }    
                    ?>       
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>

<?php

    echo $signin_message;

/*    echo "SESSION ";
    print_r($_SESSION);
    echo "<br>COOKIES ";
    print_r($_COOKIE);
    echo "<br>REQUEST ";
    print_r($_REQUEST);
    */
?>

