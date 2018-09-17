<?php
    require_once 'main.php' ; 

    $author_id = '';

    //--- Этот запрос приходит из списка статей на открытие конкретной статьи. ---------------
    if(isset($_GET['show']))
    {
        if($_GET['show'] != 'user_articles')
        {
            $art_id = sanitizeString($_GET['show']);
            $usermail = $_SESSION['usermail'];

            //--- Получаем данные по автору статьи -----------------------------------
            $result = queryMysql("SELECT * FROM users WHERE usermail='$usermail'");
            $row = $result->fetch_assoc();
            $author_id = $row['id'];
            $user_screen_name = $row['screen_name'];

            //--- Получаем статью ----------------------------------------------------
            $result = queryMysql("SELECT * FROM posts WHERE id='$art_id'");
            $num_posts = mysqli_num_rows($result);  
            $row = $result->fetch_assoc();

            if($posts == '0')                       // Если поста с нужным id в базе не обнаружено
            {
                echo "<div class='alert alert-warning' role='alert' style='width: 100%; margin-bottom: 0; display: block;'>
                            <div class='container'>
                                <strong id='ErrorMessage'>Такой статьи не существует.</strong>
                            </div>
                        </div>";
                die();
            }

            $pub_date = $row['pub_date'];
            $pub_date = preg_replace( "#(:\d+):\d+#", '$1', $pub_date ); 
            $title = $row['title'];
            $art_intro = $row['art_intro'];
            $art_intro_img = $row['art_intro_img'];
            $post_body = $row['post_body'];
        }
    }
/*    else        // Если поле show не приходит, не выводим ничего
    {
        die();
    }   */

    //--- Этот запрос пиходит из этого же файла ----------------------------------------------
    if(isset($_POST['comment-body']))
    {
        $comment_body = sanitizeString($_POST['comment-body']);
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

        if($result)                                      
            echo "Comment created.";
        else
            echo "Comment creation error.";
    }
?>

<div class='main-field style='background-color: lightgrey;'>  
    <div class='container-fluid ' >
        <div class='container data-field'>
            <div class='row'>
                <div class='col-md-8 blog-main'>
<?php               
                echo "  <div class='blog-post'>
                        <h4 class='blog-post-title'> $title </h4>
                        <p class='blog-post-meta'>$pub_date автор $user_screen_name $num_posts $art_id
                            <a href='#'></a>
                        </p>
                        <p>$art_intro</p>
                        <p><img class='post-preview-img' src='$art_intro_img'></p>
                        <br>
                        <p>$post_body</p>
                        <br>
                        <div class='social-links'>
                            <div class='row'>
                                <div class='pull-xs-left'>
                                    <a href='https://vk.com/share.php?url=http://myblog/article.php?show=55' class='social-vk' target='_blank'>
                                    <img src='/images/000078_social_3d_cubs1_vk.png'>
                                    </a>
                                </div>
                                <div class='pull-xs-left'>
                                    <a href='https://www.facebook.com/sharer.php?url=http://myblog/article.php?show=55&amp;t=<?php the_title(); ?>' class='social-fb' target='_blank'>
                                    <img src='/images/000078_social_3d_cubs1_fb.png'>
                                    </a>
                                </div>
                                <div class='pull-xs-left'>
                                    <a href='http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=<?php the_permalink(); ?>&st.comments=<?php the_title(); ?>' class='social-ok' target='_blank'>
                                        <img src='/images/000078_social_3d_cubs1_ok.png'>
                                    </a>
                                </div>
                                <div class='pull-xs-left'>
                                    <a href='http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>&title=<?php the_title(); ?>&summary=&source=<?php bloginfo('name'); ?>
                                        <img src='/images/000078_social_3d_cubs1_linkedin.png'>
                                    </a>
                                </div>
                                <span class='repost-notification'>Если Вам понравилась или была полезной эта статься, можно сделать репост в социальные сети.
                                </span>
                            </div>
                        </div>
                    </div>";
?>
<?php
                if($userLoggedIn == true)
                {
                    echo "
                    <form class='comments-main' action='article.php?show=$art_id' method='post'>
                        <div class='title-input'>
                            <textarea class='intro-box' id='' name='comment-body'  rows='5' maxlength='1000' placeholder='Комментарий''></textarea>
                        </div>
                        <input type='hidden' name='art_id' value='$art_id'>
                        <button type='submit' class='comment-btn pull-xs-right' style='text-align: center;'>Добавить комментарий</button>
                        <div style='clear: both;''>
                            
                        </div>
                    </form>";
                }
                else
                {
                    echo "<div class='comments-main'>
                        <div class='title-input'>
                            Выполните вход, чтобы оставить комментарий.
                        </div>
                    </div>";
                }
?>
<?php
                //--- Получаем данные по КОММЕНТАРИЯМ  -----------------------------------------
                $result = queryMysql("SELECT * FROM comments WHERE post_id='$art_id'");
                $num_comments = mysqli_num_rows($result);  

                while($row = $result->fetch_assoc())
                {
                    $comment_id = $row['id'];
                    $author_id = $row['author_id'];
                    $pub_date = $row['pub_date'];
                    $comment_body = $row['body'];

                    //--- Получаем данные по автору комментария -------------------------------
                    $result2 = queryMysql("SELECT * FROM users WHERE id='$author_id'");
                    $row2 = $result2->fetch_assoc();
                    $author_mail = $row2['usermail'];
                    $author_screen_name = $row2['screen_name'];

                    //--- Получаем данные по ответу на комментарий ----------------------------
                    $result3 = queryMysql("SELECT * FROM comments WHERE id='$comment_id'");
                    $row3 = $result3->fetch_assoc();
                    $comment_id = $row3['usermail'];
                    $a = $row3['screen_name'];

                    echo "<div class='comments-main'>
                        <div class='row comment'>
                            <div class='col-xs-1'>
                                <img class='avatar'  src='images/ava/$author_mail.jpeg' alt='...'>
                            </div>
                            <div class='col-xs-10 comments1 '>
                                <div style='margin-bottom: 0.2em;'>
                                    <div class='comment-author'>$author_screen_name</div>
                                    <div class='comment-date'>$pub_date</div>
                                </div>
                                <div>$comment_body</div>
                                <br>
                                <button type='submit' class='comment-btn' style='text-align: center;'>Ответить</button>
                                <button type='submit' class='comment-btn' style='text-align: center;'>Удалить</button>
                            <!--    <br>
                                <br>
                                <div class='row '>
                                    <div class='col-xs-1'>
                                        <img class='avatar'  src='images/ava/adm@mail.ru.jpeg' alt='...'>
                                    </div>

                                    <div class='col-xs-10 comments1 '>
                                        <div style='margin-bottom: 0.2em;'>
                                            <div class='comment-author'>
                                                Василий
                                            </div>
                                             <div class='comment-date'>
                                                2018-09-14 11:48
                                            </div>
                                        </div>
                                        <div>
                                            Именно такую терминологию обычно можно встретить в разных программах-эквалайзерах, используемых для настройки звука. Теперь вы знаете, что красивые графики из таких программ являются именно амплитудно-частотными характеристиками, с которыми мы познакомились в сегодняшней статье 🙂
                                        </div>
                                        <br>
                                        <button type='submit' class='comment-btn' style='text-align: center;'>Ответить</button>
                                        <button type='submit' class='comment-btn' style='text-align: center;'>Удалить</button>
                                        <br>
                                    </div>  
                                </div>
                                -->
                            </div>
                        </div>
                    </div>" ;
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
