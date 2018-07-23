<?php
    require_once  'main.php' ; 

    if (!$userLoggedIn) 
        die();

    if(isset($_POST['data']))
    {
        echo "Картинка заходит!";
    }

    if(isset($_FILES['image']['name']))
    {
        echo "Картинка заходит!";
        $saveto = "$user.jpg";
        move_uploaded_file($_FILES['image']['tmp_name'], $saveto);

        echo var_dump($_FILES);

/*        $typeok = TRUE;

        switch($_FILES['image']['type'])
        {
          case "image/gif":   $src = imagecreatefromgif($saveto); break;
          case "image/jpeg":  // Both regular and progressive jpegs
          case "image/pjpeg": $src = imagecreatefromjpeg($saveto); break;
          case "image/png":   $src = imagecreatefrompng($saveto); break;
          default:            $typeok = FALSE; break;
        }    
    }

    

    if ($typeok)
    {
        list($w, $h) = getimagesize($saveto);

        $max = 200;
        $tw  = $w;
        $th  = $h;

        if ($w > $h && $max < $w)
        {
            $th = $max / $w * $h;
            $tw = $max;
        }
        elseif ($h > $w && $max < $h)
        {
            $tw = $max / $h * $w;
            $th = $max;
        }
        elseif ($max < $w)
            $tw = $th = $max;

        $tmp = imagecreatetruecolor($tw, $th);
        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
        imageconvolution($tmp, array(array(-1, -1, -1),
        array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
        imagejpeg($tmp, $saveto);
        imagedestroy($tmp);
        imagedestroy($src);
        */
    }
    
?>

<div class="main-field">  
    <div class="container-fluid " >
        <div class="container data-field">
            <div class="row">
                <div class="col-sm-9 blog-main">
                    <div class="profile-field">
                            <h3 class="form-signin-heading profile-title">Ваш профиль</h3>
                            <br>
                            <span class="pull-sm-left">Профиль создан</span>
                            <span class="profile-meta pull-sm-right">January 1, 2014</span>
                            <hr style="clear: both;">
                        <form class="form-signin">
                            <div class="row">
                                <div class="col-xs-4">
                                    <label for="name">Имя</label>
                                </div>
                                <div class="col-xs-6">
                                    <input type="name" id="name"  placeholder="Имя пользователя" required autofocus>
                                </div>
                                <div class="col-xs-2" >
                                    <button type="button" class="btn pull-right" style="text-align: center;">Применить</button>
                                </div>
                            </div>
                        </form>
                        <hr style="clear: both;">
                        <form class="form-signin">
                            <div class="row">
                                <div class="col-xs-4">
                                    <label for="inputEmail">Электронная почта</label>
                                </div>
                                <div class="col-xs-6">
                                    <input type="email" id="inputEmail"  placeholder="Email address" required autofocus>
                                </div>
                                <div class="col-xs-2" >
                                    <button type="button" class="btn pull-right" >Применить</button>
                                </div>
                            </div>
                        </form>
                        <hr style="clear: both;">
                        <form class="form-signin">
                            <div class="row">
                                <div class="col-xs-4">
                                    <label for="password">Пароль</label>
                                </div>
                                <div class="col-xs-6">
                                    <input type="password" id="password"  placeholder="Пароль" required autofocus>
                                </div>
                                <div class="col-xs-2" >

                                </div>
                            </div>
                        </form>
                        <form class="form-signin">
                            <div class="row">
                                <div class="col-xs-4">
                                    <label for="">Повторите пароль</label>
                                </div>
                                <div class="col-xs-6">
                                    <input type="password" id="password_confirm"  placeholder="Пароль" required autofocus>
                                </div>
                                <div class="col-xs-2" >
                                    <button type="button" class="btn pull-right" >Применить</button>
                                </div>
                            </div>
                        </form>
                        <hr style="clear: both; " class="media-middle">
                        <div class="row preview-zone">
                            <form class="form-signin" method= 'post' action='profile.php' enctype='multipart/form-data'>
                                <h5 class="photo-item">Фото профиля</h5>

                                <img class="crop profile-photo" src='images/ava/avamin.jpeg' id="ProfilePhoto"  />
                                <br>
                                <label for="InpProfilePhoto" >
                                    <span class='btn btn-md btn-primary' id="InpProfileSelect" >Загрузить новую картинку</span>
                                    <input type="file"  id="InpProfilePhoto" style="display:none" aria-hidden="true">
                                </label>

                                <button class="btn btn-md btn-danger" id="PhotoCancel" style="display: none" href='profile.php'>Отмена</button>

                                <button type="submit" class="btn btn-md btn-primary" id="PhotoSubmit" style="display:none">Загрузить</button>  
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