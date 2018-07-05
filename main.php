<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Blog</title>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/main.css">         <!-- В файле main.css подключен bootstrap -->
  </head>
    <body>
        <?php
            require_once  'functions.php' ;     //
            require_once  'log.php' ;           // Проверяем авторизирован ли пользователь

            $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

            if ($connection->connect_error){
                echo "Не получилось соединиться с базой данных." . "<br>";
                die($connection->connect_error);
            }

            require_once  'header.php' ;                
            require_once  'navigation.php' ;
             
   //         var_dump($_SESSION);

            if ($userLoggedIn == true) 
            {
                echo    "<div class='alert alert-primary' role='alert' style='width: 100%; margin-bottom: 0;'>
                            <div class='container'>
                                <strong>Вход пользователем выполнен.</strong>
                                <div>$userstr</div>
                            </div>
                        </div>";
            } 
            else 
            { 
                echo    "<div class='alert alert-danger' role='alert' style='width: 100%; margin-bottom: 0;'>
                            <div class='container'>
                                <strong>Пользователь не зарегистрирован.</strong>
                            </div>
                        </div>";
            }
        ?>
        
        <!-- ---------------------------------------------------------------------------------------- -->
        <div class="main-field">  
          <div class="container-fluid " >
              <div class="container data-field">
                <div class="row">
                  <div class="col-sm-8 blog-main">
                    <div class="blog-post">
                          <h4 class="blog-post-title">Sample blog post</h4>
                          <p class="blog-post-meta">January 1, 2014 by <a href="#">Mark</a></p>

                          <p>Для выделения пробега текста благодаря<mark> своей актуальности в другом контексте, использовать тег mark.</mark></p>
                          <p>This text <span class="lead">hilighted with lead class </span></p>

                          <p><del>Для обозначения блоков текста, которые были удалены</del> использовать тег del.</p>
                          <p>Не для индикации блоков текста, которые <s>утратили свою актуальность использования</s> тег s </p>
                          <p><ins>Для обозначения дополнения к документу использовать ins </ins></p>

                          <blockquote>
                               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                          </blockquote>
                          <br>
                          <hr>
                          <br>
                          <button type="button" class="btn btn-primary" data-toggle="popover"
                            title="Сообщение" data-content="Ура, Bootstrap 4 работает">
                              Поднеси ко мне                                                                         
                          </button>

                          <p>This blog post shows a few different types of content that's supported and styled with Bootstrap. Basic typography, images, and code are all supported.</p>
                          <hr>
                          <p>Cum sociis natoque penatibus et magnis <a href="#">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>
                          <blockquote>
                          <p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                          </blockquote>
                          <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                          <h3>Heading</h3>
                          <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                          <h4>Sub-heading</h4>
                          <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                          <pre><code>Example code block</code></pre>
                          <p>Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
                          <h4>Sub-heading</h4>
                          <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                          <ul>
                          <li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>
                          <li>Donec id elit non mi porta gravida at eget metus.</li>
                          <li>Nulla vitae elit libero, a pharetra augue.</li>
                          </ul>
                          <p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p>
                          <ol>
                          <li>Vestibulum id ligula porta felis euismod semper.</li>
                          <li>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li>
                          <li>Maecenas sed diam eget risus varius blandit sit amet non magna.</li>
                          </ol>
                          <p>Cras mattis consectetur purus sit amet fermentum. Sed posuere consectetur est at lobortis.</p>
                    </div><!-- /.blog-post -->

                    <div class="blog-post">
                      <h2 class="blog-post-title">Another blog post</h2>
                      <p class="blog-post-meta">December 23, 2013 by <a href="#">Jacob</a></p>

                      <p>Cum sociis natoque penatibus et magnis <a href="#">dis parturient montes</a>, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum.</p>
                      <blockquote>
                        <p>Curabitur blandit tempus porttitor. <strong>Nullam quis risus eget urna mollis</strong> ornare vel eu leo. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                      </blockquote>
                      <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                      <p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    </div><!-- /.blog-post -->

                    <div class="blog-post">
                      <h2 class="blog-post-title">New feature</h2>
                      <p class="blog-post-meta">December 14, 2013 by <a href="#">Chris</a></p>

                      <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean lacinia bibendum nulla sed consectetur. Etiam porta sem malesuada magna mollis euismod. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                      <ul>
                        <li>Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>
                        <li>Donec id elit non mi porta gravida at eget metus.</li>
                        <li>Nulla vitae elit libero, a pharetra augue.</li>
                      </ul>
                      <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                      <p>Donec ullamcorper nulla non metus auctor fringilla. Nulla vitae elit libero, a pharetra augue.</p>
                    </div><!-- /.blog-post -->

                    <nav class="blog-pagination">
                      <a class="btn btn-outline-primary" href="#">Older</a>
                      <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
                    </nav>

                  </div><!-- /.blog-main -->

                  <div class="col-sm-3 offset-sm-1 blog-sidebar">
                    <div class="sidebar-module sidebar-module-inset">
                      <h4>About</h4>
                      <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                    </div>
                    <div class="sidebar-module">
                      <h4>Archives</h4>
                      <ol class="list-unstyled">
                        <li><a href="#">March 2014</a></li>
                        <li><a href="#">February 2014</a></li>
                        <li><a href="#">January 2014</a></li>
                        <li><a href="#">December 2013</a></li>
                        <li><a href="#">November 2013</a></li>
                        <li><a href="#">October 2013</a></li>
                        <li><a href="#">September 2013</a></li>
                        <li><a href="#">August 2013</a></li>
                        <li><a href="#">July 2013</a></li>
                        <li><a href="#">June 2013</a></li>
                        <li><a href="#">May 2013</a></li>
                        <li><a href="#">April 2013</a></li>
                      </ol>
                    </div>
                    <div class="sidebar-module">
                      <h4>Elsewhere</h4>
                      <ol class="list-unstyled">
                        <li><a href="#">GitHub</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Facebook</a></li>
                      </ol>
                    </div>
                  </div><!-- /.blog-sidebar -->

                </div><!-- /.row -->

              </div><!-- /.container -->
          </div>
        </div>
        <footer class="blog-footer">
            <p><a href="http://getbootstrap.com">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>
            </p>
            <p><a href="#">Back to top</a>
            </p>
        </footer>