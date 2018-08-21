<?php
    require_once  'main.php' ; 

    if (!$userLoggedIn) 
        die();

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
                        <h3 class='form-signin-heading profile-title'>Ваш профиль <b>$usermail</b></h3> 
                         <!--style='border: 1px solid grey;' -->
                        <br>";
                        ?>

                        <br style="clear: both;">

                        <form>
                            <textarea name="editor1" id="editor1" rows="20" cols="80">
                                This is my textarea to be replaced with CKEditor.
                            </textarea>
                            <script>
                                // Replace the <textarea id="editor1"> with a CKEditor
                                // instance, using default configuration.
                                CKEDITOR.replace( 'editor1' );
                            </script>
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