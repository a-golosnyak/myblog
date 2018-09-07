<?php
    require_once  'main.php' ; 

    if (!$userLoggedIn) 
        die();
    else
    {
        $result = queryMysql("SELECT * FROM users WHERE usermail='$usermail'");
        $user = $result->fetch_assoc();                     // Способ 1
     
        $pl_user_id = $user['id'];
        $pl_usermail = $user['usermail'];
        $pl_screen_name = $user['screen_name'];

        $result = queryMysql("SELECT * FROM category");
        while ($row = mysqli_fetch_assoc($result)) {        // Способ 2
            $category[] = $row;
        } 

/*      echo "DB : "; 
        print_r($pl_usermail);
        echo "<br>";         
        echo "<pre>";
        print_r($category);
        echo "</pre>";
        echo "<br>"; 
*/     
        $current_category = $category['category_name'];
    }

    if(isset($_POST['name']))
    {
        $name = sanitizeString($_POST['name']);
        queryMysql("UPDATE users SET screen_name = '$name' 
                        WHERE usermail='$usermail' ");
        echo "  <script>
                   window.location.href='profile.php';
                </script>";   
    }
?>

  <div class='alert alert-warning' role='alert' style='width: 100%; margin-bottom: 0; display: none;'>
            <div class='container'>
                <strong id='ErrorMessage'>Не заполнены некоторые поля.</strong>
            </div>
        </div>
        <div class='main-field'>  
            <div class='container-fluid ' >
                <div class='container data-field'>
                    <div class='row'>
                        <div class='col-md-8 blog-main'>
                            <div class='profile-field ' >
<?php                       
                            echo "<h3 class='form-signin-heading profile-title'>Создание поста от <b>$usermail</b></h3>";
?> 
                                 <!--style='border: 1px solid grey;' -->
                                <br>
                        <form>
                            <p>
                                <h5 class="sel-category">Категория:</h5>
                                <select name="category" style="float: left;">
                                    <!-- <option value="">Выберите категорию</option> -->
                                    <?php
                                    foreach ($category as $value)
                                    {
                                        echo "<option value=". $value['id'] . ">";
                                        echo ($value['category_name']);
                                        echo "</option>";
                                    }
                                    ?>
                                </select>
                            </p>
                            <p>
                                <!-- <p><input type="text" name="" rows=4 style="width: 70%;"></p> -->
                                <div class="title-input">
                                    <textarea class="title-box" id="art_title" name="art_title"  rows='3' maxlength='220' placeholder="Заголовок. Максимальная длинна 150 - символов.">Пример заголовка.</textarea>
                                </div>
                            </p>

                            <div id="area" >
                                <textarea name="post-body" id="postBody" rows="40" cols="80">
                                    Начните вводить пост.
                                </textarea>

                                <script>
                                    CKEDITOR.replace('postBody');
                                    CKEDITOR.config.extraPlugins  = 'autogrow';
                                    // CKEDITOR.config.height = '90%'; 
                                </script>
                            </div>
                            <br>
                            <button  class='addpost-btn' onclick="return TimeToSubmitPost(category, art_title, )" style='text-align: center;'>Опубликовать</button>
                        </form>   
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

