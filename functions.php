<?php // Example 26-1: functions.php
    require_once 'db.php';

    $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    if ($connection->connect_error) 
        die($connection->connect_error);

    function createTable($name, $query)
    {
        queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
        echo "Table '$name' created or already exists.<br>";
    }

    function queryMysql($query)
    {
        global $connection;
        $result = $connection->query($query);
        if (!$result) 
            die($connection->error);
        return $result;
    }

    function destroySession()
    {
        $_SESSION=array();

        if (session_id() != "" || isset($_COOKIE[session_name()]))
            setcookie(session_name(), '', time()-2592000, '/');

        session_destroy();
    }

    function sanitizeString($var)
    {
        global $connection;
        $var = strip_tags($var);
        $var = htmlentities($var);
        $var = stripslashes($var);
        return 
            $connection->real_escape_string($var);
    }

    function showProfile($user)
    {
        if (file_exists("$user.jpg"))
            echo "<img src='$user.jpg' style='float:left;'>";

        $result = queryMysql("SELECT * FROM users WHERE user='$user'");

        if ($result->num_rows)
        {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            echo stripslashes($row['text']) . "<br style='clear:left;'><br>";
        }
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

