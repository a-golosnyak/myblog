<?php

    $result = queryMysql("SELECT * FROM category");

?>

<div class="navigation">
    <div class="row ">
        <div class="container">
            <div class="col-xs-6"> 
                <div class="nav nav-tabs ">
                    <div class="nav-item">
                        <div class="nav-link">
                            <a class='none-decored' href="index.php">Главная</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <div class="nav-link dropdown-toggle" id="getCategory" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" onclick="GetCategory();">Рубрика</div>
                        <div class="dropdown-menu dropdown-menu-left"  id="Categories" >
    <?php
            while($row = $result->fetch_assoc()) 
            {
                $cat_id = $row['id'];
                $category_name = $row['category_name'];

                echo "      <form action='articles.php' method='get'>
                                <input type='hidden' name='category' value='$cat_id'>
                                <button class='dropdown-item' type='submit' >$category_name</button>
                            </form> ";
            }
    ?>
                            <script>
/*                                function GetCategory ()
                                {
                                    data = "getcategory=true";
                                    request = new ajaxRequest()
                                    request.open("POST", "ajax/getcategory.php", true)
                                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")   // При использовании обьекта FormData это почему-то не нужно

                                    request.onreadystatechange = function()
                                    {
                                        if (this.readyState == 4)
                                            if (this.status == 200)
                                                if (this.responseText != null)
                                                {
                                                    alert(this.responseText);
                                                    var response = JSON.parse(this.responseText);

                                                    for (var key in response) 
                                                    {
                                                        // этот код будет вызван для каждого свойства объекта
                                                        // ..и выведет имя свойства и его значение
                                                        // alert( "Ключ: " + key + " значение: " + response[key] );
                                                        newdiv = document.createElement('div');
                                                        newdiv.className = "dropdown-item";
                                                        newdiv.innerHTML  = response[key];

                                                        Categories.appendChild(newdiv);
                                                    }
                                                }
                                    }
                                    request.send(data)
                                }*/
                            </script>
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
                            <input class="form-control " type="search" placeholder="Найти" aria-label="Search" size="15">
                        </form>
                        <div class="item-search nav-item" ><i class="fab fa-sistrix"></i></div>
                    </div>
                </div>
            </div>
            <div class=" col-xs-2">
                <div class="nav nav-tabs">
                    <div class="nav-item dropdown " style="vertical-align: right;">

                    <?php
  //                      require_once  'login.php' ; 
                        
                        if ($userLoggedIn == true) 
                        {
                            $usermail = $_SESSION['usermail'];
                            echo    "<div class=' nav-item'>
                                        <img class='avatar'  src='images/ava/$usermail.jpeg' alt='...'>
                                    </div>

                                    <div class='nav-link dropdown-toggle nav-item user_nav_item'data-toggle='dropdown'href='#'role='button'    aria-haspopup='true'aria-expanded='false'>
                                    </div>
                                    <div class='dropdown-menu dropdown-menu-right'>
                                        <div class='dropdown-item'href='#'>Вы вошли как $usermail</div>
                                        <div class='dropdown-divider'></div>
                                        <a class='none-decored' href='profile.php'>
                                            <div class='dropdown-item'href='#'>Профиль</div>
                                        </a>
                                        <div class='dropdown-divider'></div>
                                        <a class='none-decored' href='logout.php'>
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
                                    <a class='none-decored' href='registration.php'>
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
    echo "<br>";
    echo $usermail;
    echo "<br>";
    echo "REQUEST ";
    print_r($_REQUEST);
*/
?>

