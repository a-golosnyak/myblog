<div class="navigation">
    <div class="row ">
        <div class="container">
            <div class="col-xs-6"> 
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

                        <?php
                        require_once  'log.php' ; 

                        if ($userLoggedIn == true) 
                        {
                            echo    "<div class='media-middle nav-item'>
                                        <img class='avatar'src='images/ava/avamin.jpg'alt='...'>
                                    </div>

                                    <div class='nav-link dropdown-toggle nav-item user_nav_item'data-toggle='dropdown'href='#'role='button'    aria-haspopup='true'aria-expanded='false'>
                                    </div>
                                    <div class='dropdown-menu dropdown-menu-right'>
                                        <div class='dropdown-item'href='#'>Вы вошли как $userstr</div>
                                        <div class='dropdown-divider'></div>
                                        <div class='dropdown-item'href='#'>Профиль</div>
                                        <div class='dropdown-divider'></div>
                                        <div class='dropdown-item'href='#'>Выход</div>
                                    </div>";
                        } 
                        else 
                        { 
                            echo    "<div class='nav-link dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>Вход
                                </div>
                                <div class='dropdown-menu dropdown-menu-right'>
                                    <div class='dropdown-item' href='#'>
                                        <label for='inputEmail' class='sr-only'></label>
                                        <input type='email' id='inputEmail' maxlength='30' size='20' class='form-control' placeholder='Email address' required autofocus>
                                    </div>

                                <form class='form-signin'>
                                    <div class='dropdown-item' href='#'>
                                        <label for='inputPassword' class='sr-only'>Password</label>
                                        <input type='password' id='inputPassword' class='form-control' size='40' placeholder='Password' required>
                                    </div>
                                    <div class='dropdown-item' href='#'>
                                        <div class='checkbox '>
                                            <label>
                                                <input type='checkbox' value='remember-me'> Запомнить меня
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
                                </form>
                            </div> 
                                ";

                        }       
                    ?>      

                            
                       

  <!--                  <form class="form-signin">
                        <h2 class="form-signin-heading">Please sign in</h2>
                        <label for="inputEmail" class="sr-only">Email address</label>
                        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                        <label for="inputPassword" class="sr-only">Password</label>
                        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                        <div class="checkbox">
                        <label>
                        <input type="checkbox" value="remember-me"> Remember me
                        </label>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                    </form>
-->
                    </div>
                </div> 
            </div>

        </div>

    </div>
</div>



