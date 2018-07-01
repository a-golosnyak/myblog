<!DOCTYPE html>
<html>
    <head>
        <title>Setting up database for TestBlog</title>
    </head>
    <body>
        <h3>Setting up...</h3>

        <?php
        require_once 'functions.php';

        //=== Проверяем есть ли наша база данных, если нет - создаем === CREATE DATABASE =====
        $link = mysqli_connect('127.0.0.1', 'root', '');            // Соединяемся с сервером
        if(!$link)
        {
            echo "Report 1. Connection problems. ";
            $die('Couldnt connect: ' . mysqli_error());
        }
        $db_selected = mysqli_select_db( $link, 'test_blog_db');    // Пытаемся выбрать базу
        if(!$db_selected)
        {
            $query = "CREATE DATABASE test_blog_db";  
            $result = mysqli_query($link, $query);                  // Запрос без создания сущности
            echo "Database created.";
        }
        else
            echo "DB exists.";
        echo "<br>";

        //=== Работаем по созданию нужной нам таблицы ============ CREATE TABLE ==============
        $connection = new mysqli('localhost', 'root', '', 'test_blog_db');
        if ($connection->connect_error)
            die("Connectio attemt denied " . $connection->connect_error);

        $query = 'CREATE TABLE IF NOT EXISTS user (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user VARCHAR(16),
                password VARCHAR(16),
                screen_name VARCHAR(16))';

        $result = $connection->query($query);

        if($result)                     /* if($result)  - если все нормально. if(!$result) - если что-то не так */
        {                                        
            echo "Table created.";
            print_r($result);
            echo "<br>";
        }
        else
           echo "Table creation error.";

       //=== Создаем элементы таблицы ================================ INSERT ================
        $query = "INSERT INTO user VALUES ('1', 'admin', '1111', 'adm')";   // id=1 уже есть. Будет ошибка.
        $result = $connection->query($query);

        if($result) echo "Item created.";
        else        echo "Item creation error.";
        echo "<br>";

        $uniq_str = RandString(2);

        //--- Вставка нового элемента ---------------------------------------------
        $query = "INSERT INTO user VALUES (
                   '0', 'Vasya" . $uniq_str . "', '1111', 'Vas" . $uniq_str . "')";
        $result = $connection->query($query);

        if($result)                                      
            echo "Item created.";
        else
           echo "Item creation error.";
        echo "<br>";    

        //=== Создаем элементы таблицы =========================== INSERT IF NOT EXIST - =====
/*        $query = "INSERT INTO user (user, password, screen_name)
                    SELECT * FROM (SELECT \'Vasya1\', \'111\', \'Vas\') AS tmp 
                    WHERE NOT EXISTS (
                        SELECT user FROM user WHERE name = \'Vasya\') LIMIT 1";
        $result = $connection->query($query);

        if($result)                                      
            echo "Item created." . $connection->connect_error;
        else
           echo "Item creation error." . $connection->errno;
        echo "<br>";
*/
        //=== Выбираем элементы из таблицы SELECT ALL ============ SELECT ALL ================
        $query = "SELECT * FROM user";
        $result = $connection->query($query);

//        print_r(mysqli_fetch_array($result, MYSQL_ASSOC));
        echo "<br>";

        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
//            print_r($result);                   // Выводит mysqli_result обьект 
//            print_r($row);                      // Выводит асоциативный массив строкой
//            echo($row);                         // Выводит что это Array
//            echo $row['id'] . ': ' . $row['user'] . "\n";
//            echo "<br>";
        }

        //=== Показать таблицы SHOW TABLES ========================= SHOW TABLES =============
        $query = "SHOW TABLES";
        $result = $connection->query($query);
 /*       echo "<pre>";
        print_r($result);
        echo "</pre>";  */
            /*  Выводит это
                mysqli_result Object
                (
                    [current_field] => 0
                    [field_count] => 1
                    [lengths] => 
                    [num_rows] => 1
                    [type] => 0
                )
            */
        echo "<br>";

        $query = "DESCRIBE user";
        $result = $connection->query($query);
/*      echo "<pre>";
        print_r($result);
        echo "</pre>";  */
        echo "<br>";
        //====================================================================================
        $query = "SELECT user FROM user WHERE screen_name='Vas'";
        $result = $connection->query($query);

        while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            print_r($row);                          // Выводит асоциативный массив строкой
            echo "<br>";
        }
        echo "<br>";

        //====================================================================================
        //====================================================================================
        //====================================================================================
        //====================================================================================
        mysqli_free_result($result);
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