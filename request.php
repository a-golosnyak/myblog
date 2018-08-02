<?php
    session_start();
    require_once  'log.php' ;            // Проверяем авторизирован ли пользователь
    require_once  'functions.php' ;  
//    if (!$userLoggedIn) 
//        die();

    if( isset( $_FILES['file'] ) )
    {
        echo var_dump($_FILES) . "<br>";

        $image = $_FILES['file'];
        $imageFormat = explode('/', $image['type']);
        $imageType = $imageFormat[0];
        $imageFormat = $imageFormat[1];
//        $imageName = 'images/ava/'. $usermail .'_'. date("Y-m-d_His");
        $imageName = 'images/ava/'. $usermail;

        $fileName = $imageName . '.' . $imageFormat;

        if(copy($_FILES['file']['tmp_name'], $fileName))
            echo "Looks like success<br>";
        else
            echo "Shit happens<br>";
    }
?>