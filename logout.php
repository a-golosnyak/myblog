<?php // Example 26-12: logout.php
    session_start();

    if (isset($_SESSION['usermail']))
    {
        $_SESSION = array();
        setcookie('usermail', $usermail, time() - 60*60*24*31);             // Анулируем Remember me
//        setcookie('test_user', 'test_user', time() - 60*60*24*31);        // Анулируем Remember me
        session_unset();

        header('Location: index.php');                                      // Это должно быть в начале скрипта 
 //     echo '<meta http-equiv="refresh" content="0; url=index.php">';      // Это работает с любой точки скрипта  
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
