<?php
    require_once 'main.php' ; 

    $author_id = '';

    if(isset($_GET['show']))
    {
        if($_GET['show'] == 'user_articles')
        {
            if ($_SESSION['usermail'] != '') 
            {
                $usermail = $_SESSION['usermail'];

                $result = queryMysql("SELECT * FROM users WHERE usermail='$usermail'");
                $row = $result->fetch_assoc();
             
                $author_id = $row['id'];
                $user_screen_name = $row['screen_name'];

                $result = queryMysql("SELECT * FROM posts WHERE author_id='$author_id' ORDER BY pub_date DESC" );
                $posts = mysqli_num_rows($result);
            }   
        }
    }
    else        // Если поле show не приходит, выводим все статьи подряд.
    {
        $result = queryMysql("SELECT P.id, P.pub_date, P.title, P.art_intro, P.art_intro_img, U.screen_name FROM posts P INNER JOIN users U ON P.author_id = U.id ORDER BY P.pub_date DESC" );
        $posts = mysqli_num_rows($result);
    }
    
?>


<div class='main-field style='background-color: lightgrey;'>  
    <div class='container-fluid ' >
        <div class='container data-field'>
            <div class='row'>
                <div class='col-md-8 blog-main'>
<?php              
                    while($row = $result->fetch_assoc())
                    {
/*                      echo "<pre>";
                        var_dump($row);
                        echo "</pre>";     
*/
                        $art_id = $row['id'];
                        $pub_date = $row['pub_date'];
                        $pub_date = preg_replace( "#(:\d+):\d+#", '$1', $pub_date ); 
                        $title = $row['title'];
                        $art_intro = $row['art_intro'];
                        $art_intro_img = $row['art_intro_img'];
                        $screen_name = $row['screen_name'];

                        echo "  <div class='blog-post'>
                                    <h4 class='blog-post-title'> $title </h4>
                                    <p class='blog-post-meta'>$pub_date автор $screen_name<a class='none-decored' href='#'></a>
                                    </p>
                                    <div style='display: none;'>$art_id</div>
                                    <p>$art_intro</p>
                                    <p><img class='post-preview-img' src='$art_intro_img'></p>
                                    <br>
                                    <div class='post-footer'>
                                        <form class='pull-xs-left ' action='article.php' method='get'>
                                            <button type='submit' class='read-more-btn' style='text-align: center;'>Читать далее...</button>
                                            <input type='hidden' name='show' value='$art_id'>
                                        </form>

                                        <div class='pull-xs-right offset-xs-1 show-comments'>Комментарии</div>
                                    </div>
                                    <br style='clear: both;''>
                                    <hr>
                                    <br>
                                </div>";
                    }
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
