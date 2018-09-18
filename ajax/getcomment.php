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

            echo "sdsdvcsdcvsdcvsdc";
/*            $comment_body = sanitizeString($_POST['comment-body']);
            $art_id = sanitizeString($_POST['art_id']);
            $usermail = $_SESSION['usermail'];

            //--- Получаем данные по автору статьи --------------------------------------
            $result = queryMysql("SELECT * FROM users WHERE usermail='$usermail'");
            $row = $result->fetch_assoc();
            $author_id = $row['id'];
            $user_screen_name = $row['screen_name'];

            $post_id = sanitizeString($_GET['show']);

            $date = date("Y-m-d H:i:s");
            $query = "INSERT INTO comments VALUES 
            ('0', '$art_id', '$author_id', '0','$date', '$comment_body')";
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



/*        if ((isset($_POST['category'])) && (isset($_POST['art_title'])) && (isset($_POST['art_intro']))&& (isset($_POST['post-body'])))
        {
            $category_id   = sanitizeString($_POST['category']);
            $art_title   = sanitizeString($_POST['art_title']);
            $art_intro   = sanitizeString($_POST['art_intro']);
            $post = stripslashes($_POST['post-body']);
            $connection->real_escape_string($post);
            $usermail = $_SESSION['usermail'];

            $result = queryMysql("SELECT * FROM users WHERE usermail='$usermail'");
            $user = $result->fetch_assoc();                     // Способ 1
            $user_id = $user['id'];

            //--- Вставка нового элемента ---------------------------------------------
            $date = date("Y-m-d H:i:s");
            $query = "INSERT INTO posts VALUES 
            ('0', '$user_id', '$category_id', '$date', '$art_title', '$art_intro', ' ' ,'$post')";
            $result = $connection->query($query);

            if($result)                                      
                $status = "Пост получен и готовится к публикации." . $category_id;
            else
                $status = "Ошибка при добавлении поста в базу." . '<br>';
        }
        else
        {
            echo "Нарушена целостность данных. ";
        }

        if( isset( $_FILES['image'] ) )
        {
            ini_set('default_charset','UTF-8');

//          echo var_dump($_FILES) . "<br>";
            $image = $_FILES['image'];
            $imageFormat = explode('/', $image['type']);
            $imageType = $imageFormat[0];
            $imageFormat = $imageFormat[1];

            $art_title_trnslt = translit($art_title);
            $tmp = substr($art_title_trnslt, 0, 5);     // substr делает ошибку с кирилическим текстом.
            $imageName = '../images/posts/'. 
                            date("Y-m-d_His") .'_'. 
                            $tmp .'_'. 
                            mt_rand(0, 1000);

        //    $fileName = $imageName . '.' . $imageFormat;
            $fileName = $imageName.'.'.'jpeg';

            queryMysql("UPDATE posts SET art_intro_img = '$fileName' 
                        WHERE pub_date='$date' ");         

            if(copy($_FILES['image']['tmp_name'], $fileName))
                $status .= 'Картинка есть' . '<br>';
            else
                $status .= "Shit happens<br>";       
        }
        $status .= $fileName . '<br>';
        echo $status;*/
    }

?>
