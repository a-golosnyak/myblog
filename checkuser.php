<?php // Example 26-6: checkuser.php
    require_once 'functions.php';

    if (isset($_POST['email']))
    {
        $email   = sanitizeString($_POST['email']);
        $result = queryMysql("SELECT * FROM users WHERE usermail='$email'");

 //       echo "Checkuser.php reached";

        if ($result->num_rows)
            echo  "<i class='fas fa-times' style='color: rgb(200, 50, 50); font-size: 0.8rem;'> ";
        else
            echo  "<i class='fas fa-check' style='color: rgb(50, 200, 50); font-size: 0.8rem;'> ";
            

            
    }
?>
