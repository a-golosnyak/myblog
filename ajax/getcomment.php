<?php 
    session_start();

    require_once '../functions.php';

    if ($_SESSION['usermail'] == '') 
        die();
    else
    {
        if( (isset($_POST['post_id'])) && 
            (isset($_POST['parent_comment_id'])) && 
            (isset($_POST['comment_body'])))
        {

            $post_id = sanitizeString($_POST['post_id']);
            $parent_comment_id = sanitizeString($_POST['parent_comment_id']);
            $comment_body = sanitizeString($_POST['comment_body']);

            echo $post_id . ' ' . $parent_comment_id . ' ' . $comment_body;
            $usermail = $_SESSION['usermail'];

            //--- Получаем данные по автору статьи --------------------------------------
            $result = queryMysql("SELECT * FROM users WHERE usermail='$usermail'");
            $row = $result->fetch_assoc();
            $author_id = $row['id'];
            $user_screen_name = $row['screen_name'];

            $date = date("Y-m-d H:i:s");
            $query = "INSERT INTO comments VALUES 
            ('0', '$post_id', '$author_id', '$parent_comment_id', '$date', '$comment_body')";
            $result = $connection->query($query);

            //--- Информационное сообщение ----------------------------------------------
            if($result)                                      
                echo "
                    <div class='alert alert-success' role='alert' style='width: 100%; margin-bottom: 0;'>
                        <div class='container'>
                            <strong>Комментарий добавлен!</strong>
                        </div>
                    </div>";
            else
                echo "
                    <div class='alert alert-warning' role='alert' style='width: 100%; margin-bottom: 0;'>
                        <div class='container'>
                            <strong>Ошибка добавления комментария.</strong>
                        </div>
                    </div>";
            //----------------------------------------------------------------------------*/
        }
    }
?>
