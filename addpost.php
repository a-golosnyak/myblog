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
                            <div class="preview-area">
                                <p>
                                    <h5 class="sel-category">Категория:</h5>
                                    <select class="sel-category" name="category" style="float: left;">
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
                                        <textarea class="title-box" id="art_title" name="art_title"  rows='3' maxlength='220' placeholder="Заголовок. Максимальная длинна 220 - символов.">Пример заголовка.</textarea>
                                    </div>
                                </p>
                                <p>
                                    <!-- <p><input type="text" name="" rows=4 style="width: 70%;"></p> -->
                                    <div class="intro-input">
                                        <textarea class="intro-box" id="art_intro" name="art_intro"  rows='5' maxlength='800' placeholder="Превью статьи. Максимальная длинна 800 - символов."></textarea>
                                    </div>
                                </p>
                                <input type="file" accept="image/*" onchange="loadFile(event)">
                                <br>
                                <img class="w-100" id="output" style="display: none; margin-top: 1em;">
                                <script>
                                  var loadFile = function(event) {
                                    var output = document.getElementById('output');
                                    output.style.display = 'block';                                    output.src = URL.createObjectURL(event.target.files[0]);
                                  };
                                </script>
                            </div>
                        
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
                            <button  class='addpost-btn' onclick="return TimeToSubmitPost(category, art_title, art_intro )" style='text-align: center;'>Опубликовать</button>
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

