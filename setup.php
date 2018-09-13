<!DOCTYPE html>
<html>
    <head>
        <title>Setting up database for TestBlog</title>
    </head>
    <body>
        <h3>Setting up...</h3>

        <?php
		require_once 'db.php';

        //=== CREATE DATABASE ================================== test_blog_db ==========================
        $link = mysqli_connect($dbhost, $dbuser, $dbpass);            // Соединяемся с сервером
        if(!$link)
            $die('Report 1. Connection problems. ' . mysqli_error());
        
        $db_selected = mysqli_select_db( $link, $dbname);    // Пытаемся выбрать базу
        
        if(!$db_selected)
        {
            $query = "CREATE DATABASE test_blog_db DEFAULT CHARACTER SET utf8";  
            $result = mysqli_query($link, $query);                  // Запрос без создания сущности
            echo "Database test_blog_db created.";
        }
        else
            echo "DB test_blog_db exists.";
        echo "<br>";

        //=== CREATE TABLE ================================== users ====================================
        $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
        if ($connection->connect_error)
            die("Connectio attemt denied " . $connection->connect_error);

        $query = 'CREATE TABLE IF NOT EXISTS users (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                usermail VARCHAR(30),
                password VARCHAR(40),
                screen_name VARCHAR(30),
                creation_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP)';

        $result = $connection->query($query);

        if($result)          /* if($result)  - если все нормально. if(!$result) - если что-то не так */
        { 
            print_r("Table users created." . $result . "<br>");
        }
        else
           echo "Table users creation error.";

        //=== CREATE TABLE ================================== posts ====================================
        $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
        if ($connection->connect_error)
            die("Connectio attemt denied " . $connection->connect_error);

        $query = 'CREATE TABLE IF NOT EXISTS posts (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                author_id INT UNSIGNED,
                category_id INT UNSIGNED,
                pub_date DATETIME DEFAULT NULL,
                title VARCHAR(220),
                art_intro VARCHAR(1200),  
                art_intro_img VARCHAR(255),
                post_body TEXT)';

        $result = $connection->query($query);

        if($result)          /* if($result)  - если все нормально. if(!$result) - если что-то не так */
        { 
            print_r("Table posts created." . $result . "<br>");
        }
        else
           echo "Table posts creation error.";

        //=== CREATE TABLE ================================== category ================================
        $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
        if ($connection->connect_error)
            die("Connectio attemt denied " . $connection->connect_error);

        $query = 'CREATE TABLE IF NOT EXISTS category (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                category_name VARCHAR(255))';

        $result = $connection->query($query);

        if($result)          /* if($result)  - если все нормально. if(!$result) - если что-то не так */
        { 
            print_r("Table category created." . $result . "<br>");
        }
        else
           echo "Table category creation error.<br>";

        //=== Создаем пользователей =================================== INSERT ========================
		$date = date("Y-m-d H:i:s");
        $query = "INSERT INTO users VALUES ('1', '$adminmail', '111', 'adm', '$date')";   // id=1 уже есть. Будет ошибка.
        $result = $connection->query($query);

        if($result) echo "adm created.";
        else        echo "adm creation error.";
        echo "<br>";

        //$uniq_str = RandString(2);
        $uniq_str = mt_rand(0, 9);

        //--- Вставка нового элемента ---------------------------------------------
        $newName = 'Vasya' . $uniq_str . '@gmail.com';
        $query = "INSERT INTO users VALUES (
                   '0', '$newName', '1111', 'Vas" . $uniq_str . "', '$date')";
        $result = $connection->query($query);

        if($result)      
        {                   
            $file = "images/ava/Guest.jpg";
            $newFile = "images/ava/$newName.jpeg";

            //--- Присваеваем новому профилю стандартную картпинку --------------------------------
            if (copy($file, $newFile))          // Делаем копию файла        
                $status = "";
            else
                $status = "err01";

            echo "User created." . $status;
        }
        else
           echo "User creation error.";
        echo "<br>";

        //=== Создаем посты ========================================= INSERT ==========================
/*        $randPost = RandString(20);
        $randTitle = 'string';

        for($i=0; $i<5; $i++)
            $randTitle[$i] = $randPost[$i]; 

        echo $randPost;
        echo "<br>";
        echo $randTitle;
        echo "<br>";

        //--- Вставка нового элемента ---------------------------------------------
        $date = date("Y-m-d H:i:s");
        $category = mt_rand(1, 3);
        $query = "INSERT INTO posts VALUES 
        ('0', '4', '$category','$date','titl ". $randTitle ."', 'art preview' , 'img' , 'postik ". $randPost ."')";
        $result = $connection->query($query);

        if($result)                                      
            echo "Post created.";
        else
            echo "Post creation error.";
        echo "<br>";    */

        //=== Создаем рубрики ======================================= INSERT ==========================
        $query = "INSERT INTO category VALUES 
        ('1', 'Микроконтроллеры STM32')";
        $result = $connection->query($query);

        $query = "INSERT INTO category VALUES 
        ('2', 'Программирование Linux')";
        $result += $connection->query($query);

        $query = "INSERT INTO category VALUES 
        ('3', 'ЧПУ')";
        $result += $connection->query($query);

        $query = "INSERT INTO category VALUES 
        ('4', 'Разное')";
        $result += $connection->query($query);

        if($result)                                      
            echo "Category created.";
        else
            echo "Category creation error.";
        
        echo "<br>";


        
/*
        createTable('user',
        'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user VARCHAR(16),
        password VARCHAR(16),
        screen_name VARCHAR(16)');

        createTable('members',
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


<?php

/**********************************************************************
  * @brief  Функция возвращает случайную строку.
  * @param  length - длинна строки 
  * @retval Собственно строка.
   ********************************************************************/
function RandString($length = 2)
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';       // 0123456789
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>