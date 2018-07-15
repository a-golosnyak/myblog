<?php
    
    session_start();

    require_once  'log.php' ;           // Проверяем авторизирован ли пользователь
    require_once  'functions.php' ;     //

    $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if ($connection->connect_error)
    {
        echo "Не получилось соединиться с базой данных." . "<br>";
        die($connection->connect_error);
    }

    require_once  'header.php' ;                
    require_once  'navigation.php' ;

 /*   if(isset($_GET['view']))
    {
        $view = sanitizeString($_GET['view']);

        switch ($view)
        {
            case REGISTRATION:
                require_once  'registration.php' ;    
            break;

            case EMBEDDED:
                require_once  'emb_articles.php' ; 
            break;

            case CARS:
                require_once  'car_articles.php' ; 
            break;

            case SPORT:
                require_once  'sport_articles.php' ; 
            break;

            case PROFILE:
                require_once  'profile.php' ; 
            break;
        }
    }
    else */
    {
        require_once  'main_field.php' ;  
    }

    require_once  'footer.php' ;  
?>




