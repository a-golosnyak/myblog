<!DOCTYPE html>
<html>
    <head>
        <title>Setting up database for TestBlog</title>
    </head>
    <body>
        <h3>Setting up...</h3>

        <?php
        require_once 'functions.php';

        //--- Проверяем есть ли наша база данных, если нет - создаем --------------------
        $link = mysqli_connect('localhost', 'root', '');

        if(!$link)
            $die('Couldnt connect: ' . mysql_error());

        $db_selected = mysqli_select_db( $link, 'test_blog_db');

        if($db_selected != true)
            $query = 'CREATE DATABASE test_blog_db';    

        //--- Работаем по созданию нужной нам таблицы -----------------------------------
        $connection = new mysqli('localhost', 'root', '');

        if ($connection->connect_error){
            echo "Не получилось соединиться с базой данных." . "<br>";
            die($connection->connect_error);
        }

        $query = "SELECT * FROM user";
        $query = "CREATE TABLE IF NOT EXISTS user,
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user VARCHAR(16),
                password VARCHAR(16),
                screen_name VARCHAR(16)";

        $result = $connection->query($query);

        if($result)
        {
            echo "print_r ";
            print_r($result);
            echo "<br>";

            echo "echo";
            echo $result;
            echo "<br>";
        }
        else
           echo "error "; 

        /*        createTable('members',
        'user VARCHAR(16),
        pass VARCHAR(16),
        INDEX(user(6))');

        createTable('messages', 
        'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        auth VARCHAR(16),
        recip VARCHAR(16),
        pm CHAR(1),
        time INT UNSIGNED,
        message VARCHAR(4096),
        INDEX(auth(6)),
        INDEX(recip(6))');

        createTable('friends',
        'user VARCHAR(16),
        friend VARCHAR(16),
        INDEX(user(6)),
        INDEX(friend(6))');

        createTable('profiles',
        'user VARCHAR(16),
        text VARCHAR(4096),
        INDEX(user(6))');
        
*/
        ?>
        <br>...done.
    </body>
</html>
