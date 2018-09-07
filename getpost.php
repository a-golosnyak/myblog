<?php 
    session_start();

    require_once 'functions.php';

    if ($_SESSION['usermail'] == '') 
        die();
    else
    {
        if ((isset($_POST['category'])) && (isset($_POST['art_title'])) && (isset($_POST['post-body'])))
        {
            $category_id   = sanitizeString($_POST['category']);
            $art_title   = sanitizeString($_POST['art_title']);
            $post   = sanitizeString($_POST['post-body']);
            $usermail = $_SESSION['usermail'];

            $result = queryMysql("SELECT * FROM users WHERE usermail='$usermail'");
            $user = $result->fetch_assoc();                     // Способ 1
            $user_id = $user['id'];

            //--- Вставка нового элемента ---------------------------------------------
            $date = date("Y-m-d H:i:s");
            $query = "INSERT INTO posts VALUES 
            ('0', '$user_id', '$category_id', '$date', '$art_title', '$post')";
            $result = $connection->query($query);

            if($result)                                      
                echo "Пост получен и готовится к публикации." . $category_id;
            else
                echo "Ошибка при добавлении поста в базу.";
        }
        else
        {
            echo "Нарушена целостность данных. ";
        }
    }

?>
