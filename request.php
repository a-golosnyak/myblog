<?php
//    header("Content-type: text/txt; charset=UTF-8");
//    echo var_dump($_POST) . "<br>";

//    echo var_dump($_FILES) . "<br>";
//    require_once 'main.php';

//    if(isset($_FILES) && isset($_FILES['file']))
    if( isset( $_FILES['file'] ) )
    {
//      echo var_dump($_FILES) . "<br>";
        $image = $_FILES['file'];
        $imageFormat = explode('/', $image['type']);
        $imageType = $imageFormat[0];
        $imageFormat = $imageFormat[1];
        $imageName = 'images_' .  date("Y-m-d His");

        $fileName = $imageName . '.' . $imageFormat;

        if(copy($_FILES['file']['tmp_name'], $fileName))
            echo "Looks like success<br>";
        else
            echo "Shit happens<br>";
    }
?>