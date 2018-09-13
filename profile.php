<?php
    require_once  'main.php' ; 

    if (!$userLoggedIn) 
        die();
    else
    {
        $result = queryMysql("SELECT * FROM users WHERE usermail='$usermail'");
        $row = $result->fetch_assoc();
     
        $pl_usermail = $row['usermail'];
        $pl_screen_name = $row['screen_name'];
        $pl_creation_date = $row['creation_date'];
        $pl_creation_date = preg_replace( "#(:\d+):\d+#", '$1', $pl_creation_date ); 
/*        echo "DB : "; 
        print_r($pl_usermail);
        echo "<br>"; 
        print_r($pl_password);
        echo "<br>";
        print_r($pl_screen_name);
        echo "<br>"; 
        print_r($pl_creation_date);
        echo "<br>";    */   
    }

    if($usermail == $adminmail)
    {
        echo "                                     
            <div class='alert alert-success' role='alert' style='width: 100%; margin-bottom: 0;'>
                <div class='container'>
                    <strong>Добро пожаловать, админ!</strong>
                </div>
            </div>";    
    }

    if(isset($_POST['name']))
    {
        $name = sanitizeString($_POST['name']);
        queryMysql("UPDATE users SET screen_name = '$name' 
                        WHERE usermail='$usermail' ");
        echo "  <script>
                   window.location.href='profile.php';
                </script>";   
    }

    if(isset($_POST['email']))
    {
        $email = sanitizeString($_POST['email']);
        $result = queryMysql("SELECT * FROM users WHERE usermail='$email'");

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

        if(strcmp($_POST['password'], $_POST['password_confirm']))
        {
            
        } 
    }

    echo "<div class='main-field style='background-color: lightgrey;'>  
    <div class='container-fluid ' >
        <div class='container data-field'>
            <div class='row'>
                <div class='col-md-8 blog-main'>
                    <div class='profile-field ' >
                        <h3 class='form-signin-heading profile-title'>Ваш профиль <b>$usermail</b></h3> 
                         <!--style='border: 1px solid grey;' -->
                        <br>
                        <div class='row' >
                                <div class='col-xs-4'>
                                    <span>Написать пост?</span>
                                </div>
                                <div class='col-xs-5'></div>
                                <a href='addpost.php'>
                                    <div class='col-xs-3' >
                                            <button type='submit' class='profile-btn' style='text-align: center;'>Написать!</button>
                                    </div>
                                </a>
                        </div>
                        <hr>
                        <div class='row' >
                                <div class='col-xs-4'>
                                    <span>Все мои статьи</span>
                                </div>
                                <div class='col-xs-5'></div>
                                <form class='col-xs-3' action='articles.php' method='get'>
                                    <input type='hidden' name='show' value='user_articles'>
                                    <button type='submit' class='profile-btn' style='text-align: center;'>Посмотерть</button>
                                </form>
                        </div>
                        <hr>
                        <hr>
                        <div class='row' >
                                <div class='col-xs-5'>
                                    <span>Профиль создан</span>
                                </div>
                                <div class='col-xs-4'></div>
                                <div class='col-xs-3' >
                                    <span class='profile-meta '>$pl_creation_date</span>
                                </div>
                        </div> 
                        <hr>";
?>
                        <?php 
                            echo "<form class='row form-signin' action='profile.php' method='post'>
                                    <div class='col-xs-4'>
                                        <label for='name'>Имя</label>
                                    </div>
                                    <div class='col-xs-5'>
                                        <input type='name' id='name' name='name' placeholder=$pl_screen_name required onkeyup = 'validateName(this)' size='18'>
                                        <div id='nameOk' class='page-item'>
                                            <i class='fas fa-asterisk'></i>
                                        </div>
                                    </div>
                                    <div class='col-xs-3' >
                                        <button type='submit' class='profile-btn' style='text-align: center;'>Применить</button>
                                    </div>
                                </form>";
                        ?>
                        <hr>
                        <?php 
                            echo "<form class='row form-signin' action='profile.php' method='post'>
                                        <div class='col-xs-4'>
                                            <label for='inputEmail'>Электронная почта</label>
                                        </div>
                                        <div class='col-xs-5'>
                                            <input type='email' id='inputEmail' name='email' placeholder=$pl_usermail required onblur='checkUser(this)' size='18'>
                                            <div id='emailOk' class='page-item' >
                                                <i class='fas fa-asterisk'></i>
                                            </div>
                                        </div>
                                        <div class='col-xs-3' >
                                            <button type='submit ' class='profile-btn disabled' >Применить</button>
                                        </div>
                                </form>";
                        ?>
                        <hr>

                        <form class='form-signin' action='profile.php' method='post'>
                                <div class='row'>
                                        <div class='col-xs-4'>
                                            <p>Пароль</p>
                                            <p>Повторите пароль</p>
                                        </div>
                                        <div class='col-xs-5'>
                                            <div>
                                                <input type='password' name='password'  placeholder='Пароль' required onkeyup='validatePassword(this, password_confirm)' size='18'>
                                                <div id='pass1Ok' class='page-item' style="top: 100px; "> 
                                                    <i class='fas fa-asterisk'></i>
                                                </div>
                                            </div>

                                            <input type='password' name='password_confirm'  placeholder='Повторите пароль'  required onkeyup='validatePassword(password, this)' size='18'>
                                            <div id='pass2Ok' class='page-item'>
                                                <i class='fas fa-asterisk'></i>
                                            </div>
                                        </div>
                                        <div class='col-xs-3' style='' >
                                            <button type='submit' class='profile-btn' >Применить</button>
                                        </div>
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
                                    <span class='btn btn-md btn-chose-new-photo' id="InpProfileSelect" >Загрузить новую картинку</span>
                                    <input type="file" id="InpProfilePhoto" style="display:none" aria-hidden="true">
                                </label>

                                <button class="btn btn-md btn-danger" id="PhotoCancel" style="display: none" href='profile.php'>Отмена</button>

                                <button type="submit" class="profile-btn btn-md btn-primary" id="PhotoSubmit" style="display:none">Загрузить</button>  
                            </form>
                        </div> 

                        <!-- This is the form that our event handler fills      DEBUG SECTION ***   -->
                        <form id="coords"
                            class="coords"
                            onsubmit="return false;">

                            <div class="inline-labels" id="InlineLabels" style="display:none">
                                <label>X1 <input type="text" size="4" id="x1" name="x1" /></label>
                                <label>Y1 <input type="text" size="4" id="y1" name="y1" /></label>
                                <label>X2 <input type="text" size="4" id="x2" name="x2" /></label>
                                <label>Y2 <input type="text" size="4" id="y2" name="y2" /></label>
                                <label>W <input type="text" size="4" id="w" name="w" /></label>
                                <label>H <input type="text" size="4" id="h" name="h" /></label>
                            </div>
                        </form>     
                        
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


                        
              
      <!--                  <form>
                            <textarea name="editor1" id="editor1" rows="20" cols="80">
                                This is my textarea to be replaced with CKEditor.
                            </textarea>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'editor1' );
                            </script>
                        </form>     -->
              
                    </div>      
                </div><!-- /.blog-main -->

                <?php 
                    require_once "sidebar.php";
                ?>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>
</div>

<?php
    require_once 'footer.php'

?>