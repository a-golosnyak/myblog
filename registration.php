<?php
    require_once  'main.php' ; 

    if (isset($_SESSION['user'])) 
        destroySession();

/*    echo '<br>';
    echo "POST :"; 
    var_dump($_POST);
    echo '<br>';
*/
    if(isset($_POST['email']))
    {
        echo "Incoming mail " . $_POST['email'];
        echo '<br>';
        $email = sanitizeString($_POST['email']);

        $result = queryMysql("SELECT * FROM users WHERE usermail='$email'");

        if ($result->num_rows)
        {
            echo "That email already exists<br><br>";
        }
        else
        {
            echo "This email can be used<br><br>";
        }

/*      if ($user == "" || $pass == "")
            $error = "Not all fields were entered<br><br>";
        else
        {
            $result = queryMysql("SELECT * FROM members WHERE user='$user'");

            if ($result->num_rows)
                $error = "That username already exists<br><br>";
            else
            {
                queryMysql("INSERT INTO members VALUES('$user', '$pass')");
                die("<h4>Account created</h4>Please Log in.<br><br>");
            }
        }
        */
    }

?>
    <script>
        function checkUser(email)
        {
            if(validateEmail(email.value) == "")    /*(email.value.length > 5)*/
            {
                params  = "email=" + email.value
                request = new ajaxRequest()
                request.open("POST", "checkuser.php", true)
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")

                request.onreadystatechange = function()
                {
                    if (this.readyState == 4)
                        if (this.status == 200)
                            if (this.responseText != null)
                            {
                                document.getElementById('emailOk').innerHTML = this.responseText;
                            }
                }
                request.send(params)
            }
            else
            {
                document.getElementById('emailOk').innerHTML = "<i class='fas fa-asterisk'></i> ";
            }
        }

        function ajaxRequest()
        {
            try { var request = new XMLHttpRequest() }

            catch(e1) {
                try { request = new ActiveXObject("Msxml2.XMLHTTP") }
                catch(e2) {
                    try { request = new ActiveXObject("Microsoft.XMLHTTP") }
                    catch(e3) {
                        request = false
                    } 
                } 
            }
            return request
        }

        function validateEmail(field)
        {
            if (field == "") 
                return "Не введен адрес электронной почты.\n"
            else if (!((field.toString().indexOf(".") > 0) &&
                        (field.toString().indexOf("@") > 0)) ||
            /[^a-zA-Z0-9.@_-]/.test(field) )
                return "Электронный адрес имеет неверный формат.\n"

            return "";
        }

        function validatePassword(pass1, pass2) 
        {
            if( ((pass1 != "") && (pass1.value.length > 2)) &&
                ((pass2 != "") && (pass2.value.length > 2)) &&
                 (pass1.value == pass2.value))
            {
                document.getElementById('pass1Ok').innerHTML = "<i class='fas fa-check' style='color: rgb(50, 200, 50); font-size: 0.7rem;'> ";
                document.getElementById('pass2Ok').innerHTML = "<i class='fas fa-check' style='color: rgb(50, 200, 50); font-size: 0.7rem;'> ";
            }
            else
            {
                document.getElementById('pass1Ok').innerHTML = "<i class='fas fa-times' style='color: rgb(200, 50, 50); font-size: 0.9rem;'> ";
                document.getElementById('pass2Ok').innerHTML = "<i class='fas fa-times' style='color: rgb(200, 50, 50); font-size: 0.9rem;'> ";
            }  
        }

        function validateName(field)
        {
            if(field.value.length < 3)
            {
                document.getElementById('nameOk').innerHTML = "<i class='fas fa-times' style='color: rgb(200, 50, 50); font-size: 0.9rem;'> ";
            }
            else
            {
                document.getElementById('nameOk').innerHTML = "<i class='fas fa-check' style='color: rgb(50, 200, 50); font-size: 0.7rem;'> ";
            }
        }

    </script>


    <div id="info"></div>
    <div class='reg-field'>
        <div class="container registration-container " style="height: 100%;">
            <form class="form-signin" action="registration.php" method="post">
                <h2 class="form-signin-heading">Регистрация</h2>
                <div>
                    <input type="email" name="email" class="form-control form-signup page-item" placeholder="Email" required onblur='checkUser(this)'>
                    <div id="emailOk" class="page-item">
                        <i class="fas fa-asterisk "></i> 
                    </div>
                </div>
                <br>
                <div>
                    <input type="password" name="password" id="password" class="form-control form-signup page-item" placeholder="Пароль" required onkeyup="validatePassword(this, password_confirm)">
                    <div id="pass1Ok" class="page-item">
                        <i class="fas fa-asterisk "></i> 
                    </div>
                </div>
                <div>
                    <input type="password" name="password_confirm" class="form-control form-signup page-item" placeholder="Повторите пароль" required onkeyup="validatePassword(password, this)">
                    <div id="pass2Ok" class="page-item">
                       <i class="fas fa-asterisk "></i> 
                   </div>
                </div>
                <br>
                <div>
                    <input type="text" name="screen_name" class="form-control form-signup page-item" placeholder="Имя" required onkeyup = "validateName(this)">
                    <div id="nameOk" class="page-item">
                        <i class="fas fa-asterisk "></i> 
                    </div>
                </div>
                <br>
                <div>
                    <button type="submit" class="btn btn-lg btn-primary btn-block form-control form-signup page-item" >Зарегистрироваться</button>
                    <i class="fas fa-asterisk " style="color: #eee"></i> 
                </div>
            </form>
        </div> <!-- /container -->
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="      sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>

<!--    <script src="http://jcrop-cdn.tapmodo.com/v0.9.12/js/jquery.Jcrop.min.js"></script>
    <link rel="stylesheet" href="http://jcrop-cdn.tapmodo.com/v0.9.12/css/jquery.Jcrop.css" type="text/css" />      -->
    <script src="js/bootstrap.js"></script>
    <script src="js/my.js"></script>
    <script src="js/jquery.Jcrop.min.js"></script> 
    <script src="js/jquery.Jcrop.js"></script>
    

  </body>
</html>