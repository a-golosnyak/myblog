<?php
            require_once  'log.php' ;           // Проверяем авторизирован ли пользователь
            require_once  'functions.php' ;     //

            $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

            if ($connection->connect_error){
                echo "Не получилось соединиться с базой данных." . "<br>";
                die($connection->connect_error);
            }

            require_once  'header.php' ;                
            require_once  'navigation.php' ;

            if(isset($_POST['view']))
            {
                $view = sanitizeString($_GET['view']);
                
                if ($view == 1) 
                {
                    # code...
                }

            }
            else
            {
                require_once  'main_field.php' ;  
            }

            require_once  'footer.php' ;  
        ?>
        