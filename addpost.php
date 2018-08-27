<?php
    require_once  'main.php' ; 

    if (!$userLoggedIn) 
        die();
    else
    {
        $result = queryMysql("SELECT * FROM users WHERE usermail='$usermail'");
        $user = $result->fetch_assoc();                     // Способ 1
     
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

        print_r($_SESSION);

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

    echo "<div class='main-field'>  
    <div class='container-fluid ' >
        <div class='container data-field'>
            <div class='row'>
                <div class='col-md-8 blog-main'>
                    <div class='profile-field ' >
                        <h3 class='form-signin-heading profile-title'>Создание поста от <b>$usermail</b></h3> 
                         <!--style='border: 1px solid grey;' -->
                        <br><br>";
                        ?>
                        <h5 style="float: left; margin-right: 0.5em;">Категория:</h5>

                        <form action="addpost.php" method="post">
                            <select name="category">
                                <?php
                                foreach ($category as $value)
                                {
                                    echo "<option value=". $value['category_name'] . ">";
                                    echo ($value['category_name']);
                                    echo "</option>";
                                }
                                ?>
                            </select>
                            <br>
                            <br>
                            <div id="area" >
                                
                                <textarea name="editor1" id="editor1" rows="20" cols="80">
                                </textarea>

                                <script>
                                    // Replace the <textarea id="editor1"> with a CKEditor
                                    // instance, using default configuration.
                                    CKEDITOR.replace( 'editor1');
                                    CKEDITOR.config.extraPlugins  = 'autogrow';
                                    // CKEDITOR.config.height = '90%';

                                    function TimeToSubmit()
                                    {
                                        var data = CKEDITOR.instances.editor1.getData();
                                        alert(data);          
                                    }
                                </script>
                                
                            </div>
                            <br>
                            <button type='submit' class='profile-btn' onclick="TimeToSubmit()" style='text-align: center;'>Опубликовать</button>
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