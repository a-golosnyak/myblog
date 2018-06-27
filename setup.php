<!DOCTYPE html>
<html>
    <head>
        <title>Setting up database for TestBlog</title>
    </head>
    <body>
        <h3>Setting up...</h3>

        <?php
        require_once 'functions.php';

        //=== CREATE DATABASE ================================== test_blog_db ================
        $link = mysqli_connect('127.0.0.1', 'root', '');            // Соединяемся с сервером
        if(!$link)
            $die('Report 1. Connection problems. ' . mysqli_error());
        
        $db_selected = mysqli_select_db( $link, 'test_blog_db');    // Пытаемся выбрать базу
        if(!$db_selected)
        {
            $query = "CREATE DATABASE test_blog_db";  
            $result = mysqli_query($link, $query);                  // Запрос без создания сущности
            echo "Database test_blog_db created.";
        }
        else
            echo "DB test_blog_db exists.";
        echo "<br>";

        //=== CREATE TABLE ================================== users ==========================
        $connection = new mysqli('localhost', 'root', '', 'test_blog_db');
        if ($connection->connect_error)
            die("Connectio attemt denied " . $connection->connect_error);

        $query = 'CREATE TABLE IF NOT EXISTS users (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user VARCHAR(16),
                password VARCHAR(16),
                screen_name VARCHAR(16))';

        $result = $connection->query($query);

        if($result)          /* if($result)  - если все нормально. if(!$result) - если что-то не так */
        { 
            print_r("Table users created." . $result . "<br>");
        }
        else
           echo "Table creation error.";

        //=== CREATE TABLE ================================== posts ==========================
        $connection = new mysqli('localhost', 'root', '', 'test_blog_db');
        if ($connection->connect_error)
            die("Connectio attemt denied " . $connection->connect_error);

        $query = 'CREATE TABLE IF NOT EXISTS posts (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user VARCHAR(16),
                password VARCHAR(16),
                screen_name VARCHAR(16))';

        $result = $connection->query($query);

        if($result)          /* if($result)  - если все нормально. if(!$result) - если что-то не так */
        { 
            print_r("Table users created." . $result . "<br>");
        }
        else
           echo "Table creation error.";

        //=== Показать таблицы SHOW TABLES ========================= SHOW TABLES =============
        $query = "DESCRIBE user";
        $result = $connection->query($query);
        echo "<pre>";
        print_r($result);
        mysqli_fetch_array($result, MYSQL_ASSOC);
        echo "</pre>";  
        echo "<br>";
        
/*
        createTable('user',
        'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user VARCHAR(16),
        password VARCHAR(16),
        screen_name VARCHAR(16)');

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
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>