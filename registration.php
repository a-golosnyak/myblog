<?php
    require_once  'main.php' ; 

    if($usermail == $adminmail)
    {
        echo "Добро пожаловать, Админ! <br>";

    }

/*    echo '<br>';
    echo "POST :"; 
    var_dump($_POST);
    echo '<br>';
*/
    if(isset($_POST['name']))
    {
        echo "incoming name " . $_POST['name'];

        $user = sanitizeString($_POST['user']);
        $pass = sanitizeString($_POST['pass']);

        if ($user == "" || $pass == "")
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
    }

?>
    <script>
        function checkUser(email)
        {
            if(validateEmail(email.value) == "Ok")    /*(email.value.length > 5)*/
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
        function validate()
        {
                ***
        }

        function validateEmail(field)
        {
            if (field == "") 
                return "Не введен адрес электронной почты.\n"
            else if (!((field.toString().indexOf(".") > 0) &&
                        (field.toString().indexOf("@") > 0)) ||
            /[^a-zA-Z0-9.@_-]/.test(field) )
                return "Электронный адрес имеет неверный формат.\n"

            return false;
        }

        function validatePassword(field) 
        {
            if (field == "") 
                return "Не введен пароль.\n"
            else if (field.length < 6)
                return "В пароле должно быть не менее 6 символов.\n"
            else if (!/[a-z]/.test(field) || ! /[A-Z]/.test(field) ||
            !/[0-9]/.test(field))
                return "Пароль требует 1 символа из каждого набора a-z, A-Z и 0-9.\n"

            return ""
        }

        function validateName(field)
        {
            return (field == "") ? "Не введено имя.\n" : ""
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
                    <input type="password" name="password" class="form-control form-signup page-item" placeholder="Пароль" required>
                    <i class="fas fa-asterisk "></i> 
                </div>
                <div>
                    <input type="password" name="password_confirm" class="form-control form-signup page-item" placeholder="Повторите пароль" required>
                    <i class="fas fa-asterisk "></i> 
                </div>
                <br>
                <div>
                    <input type="text" name="screen_name" class="form-control form-signup page-item" placeholder="Имя" required>
                    <i class="fas fa-asterisk "></i> 
                </div>
                <br>
                <div>
                    <button type="submit" class="btn btn-lg btn-primary btn-block form-control form-signup page-item" >Зарегистрироваться</button>
                    <i class="fas fa-asterisk " style="color: #eee"></i> 
                </div>
            </form>
        </div> <!-- /container -->
    </div>

  </body>
</html>