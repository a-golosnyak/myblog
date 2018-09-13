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
        $result = queryMysql("SELECT * FROM posts ORDER BY pub_date DESC" );
        $posts = mysqli_num_rows($result);
    }
    
?>


<div class='main-field style='background-color: lightgrey;'>  
    <div class='container-fluid ' >
        <div class='container data-field'>
            <div class='row'>
                <div class='col-md-8 blog-main'>
<!--                    <div class="blog-post">
                        <h2 class="blog-post-title">Sample blog post</h2>
                        <p class="blog-post-meta">January 1, 2014 by <a href="#">Mark</a></p>
                        <p>Шаг 4. Разрешите удаленные подключения
                            Запустите браузер Chrome.
                            Наберите chrome://apps в адресной строке и нажмите клавишу Ввод.
                            Выберите "Удаленный рабочий стол Chrome" Приложение "Удаленный рабочий стол Chrome".
                            В разделе "Мои компьютеры" нажмите Начало работы.
                            Нажмите Разрешить удаленные подключения.
                            Введите PIN-код, повторите его и нажмите ОК.
                        Закройте диалоговое окно.
                        </p>
                        

                        <div class="post-footer">
                            <div class="pull-xs-left">
                                <button type='' class='post-btn' >Читать далее...</button>
                            </div>
                            <div class="pull-xs-right offset-xs-1 show-comments">Комментарии</div>
                        </div>
                        <br style="clear: both;">
                        <hr>
                    </div>      -->

                    <?php              
                        while($row = $result->fetch_assoc())
                        {
                            $pub_date = $row['pub_date'];
                            $pub_date = preg_replace( "#(:\d+):\d+#", '$1', $pub_date ); 
                            $title = $row['title'];
                            $art_intro = $row['art_intro'];
                            $art_intro_img = $row['art_intro_img'];
                            $post_body = $row['post_body'];


                            echo "  <div class='blog-post'>
                                        <h4 class='blog-post-title'> $title </h4>
                                        <p class='blog-post-meta'>$pub_date by $user_screen_name
                                            <a href='#'></a>
                                        </p>
                                        <p>$art_intro</p>
                                        <p><img class='post-preview-img' src='$art_intro_img'></p>
                                        <div class='post-footer'>
                                            <div class='pull-xs-left'>
                                                <button type='' class='post-btn' >Читать далее...</button>
                                            </div>
                                            <div class='pull-xs-right offset-xs-1 show-comments'>Комментарии</div>
                                        </div>
                                        <br style='clear: both;''>
                                        <br>
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
