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
            //--- Получаем статью ----------------------------------------------------
            $result = queryMysql("SELECT 
                                    U.id AS u_id, 
                                    U.screen_name, 
                                    P.pub_date, 
                                    P.title, 
                                    P.art_intro, 
                                    P.art_intro_img, 
                                    P.post_body 
                                FROM posts P 
                                INNER JOIN users U 
                                    ON P.author_id=U.id 
                                    WHERE P.id='$art_id'");
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

            $author_id = $row['u_id'];
            $user_screen_name = $row['screen_name'];
            $pub_date = $row['pub_date'];
            $pub_date = preg_replace( "#(:\d+):\d+#", '$1', $pub_date ); 
            $title = $row['title'];
            $art_intro = $row['art_intro'];
            $art_intro_img = $row['art_intro_img'];
            $post_body = $row['post_body'];
        }
    }
?>

<div class='alert alert-warning' role='alert' style='width: 100%; margin-bottom: 0; display: none;'>
    <div class='container'>
        <strong id='ErrorMessage'>Не заполнены некоторые поля.</strong>
    </div>
</div>
<div class='main-field style='background-color: lightgrey;'>  
    <div class='container-fluid ' >
        <div class='container data-field'>
            <div class='row'>
                <div class='col-md-8 blog-main'>
