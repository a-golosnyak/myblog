<?php // Example 26-7: login.php
$userstr = ' (Guest)';

    if (isset($_SESSION['user']))
    {
        $user     = $_SESSION['user'];
        $userLoggedIn = TRUE;
        $userstr  = " ($user)";
    }
    else 
        $userLoggedIn = FALSE;

//    $userLoggedIn = true;
?>

