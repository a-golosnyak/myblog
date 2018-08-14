<?php
    session_start();

    require_once  'login.php' ;         // Проверяем авторизирован ли пользователь
    require_once  'functions.php' ;     //

    $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if ($connection->connect_error)
    {
        echo "Не получилось соединиться с базой данных." . "<br>";
        die($connection->connect_error);
    }

    require_once  'header.php' ;                
    require_once  'navigation.php' ;

    require_once  'main_field.php' ;  
    require_once  'footer.php' ;  
?>




