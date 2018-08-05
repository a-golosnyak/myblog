<?php
    require_once  'main.php' ; 

    if($usermail == $adminmail)
    {
        echo "Добро пожаловать, Админ! <br>";

    }

    echo '<br>';
    echo "POST :"; 
    var_dump($_POST);
    echo '<br>';

    if(isset($_POST['name']))
    {
        echo "incoming name " . $_POST['name'];

        $user = sanitizeString($_POST['user']);
        $pass = sanitizeString($_POST['pass']);

        if ($user == "" || $pass == "")
            $error = "Not all fields were entered<br><br>";
        else
        {
            $result = queryMysql("SELECT * FROM members WHERE user='$user'");

            if ($result->num_rows)
                $error = "That username already exists<br><br>";
            else
            {
                queryMysql("INSERT INTO members VALUES('$user', '$pass')");
                die("<h4>Account created</h4>Please Log in.<br><br>");
            }
        }
    }

?>
    <div class='reg-field'>
        <div class="container registration-container " style="height: 100%;">
            <form class="form-signin" action="registration.php" method="post">
                <h2 class="form-signin-heading">Регистрация</h2>
                <div>
                    <input type="email"    name="email" class="form-control form-signup page-item" placeholder="Email" required>
                    <i class="fas fa-asterisk "></i> 
                </div>
                <br>
                <div>
                    <input type="password" name="password" class="form-control form-signup page-item" placeholder="Пароль" required>
                    <i class="fas fa-asterisk "></i> 
                </div>
                <div>
                    <input type="password" name="password_confirm" class="form-control form-signup page-item" placeholder="Повторите пароль" required>
                    <i class="fas fa-asterisk "></i> 
                </div>
                <br>
                <div>
                    <input type="text"      name="screen_name" class="form-control form-signup page-item" placeholder="Имя" required>
                    <i class="fas fa-asterisk "></i> 
                </div>
                <br>
                <div>
                    <button type="submit" class="btn btn-lg btn-primary btn-block form-control form-signup" >Зарегистрироваться</button>
                </div>
            </form>
        </div> <!-- /container -->
    </div>

  </body>
</html>