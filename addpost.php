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

    

    if(isset($_POST['category']))
    {
        // if($_POST['category'] != NULL)
        if(!empty($_POST['category']))
        {
            //=== Создаем посты ========================================= INSERT ==========================
           // print_r($_POST);


        }
        

        //$randPost = RandString(20);
 /*       $Title = 'string';

        for($i=0; $i<5; $i++)
            $Title[$i] = $Post[$i]; 

        echo $Post;
        echo "<br>";
        echo $Title;
        echo "<br>";

        //--- Вставка нового элемента ---------------------------------------------
        $date = date("Y-m-d H:i:s");
        $query = "INSERT INTO posts VALUES 
        ('0', '$pl_user_id', '$date','titl ". $Title ."', 'postik ". $Post ."')";
        $result = $connection->query($query);

        if($result)                                      
            echo "Post created.";
        else
           echo "Post creation error.";
        echo "<br>";
*/
    }

echo "  <div class='alert alert-warning' role='alert' style='width: 100%; margin-bottom: 0; display: none;'>
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
                                <h3 class='form-signin-heading profile-title'>Создание поста от <b>$usermail</b></h3> 
                                 <!--style='border: 1px solid grey;' -->
                                <br><br>";
?>                   

                        <form action="addpost.php" method="post">
                            <p>
                                <h5 class="sel-category">Категория:</h5>
                                <select name="category" style="float: left;">
                                    <option value="">Выберите категорию</option>
                                    <?php
                                    foreach ($category as $value)
                                    {
                                        echo "<option value=". $value['category_name'] . ">";
                                        echo ($value['category_name']);
                                        echo "</option>";
                                    }
                                    ?>
                                </select>
                            </p>
                            <p>
                                <!-- <p><input type="text" name="" rows=4 style="width: 70%;"></p> -->
                                <div class="title-input">
                                    <textarea class="title-box" name="art_title"  rows='3' maxlength='220' placeholder="Заголовок. Максимальная длинна 150 - символов."></textarea>
                                </div>
                            </p>

                            <div id="area" >
                                <textarea name="post-body" id="post-body" rows="40" cols="80">
                                    Пост
                                </textarea>

                                <script>
                                    CKEDITOR.replace('post-body');
                                    CKEDITOR.config.extraPlugins  = 'autogrow';
                                    // CKEDITOR.config.height = '90%';

                                    function TimeToSubmit(category, art_title)
                                    {  
                                        if(category.value=='')
                                        {
                                            document.getElementsByClassName('alert')[0].style.display = 'block';
                                            document.getElementById('ErrorMessage').innerHTML = "Выберите пожалуйста категорию";

                                            return false;
                                        }
                                        if(art_title.value == '')
                                        {
                                           document.getElementsByClassName('alert')[0].style.display = 'block';
                                            document.getElementById('ErrorMessage').innerHTML = "Введите пожалуйста заголовок";
                                            
                                            return false; 
                                        }
                                        document.getElementsByClassName('alert')[0].style.display = 'block';
                                        document.getElementsByClassName('alert')[0].className = 'alert alert-success';
                                        document.getElementById('ErrorMessage').innerHTML = "Пост получен";

                                        var data = CKEDITOR.instances.post-body.getData();
                                        
                                        alert(data);          
                                    }

                                </script>
                            </div>
                            <br>
                            <button type='submit' class='profile-btn' onclick="return TimeToSubmit(category, art_title)" style='text-align: center;'>Опубликовать</button>
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

