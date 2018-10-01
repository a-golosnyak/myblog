<?php
    require_once  'main.php' ; 

    $email = 0;

    if(isset($_POST['email']))
    {
        $email = sanitizeString($_POST['email']);
        $date = date("Y-m-d H:i:s");

        $result = queryMysql("SELECT * FROM users WHERE usermail='$email'");

        if ($result->num_rows)          // Мы это уже проверили во фронтенде. Страхуемся.
        {
            echo "This email exists<br><br>";

            $row = mysqli_fetch_assoc($result);
            $username = $row['screen_name'];

            $password = RandStringLowerCase(3);
            $connection->query("UPDATE users SET password='$password' WHERE usermail='$email'");
            $result = mail( 'andrey_g.pt@mail.ru', 
                            'Запрос на восстановление пароля.', 
                            'Здравствуйте '. $username . ".\n". 
                            'Ваш новый пароль ' . $password);

            echo "$password <br> $result";

            echo "<script>
                    window.location.href='passrecovery2.php';
                </script>";

        }
        else
        {
            echo "<script>
                    alert('Учетная запись не зарегистрирована.');
            /*        window.location.href='registration.php';  */
                </script>";
        }
    }
?>

    <div id="info"></div>
    <div class='reg-field'>
        <div class="container registration-container " style="height: 100%;">
            <form class="form-signin" action="passrecovery.php" method="post">
                <h2 class="form-signin-heading">Восстановление пароля</h2>
                <br>
                <div class="">
                    <div class="form-signup-message" align="justify">
                        Введите ваш адрес электронной почты. Мы отправим вам новый пароль.
                    </div>
                    <input type="email" name="email" class="form-control form-signup page-item" placeholder="Email" required>
                    <div class="form-signup-message">
                        <button type="submit" class="btn btn-lg btn-primary  btn-block page-item" >Отправить</button>
                    </div>
                </div> 
            </form>
        </div> <!-- /container -->
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/javascript.js"></script>
    <script src="js/jquery.Jcrop.min.js"></script> 
    <script src="js/jquery.Jcrop.js"></script>

  </body>
</html>