<?php               
                echo "  <div class='blog-post'>
                        <h4 class='blog-post-title'> $title </h4>
                        <p class='blog-post-meta'>$pub_date автор $user_screen_name
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
                    <form id='$replyId' style='display: block;'>
                        <div class='title-input'>
                            <textarea class='intro-box' id='' name='comment_body'  rows='5' maxlength='1000' placeholder='Комментарий''></textarea>
                        </div>
                        <input id='' type='hidden' name='art_id' value='$art_id'>
                        <input id='' type='hidden' name='parent_comment_id' value='0'>
                        <button  class='comment-btn pull-xs-right'  onclick = 'return TimeToSendComment(art_id,  parent_comment_id, comment_body)'>Добавить комментарий</button>
                                    <div style='clear: both;'></div>

                        <div style='clear: both;''></div>
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
                //--- Получаем данные по КОММЕНТАРИЯМ и АВТОРАМ комментариев ------------------
                $result = queryMysql("SELECT 
                                    C.id,
                                    C.pub_date,
                                    C.body,
                                    U.usermail,
                                    U.screen_name
                                FROM comments C 
                                INNER JOIN users U 
                                    ON C.author_id=U.id 
                                    WHERE C.post_id='$art_id'
                                    AND C.parent_comment_id=0
                                    ORDER BY C.pub_date ASC");
                $num_comments = mysqli_num_rows($result);  

                while($row_comment = $result->fetch_assoc())
                {
                    $parent_comment_id = $row_comment['id'];
                    $author_id = $row_comment['usermail'];
                    $pub_date = $row_comment['pub_date'];
                    $pub_date = preg_replace( "#(:\d+):\d+#", '$1', $pub_date); 
                    $comment_body = $row_comment['body'];
                    $author_mail = $row_comment['usermail'];
                    $author_screen_name = $row_comment['screen_name'];
                    $replyId = 'reply_' . $parent_comment_id;

                    echo "<div class='comments-main'>
                        <div class='row comment'>
                            <div class='col-sm-1'>
                                <img class='avatar'  src='images/ava/$author_mail.jpeg' alt='...'>
                            </div>
                            <div class='col-sm-10 comments1' >
                                <div style='margin-bottom: 0.2em;'>
                                    <div class='comment-author'>$author_screen_name</div>
                                    <div class='comment-date'>$pub_date</div>
                                </div>
                                <div>$comment_body</div>
                                <br>
                                <button class='comment-btn'  onclick=ShowReplyInput('$replyId','$author_screen_name')>Ответить</button>";
                    if(strcmp($author_mail, $usermail) == 0)
                    {         
                        echo "  <button  class='comment-btn pull-xs-right' onclick=deleteComment('$parent_comment_id')>Удалить</button> ";
                    }

                    echo   "    <form id='$replyId' style='display: none;'>
                                    <textarea class='intro-box' id='' name='comment_body'  rows='5' maxlength='1000' placeholder='Комментарий''></textarea>
                                    <input id='' type='hidden' name='art_id' value='$art_id'>
                                    <input id='' type='hidden' name='parent_comment_id' value='$parent_comment_id'>
                                    <button  class='comment-btn pull-xs-right' onclick = 'return TimeToSendComment(art_id,  parent_comment_id, comment_body)'>Добавить комментарий</button>
                                <div style='clear: both;'></div>
                                </form>
                                ";         
                    //--- Получаем данные по ответу на комментарий ---------------------------- 
                    $result2 = queryMysql("SELECT 
                                    C.id,
                                    C.pub_date,
                                    C.body,
                                    U.usermail,
                                    U.screen_name
                                FROM comments C 
                                INNER JOIN users U 
                                    ON C.author_id=U.id 
                                    WHERE C.post_id='$art_id'
                                    AND C.parent_comment_id='$parent_comment_id'
                                    ORDER BY C.pub_date ASC");

                    if(mysqli_num_rows($result2) >= 1)
                    {
                        while($row_reply=$result2->fetch_assoc())
                        { 
                            $comment_id = $row_reply['id'];
                            $author_id = $row_reply['usermail'];
                            $pub_date = $row_reply['pub_date'];
                            $pub_date = preg_replace( "#(:\d+):\d+#", '$1', $pub_date); 
                            $comment_body = $row_reply['body'];
                            $author_mail = $row_reply['usermail'];
                            $author_screen_name = $row_reply['screen_name'];
                            $replyId = 'reply_' . $comment_id;

                            echo "<div class='row '>
                                        <div class='col-md-1'>
                                            <img class='avatar'  src='images/ava/$author_mail.jpeg' alt='...'>
                                        </div>
                                        <div class='col-md-10 comments1 '>
                                            <div style='margin-bottom: 0.2em;'>
                                                <div class='comment-author'>$author_screen_name</div>
                                                 <div class='comment-date'>$pub_date</div>
                                            </div>
                                            <div>$comment_body</div>
                                            <br>
                                            <button  class='comment-btn' onclick=ShowReplyInput('$replyId','$author_screen_name')>Ответить</button> ";
                    if(strcmp($author_mail, $usermail) == 0)
                    {         
                        echo "              <button  class='comment-btn pull-xs-right' onclick=deleteComment('$comment_id')>Удалить</button> ";
                    }
                            echo "          <form id='$replyId' style='display: none;'>
                                                <textarea class='intro-box' id='' name='comment_body'  rows='5' maxlength='1000' placeholder='Комментарий'' value='xxx'></textarea>
                                                <input id='' type='hidden' name='art_id' value='$art_id'>
                                                <input id='' type='hidden' name='parent_comment_id' value='$parent_comment_id'>
                                                <button  class='comment-btn pull-xs-right' onclick = 'return TimeToSendComment(art_id,  parent_comment_id, comment_body)'>Добавить комментарий</button>
   
                                                <div style='clear: both;'></div>
                                            </form> 
                                        <br>
                                        </div>  
                                    </div>
                                    <br>
                                    ";
                        }
                    }
                    echo "      </div>
                            </div>
                        </div> 
                        ";

                }
?>
                <script type="text/javascript">
                    //--- Принимаем строку со значением идентификатора -----------------------
                    function ShowReplyInput(elem, name)   
                    {
                        elem2 = '#'+elem+' > textarea';
                        commentForm = document.getElementById(elem);

                        if(commentForm.style.display == "block")
                            commentForm.style.display = "none";
                        else
                            commentForm.style.display = "block";

                        document.querySelectorAll(elem2)[0].value = name+','+' ';

                    }
                    //------------------------------------------------------------------------
                </script>   
                <br>
                <br>
                <br>            
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
