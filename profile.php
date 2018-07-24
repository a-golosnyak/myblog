<?php
    require_once  'main.php' ; 

    if (!$userLoggedIn) 
        die();

/*    if(isset($_POST['data']))
        echo "Картинка заходит!";

    if(isset($_FILES['image']['name']))
    {
    }
    */
?>

<div class="main-field">  
    <div class="container-fluid " >
        <div class="container data-field">
            <div class="row">
                <div class="col-md-9 blog-main">
                    <div class="profile-field " style="border: 1px solid grey;">
                        <h3 class="form-signin-heading profile-title">Ваш профиль</h3>
                        <br>
                        <div class="row" >
                                <div class="col-xs-5">
                                    <span>Профиль создан</span>
                                </div>
                                <div class="col-xs-4"></div>
                                <div class="col-xs-3" >
                                    <span class="profile-meta ">January 1, 2014</span>
                                </div>
                        </div>
                        <hr>
                        <form class="row form-signin" style="border: 1px solid grey;">
                                <div class="col-xs-4">
                                    <label for="name">Имя</label>
                                </div>
                                <div class="col-xs-5">
                                    <input type="name" id="name"  placeholder="Имя пользователя" required style="">
                                </div>
                                <div class="col-xs-3" >
                                    <button type="submit" class="profile-btn" style="text-align: center;">Применить</button>
                                </div>
                        </form>
                        <hr>

                        <form class="row form-signin">
                                <div class="col-xs-4">
                                    <label for="inputEmail">Электронная почта</label>
                                </div>
                                <div class="col-xs-5">
                                    <input type="email" id="inputEmail"  placeholder="Email address" required>
                                </div>
                                <div class="col-xs-3" >
                                    <button type="button" class="profile-btn" >Применить</button>
                                </div>
                        </form>
                        <hr>
                        <form class="row form-signin">
                                <div class="col-xs-4">
                                    <p>Пароль</p>
                                    <p>Повторите пароль</p>

                                </div>
                                <div class="col-xs-5">
                                    <input type="password" id="password"  placeholder="Пароль" required>
                                    <input type="password" id="password_confirm"  placeholder="Пароль"  required>
                                </div>
                                <div class="col-xs-3" style="padding-top: 0.7em;" >
                                    <button type="button" class="profile-btn" >Применить</button>
                                </div>
                        </form>
                        <hr>
                        <br>
                        <div class="row preview-zone">
                            <form class="form-signin" method= 'post' action='profile.php' enctype='multipart/form-data'>
                                <h5 class="photo-item">Фото профиля</h5>

                                <?php
                                    echo "<img class='crop profile-photo' src='images/ava/$usermail.jpeg' id='ProfilePhoto'  />";
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
                        <!-- <img src='$user.jpg' style='float:left;'> -->        
                    </div>
                    <nav class="blog-pagination">
                        <a class="btn btn-outline-primary" href="#">Older</a>
                        <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
                    </nav>
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