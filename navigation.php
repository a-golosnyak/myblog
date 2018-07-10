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
                        <form class=" nav-item" >
                            <input class="form-control " type="search" placeholder="Найти" aria-label="Search" size="12" ">
                        </form>
                        <div class="item-search nav-item" ><i class="fab fa-sistrix"></i></div>
                    </div>
                </div>
            </div>
            <div class=" col-xs-2">
                <div class="nav nav-tabs">
                    <div class="nav-item dropdown " style="left: auto; right: 0;">

                        <?php
                        require_once  'log.php' ; 
                        require_once  'functions.php' ; 
                        
                        if ($userLoggedIn == true) 
                        {
                            echo    "<div class=' nav-item'>
                                        <img class='avatar'src='images/ava/avamin.jpg'alt='...'>
                                    </div>

                                    <div class='nav-link dropdown-toggle nav-item user_nav_item'data-toggle='dropdown'href='#'role='button'    aria-haspopup='true'aria-expanded='false'>
                                    </div>
                                    <div class='dropdown-menu dropdown-menu-right'>
                                        <div class='dropdown-item'href='#'>Вы вошли как $userstr</div>
                                        <div class='dropdown-divider'></div>
                                        <div class='dropdown-item'href='#'>Профиль</div>
                                        <div class='dropdown-divider'></div>
                                        <div class='dropdown-item'>
                                        <a href='logout.php'>Выход</a></div>
                                    </div>";
                        } 
                        else 
                        { 
                            echo    "
                            <form class='form-signin' method='post' action='index.php'>

                                <div class='nav-link dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>Вход
                                </div>
                                <div class='dropdown-menu dropdown-menu-right'>
                                    <div class='dropdown-item' href='#'>
                                        <label for='inputEmail' class='sr-only'></label>
                                        <input type='text' name='user' maxlength='30' size='20' class='form-control' placeholder='Email address' required autofocus>
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
                                    <div class='dropdown-divider'></div>
                                    <div class='dropdown-item' href='#'>
                                        <button class='btn btn-md btn-primary btn-block' type='submit'>Регистрация</button>
                                    </div> 
                                </div> 
                            </form>
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

//$user = $pass = "";

if(isset($_POST['user']))
{
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);

    if ($user == "" || $pass == "")
        echo "Заполните пожалуйста все поля<br>";
    else
    {
        $query = "SELECT * FROM users WHERE user='$user' AND password=$pass";
        $result = $connection->query($query);

        if($result->num_rows == 0)
        {
            $status =  "Пользователь не зарегистрирован";

            echo "
            <div class='alert alert-danger' role='alert' style='width: 100%; margin-bottom: 0;'>
                <div class='container'>
                    <strong>$status</strong>$userstr
                </div>
            </div>";
        }
        else
        {
            if (isset($_POST['remember']))
            {
                $status = "Галочку remember влупили. ";
            }

            $_SESSION['user'] = $user;
            $_SESSION['pass'] = $pass;

            $status = $status . "Вход выполнен пользователем";

            echo "
            <div class='alert alert-success' role='alert' style='width: 100%; margin-bottom: 0;'>
                <div class='container'>
                    <strong>$status</strong>$userstr
                </div>
            </div>";

//            echo '<meta http-equiv="refresh" content="0" url="http://myblog/">';    
 //           die();
        }    
    }       
}
elseif (isset($_COOKIE['user']))
{
    $user = $_COOKIE['user'];
    $pass = $_COOKIE['pass'];

    $_SESSION['user'] = $user;
    $_SESSION['pass'] = $pass;

    $status = "Вход выполнен пользователем";

    echo "
    <div class='alert alert-success' role='alert' style='width: 100%; margin-bottom: 0;'>
        <div class='container'>
            <strong>$status</strong>$userstr
        </div>
    </div>";
}


?>






