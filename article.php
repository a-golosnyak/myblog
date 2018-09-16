<?php
    require_once 'main.php' ; 

    $author_id = '';

    if(isset($_GET['show']))
    {
        if($_GET['show'] != 'user_articles')
        {
            $id = sanitizeString($_GET['show']);

            $result = queryMysql("SELECT * FROM users WHERE usermail='$usermail'");
            $row = $result->fetch_assoc();
         
            $author_id = $row['id'];
            $user_screen_name = $row['screen_name'];
            
            $result = queryMysql("SELECT * FROM posts WHERE id='$id'");
            $posts = mysqli_num_rows($result);  
        }
    }
    else        // Если поле show не приходит, выводим все статьи подряд.
    {
        $result = queryMysql("SELECT * FROM posts ORDER BY pub_date DESC" );
        $posts = mysqli_num_rows($result);
    }

    $result = queryMysql("SELECT * FROM posts WHERE id='$id'");

?>

<div class='main-field style='background-color: lightgrey;'>  
    <div class='container-fluid ' >
        <div class='container data-field'>
            <div class='row'>
                <div class='col-md-8 blog-main'>
<?php              
                    while($row = $result->fetch_assoc())
                    {  
                        $pub_date = $row['pub_date'];
                        $pub_date = preg_replace( "#(:\d+):\d+#", '$1', $pub_date ); 
                        $title = $row['title'];
                        $art_intro = $row['art_intro'];
                        $art_intro_img = $row['art_intro_img'];
                        $post_body = $row['post_body'];
                        $post_url = 0;

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
                    }
?>

                <div class="comments-main">
                    <div class="title-input">
                        <textarea class="intro-box" id="" name=""  rows='5' maxlength='1000' placeholder="Комментарий"></textarea>
                    </div>
                    <button type='submit' class='comment-btn pull-xs-right' style='text-align: center;'>Добавить комментарий</button>
                    <div style="clear: both;">
                        
                    </div>
                </div>

                <div class="comments-main">
                    <div class="row comment">
                        <div class="col-xs-1">
                            <img class='avatar'  src='images/ava/adm1@mail.ru.jpeg' alt='...'>
                        </div>

                        <div class="col-xs-10 comments1 ">
                            <div style="margin-bottom: 0.2em;">
                                <div class="comment-author">
                                    Василий
                                </div>
                                 <div class="comment-date">
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
                            <br>
                            <div class="row ">
                                <div class="col-xs-1">
                                    <img class='avatar'  src='images/ava/adm@mail.ru.jpeg' alt='...'>
                                </div>

                                <div class="col-xs-10 comments1 ">
                                    <div style="margin-bottom: 0.2em;">
                                        <div class="comment-author">
                                            Василий
                                        </div>
                                         <div class="comment-date">
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
                        </div>
                    </div>
                    
                </div>

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
