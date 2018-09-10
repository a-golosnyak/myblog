<?php
    require_once  'main.php' ; 

    if (!$userLoggedIn) 
        die();
    else
    {
        $result = queryMysql("SELECT * FROM users WHERE usermail='$usermail'");
        $row = $result->fetch_assoc();
     
        $author_id = $row['id'];
        $user = $row['usermail'];

        $result = queryMysql("SELECT * FROM posts ORDER BY pub_date DESC" );
        $posts = mysqli_num_rows($result);
        $row = $result->fetch_assoc();

        $pub_date = $row['pub_date'];
        $pub_date = preg_replace( "#(:\d+):\d+#", '$1', $pub_date ); 
        $title = $row['title'];
        $art_intro = $row['art_intro'];
        $art_intro_img = $row['art_intro_img'];
        $post_body = $row['post_body'];

/*        echo "DB : "; 
        print_r($pl_usermail);
        echo "<br>"; 
        print_r($pl_password);
        echo "<br>";
        print_r($pl_screen_name);
        echo "<br>"; 
        print_r($pl_creation_date);
        echo "<br>";    */   
    }
?>


    <div class='main-field style='background-color: lightgrey;'>  
    <div class='container-fluid ' >
        <div class='container data-field'>
            <div class='row'>
                <div class='col-md-8 blog-main'>
<?php                
                echo '<pre>';
                var_dump($row);
                echo '</pre>';

                echo  "<p>$posts</p>" ; 

                echo  "<p>$user</p>" ;           
                echo  "<p>$title</p>" ;
                echo  "<p>$pub_date</p>" ;
                echo  "<p>$art_intro_img</p>" ;
                echo  "<p><a href='$art_intro_img'></p>" ;
                echo  "<p>$art_intro</p>" ;
                echo  "<p>$post_body</p>" ;
?>
                </div><!-- /.blog-main -->
                <?php 
                    require_once "sidebar.php";
                ?>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>
</div>

<?php
    require_once 'footer.php'

?>