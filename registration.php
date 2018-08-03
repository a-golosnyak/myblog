<?php
    require_once  'main.php' ; 

    if($usermail == $adminmail)
    {
        echo "Добро пожаловать, Админ! <br>";

    }

/*    echo '<br>';
    echo "POST : "; 
    var_dump($_POST);
    echo '<br>';
*/
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

    if(isset($_POST['email']))
    {
        $email = sanitizeString($_POST['email']);
        $result = queryMysql("SELECT * FROM users WHERE usermail='$email'");
   /*     $row = $result->fetch_assoc();
        echo "DB : "; 
        echo ($row["usermail"]);
        echo "<br>";    
*/
        if ($result->num_rows)
        {
            $status = "Такой адрес электронной почты уже существует<br>";

                $signin_message = "                                     
                <div class='alert alert-info' role='alert' style='width: 100%; margin-bottom: 0;'>
                    <div class='container'>
                        <strong>$status</strong>
                    </div>
                </div>";
                echo $signin_message;
        }
        else
        {
            $_SESSION['usermail'] = $email;
            queryMysql("UPDATE users SET usermail = '$email' 
                        WHERE usermail='$usermail' ");
            $file = "images/ava/$usermail.jpeg";
            $newFile = "images/ava/$email.jpeg";

            if (copy($file, $newFile))          // Делаем копию файла        
                $status = "";
            else
                $status = "err01";

 //         unlink($file);                      // удаляем оригинал
            echo "<script>
                    alert('Адрес электронной почты изменен. Выполните пожалуйста вход. $status');
                    window.location.href='logout.php';
                </script>";    
        }
        
    }

    if(isset($_POST['password_confirm']))
    {
        echo "incoming password " . $_POST['password'] . "<br>";
        echo "incoming password_confirm " . $_POST['password_confirm'];        
    }

?>
    <div class="container registration-container" style="min-height: 100%;">
        <form class="form-signin">
            <h2 class="form-signin-heading">Регистрация</h2>
            <input type="email"    id="email" class="form-control" placeholder="Email" required>
            <input type="password" id="password" class="form-control" placeholder="Пароль" required>
            <input type="password" id="password_confirm" class="form-control" placeholder="Повторите пароль" required>
            <input type="text"      id="screen_name" class="form-control" placeholder="Имя" required>
<br>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Зарегистрироваться</button>
        </form>
    </div> <!-- /container -->


   <?php
 /*  
    echo "<div class='main-field'>  
    <div class='container-fluid ' >
        <div class='container data-field'>
            <div class='row'>
                <div class='col-md-9 blog-main'>
                    <div class='profile-field ' >
                        <h3 class='form-signin-heading profile-title'>Ваш профиль <b>$usermail</b></h3> 
                        <br>
                        <div class='row' >
                                <div class='col-xs-5'>
                                    <span>Профиль создан</span>
                                </div>
                                <div class='col-xs-4'></div>
                                <div class='col-xs-3' >
                                    <span class='profile-meta '>January 1, 2014</span>
                                </div>
                        </div> 
                        <hr>";
                        */
?>
                        
<!--                        <form class="row form-signin" action="profile.php" method="post">
                                <div class="col-xs-4">
                                    <label for="name">Имя</label>
                                </div>
                                <div class="col-xs-5">
                                    <input type="name" id="name" name="name" placeholder="Имя пользователя" required style="">
                                </div>
                                <div class="col-xs-3" >
                                    <button type="submit" class="profile-btn" style="text-align: center;">Применить</button>
                                </div>
                        </form>
                        <hr>

                        <form class="row form-signin" action="profile.php" method="post">
                                <div class="col-xs-4">
                                    <label for="inputEmail">Электронная почта</label>
                                </div>
                                <div class="col-xs-5">
                                    <input type="email" id="inputEmail" name="email" placeholder="Email address" required>
                                </div>
                                <div class="col-xs-3" >
                                    <button type="submit " class="profile-btn disabled" >Применить</button>
                                </div>
                        </form>
                        <hr>
                        <form class="row form-signin" action="profile.php" method="post">
                                <div class="col-xs-4">
                                    <p>Пароль</p>
                                    <p>Повторите пароль</p>

                                </div>
                                <div class="col-xs-5">
                                    <input type="password" name="password"  placeholder="Пароль" required>
                                    <input type="password" name="password_confirm"  placeholder="Пароль"  required>
                                </div>
                                <div class="col-xs-3" style="padding-top: 0.7em;" >
                                    <button type="submit" class="profile-btn" >Применить</button>
                                </div>
                        </form>
                        <hr>
                        <br>
                        <div class="row preview-zone">
                            <form class="form-signin" method= 'post' action='profile.php' enctype='multipart/form-data'>
                                <h5 class="photo-item">Фото профиля</h5>

                                <?php
                                    echo "<img class='crop jcrop-holder' src='images/ava/$usermail.jpeg' id='ProfilePhoto'  />";
                                ?>

                                <br>
                                <label for="InpProfilePhoto" >
                                    <span class='btn btn-md' id="InpProfileSelect" >Загрузить новую картинку</span>
                                    <input type="file" id="InpProfilePhoto" style="display:none" aria-hidden="true">
                                </label>

                                <button class="btn btn-md btn-danger" id="PhotoCancel" style="display: none" href='profile.php'>Отмена</button>

                                <button type="submit" class="profile-btn btn-md btn-primary" id="PhotoSubmit" style="display:none">Загрузить</button>  
                            </form>
                        </div> 

                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div id="preview-pane">
                                    <div class="preview-container">
                                        <img src="" class="jcrop-preview" id="PreviewArea" alt="Preview" style="display:none;"/>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <br style="clear: both;">
                        <div style="clear: both;"> </div>
                    </div>
                    <nav class="blog-pagination">
                        <a class="btn btn-outline-primary" href="#">Older</a>
                        <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
                    </nav>
                </div>

                <?php 
                    require_once "sidebar.php";
                ?>
            </div>
        </div>
    </div>
</div>      

<?php

    require_once 'footer.php'

?>