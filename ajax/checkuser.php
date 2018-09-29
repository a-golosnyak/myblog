<?php 
    require_once '../functions.php';

    if (isset($_POST['email']))
    {
        $email   = sanitizeString($_POST['email']);
        $result = queryMysql("SELECT * FROM users WHERE usermail='$email'");

 //     echo "Checkuser.php reached";

        if ($result->num_rows)
            echo 'exists' ;
        else
            echo 'absent' ;
                     
    }
?>
