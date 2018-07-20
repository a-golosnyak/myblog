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
                <div class="col-sm-8 blog-main">
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
                        <hr style="clear: both;">
                        <div class="row preview-zone">
                            <form class="form-signin" method= 'post' action='profile.php' enctype='multipart/form-data'>
                                    <div class="photo-item">Фото профиля</div>
                                    <input type="file" class="photo-item" id="InpProfilePhoto" name="profileimage" tagName=" aaa " />
                                    <!--button type="submit" class="btn pull-right" >Применить</button-->
                                    <br>
                                    <button type="submit" class="btn pull-right photo-item" id="PhotoSubmit" >Загрузить</button>  
                            </form>
                        </div> 

                        <div class="row">
                        
                     <!--       <div class="col-sm-6">
                                <div id="preview-pane">
                                    <div class="preview-container">
                                        <img src="" class="jcrop-preview" id="PreviewArea" alt="Preview" style="display:none;"/>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <br style="clear: both;">

                        <!--*** Работа с картинкой профиля *********************************************
                        <input type="file" id="InpProfilePhoto" name="profileimage" />
                        <img class="crop" id="ProfilePhoto" style="display:none" />
                        <button type="submit" id="PhotoSubmit" style="display:none">Upload</button>  
                        <div class="ajax-respond"></div>      
                        -->
                        

                        <!-- This is the form that our event handler fills  	DEBUG SECTION ***
						<form id="coords"
							class="coords"
							onsubmit="return false;">

							<div class="inline-labels">
								<label>X1 <input type="text" size="4" id="x1" name="x1" /></label>
								<label>Y1 <input type="text" size="4" id="y1" name="y1" /></label>
								<label>X2 <input type="text" size="4" id="x2" name="x2" /></label>
								<label>Y2 <input type="text" size="4" id="y2" name="y2" /></label>
								<label>W <input type="text" size="4" id="w" name="w" /></label>
								<label>H <input type="text" size="4" id="h" name="h" /></label>
							</div>
						</form>

                        <div style="clear: both;"> </div>
						**************************************************************************-->


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