<?php // Example 26-12: logout.php
    session_start();

    if (isset($_SESSION['usermail']))
    {
        $_SESSION = array();
        setcookie('usermail', $usermail, time() - 60*60*24*31);        // Анулируем Remember me
        session_unset();

        header('Location: index.php');    
 //       echo '<meta http-equiv="refresh" content="0; url=index.php">';    
        die();

    }
    else 
    {
        echo "<div class='main'><br>" .
        "You cannot log out because you are not logged in";

        $_SESSION = array();
        setcookie('usermail', $usermail, time() - 60*60*24*31);        // Анулируем Remember me
        session_unset();
    }
?>

    <br><br></div>
  </body>
</html>
