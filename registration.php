<?php
    require_once  'main.php' ; 

    if (isset($_SESSION['user'])) 
        destroySession();

    $email=$password=$screen_name = 0;

    if(isset($_POST['email']))
    {
        $email = sanitizeString($_POST['email']);
        $password = sanitizeString($_POST['password']);
        $screen_name = sanitizeString($_POST['screen_name']);
        $date = date("Y-m-d H:i:s");

        $result = queryMysql("SELECT * FROM users WHERE usermail='$email'");

        if ($result->num_rows)          // Мы это уже проверили во фронтенде. Страхуемся.
        {
//            echo "That email already exists<br><br>";
        }
        else
        {
            //--- Записываем данные по профилю в базу данных --------------------------------------
//          echo "This email can be used<br><br>";
            queryMysql("INSERT INTO users VALUES('0', '$email', '$password' , '$screen_name', '$date')");
            
            $file = "images/ava/Guest.jpg";
            $newFile = "images/ava/$email.jpeg";

            //--- Присваеваем новому профилю стандартную картпинку --------------------------------
            if (copy($file, $newFile))          // Делаем копию файла        
                $status = "";
            else
                $status = "err01";

            echo "<script>
                    alert('Учетная запись зарегистрирована. Выполните пожалуйста вход.');
                    window.location.href='registration.php';
                </script>";
        }
    }
?>

    <div id="info"></div>
    <div class='reg-field'>
        <div class="container registration-container " style="height: 100%;">
            <form class="form-signin" action="registration.php" method="post" 
            onSubmit='return validateRegFormAll(this)'>
                <h2 class="form-signin-heading">Регистрация</h2>
                <div>
                    <input type="email" name="email" class="form-control form-signup page-item" placeholder="Email" required onblur='checkUser(this, '{!! csrf_token() !!}')'>
                    <div id="emailOk" class="page-item">
                        <i class="fas fa-asterisk "></i> 
                    </div>
                </div>
                <br>
                <div>
                    <input type="password" name="password" id="password" class="form-control form-signup page-item" placeholder="Пароль" required onkeyup="validatePassword(this, password_confirm)">
                    <div id="pass1Ok" class="page-item">
                        <i class="fas fa-asterisk "></i> 
                    </div>
                </div>
                <div>
                    <input type="password" name="password_confirm" class="form-control form-signup page-item" placeholder="Повторите пароль" required onkeyup="validatePassword(password, this)">
                    <div id="pass2Ok" class="page-item">
                       <i class="fas fa-asterisk "></i> 
                   </div>
                </div>
                <br>
                <div>
                    <input type="text" name="screen_name" class="form-control form-signup page-item" placeholder="Имя" required onkeyup = "validateName(this)">
                    <div id="nameOk" class="page-item">
                        <i class="fas fa-asterisk "></i> 
                    </div>
                </div>
                <br>
                <div>
                    <button type="submit" class="btn btn-lg btn-primary btn-block form-control form-signup page-item" >Зарегистрироваться</button>
                    <i class="fas fa-asterisk " style="color: #eee"></i> 
                </div>
            </form>
        </div> <!-- /container -->
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="      sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>

<!--    <script src="http://jcrop-cdn.tapmodo.com/v0.9.12/js/jquery.Jcrop.min.js"></script>
    <link rel="stylesheet" href="http://jcrop-cdn.tapmodo.com/v0.9.12/css/jquery.Jcrop.css" type="text/css" />      -->
    <script src="js/bootstrap.js"></script>
    <script src="js/javascript.js"></script>
    <script src="js/jquery.Jcrop.min.js"></script> 
    <script src="js/jquery.Jcrop.js"></script>
    

  </body>
</html>