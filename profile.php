<?php
    require_once  'main.php' ; 

    if (!$userLoggedIn) 
        die();

    if(isset($_FILES['image']['name']))
    {
        echo "Картинка заходит!";
        $saveto = "$user.jpg";
        move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
        $typeok = TRUE;

        switch($_FILES['image']['type'])
        {
          case "image/gif":   $src = imagecreatefromgif($saveto); break;
          case "image/jpeg":  // Both regular and progressive jpegs
          case "image/pjpeg": $src = imagecreatefromjpeg($saveto); break;
          case "image/png":   $src = imagecreatefrompng($saveto); break;
          default:            $typeok = FALSE; break;
        }    
    }

 //   var_dump($_FILES);

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
    }

?>

<div class="main-field">  
    <div class="container-fluid " >
        <div class="container data-field">
            <div class="row">
                <div class="col-sm-8 blog-main">
                    <div class="profile-field">
                            <h3 class="form-signin-heading profile-title">Ваш профиль</h3>
                            <br>
                            <span class="pull-sm-left">Профиль создан</span>
                            <span class="profile-meta pull-sm-right">January 1, 2014</span>
                            <br style="clear: both;">
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
                        <br style="clear: both;">
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
                        <br style="clear: both;">
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
                                    <input type="password" id="password"  placeholder="Пароль" required autofocus>
                                </div>
                                <div class="col-xs-2" >
                                    <button type="button" class="btn pull-right" >Применить</button>
                                </div>
                            </div>
                        </form>
                        <br style="clear: both;">
                <!--        <div class="row">
                            <form class="form-signin" method= 'post' action='profile.php' enctype='multipart/form-data'>
                                <div class="col-xs-4">
                                    <label for="">Фото профиля</label>
                                </div>
                                <div class="col-xs-6">
                                    <input type='file' name='image' size='12'>
                                </div>
                                <div class="col-xs-2" >
                                    <button type="submit" class="btn pull-right" >Применить</button>
                                </div>
                            </form>
                        </div> -->
                        <hr>
                        <input type="file" />
                        <img class="crop" style="display:none" />
                        <button type="submit" style="display:none">Upload</button>          
                        <hr>
                        <?php 
                        //    showProfile($user);
                        ?>

                        <br style="clear: both;">
                        <div style="clear: both;"> </div>

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