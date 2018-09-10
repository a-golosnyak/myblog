<?php 
    session_start();

    require_once 'functions.php';

    if ($_SESSION['usermail'] == '') 
        die();
    else
    {
        if ((isset($_POST['category'])) && (isset($_POST['art_title'])) && (isset($_POST['art_intro']))&& (isset($_POST['post-body'])))
        {
            $category_id   = sanitizeString($_POST['category']);
            $art_title   = sanitizeString($_POST['art_title']);
            $art_intro   = sanitizeString($_POST['art_intro']);
            $post   = sanitizeString($_POST['post-body']);
            $usermail = $_SESSION['usermail'];

            $result = queryMysql("SELECT * FROM users WHERE usermail='$usermail'");
            $user = $result->fetch_assoc();                     // Способ 1
            $user_id = $user['id'];

            //--- Вставка нового элемента ---------------------------------------------
            $date = date("Y-m-d H:i:s");
            $query = "INSERT INTO posts VALUES 
            ('0', '$user_id', '$category_id', '$date', '$art_title', 'art_intro', ' ' ,'$post')";
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
//          echo var_dump($_FILES) . "<br>";
            $image = $_FILES['image'];
            $imageFormat = explode('/', $image['type']);
            $imageType = $imageFormat[0];
            $imageFormat = $imageFormat[1];
            $imageName = 'images/posts/'. substr($art_title, 0, 5) .'_'. date("Y-m-d_His") .'_'. mt_rand(0, 1000);

            $status .= $imageName . '<br>';
            $status .= $imageFormat . '<br>';
            $fileName = $imageName . '.' . $imageFormat;

            queryMysql("UPDATE posts SET art_intro_img = '$fileName' 
                        WHERE pub_date='$date' ");

            $status .= $imageName . '<br>';

/*            if(copy($_FILES['image']['tmp_name'], $fileName))
                $status .= 'Картинка есть' . '<br>';
            else
                $status .= "Shit happens<br>";    */    
        }
/*        $status .= $_POST['category'] . '<br>';
        $status .= $_POST['art_title'] . '<br>';
        $status .= $_POST['art_intro'] . '<br>';
        $status .= var_dump($_FILES) . '<br>';  */
        echo $status;
    }

?>
