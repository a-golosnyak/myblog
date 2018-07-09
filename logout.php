<?php // Example 26-12: logout.php
    session_start();

    if (isset($_SESSION['user']))
    {
        session_unset();
//      header("Location: http://myblog/index.php");                          // Пока что не работает"
        echo '<meta http-equiv="refresh" content="0; url=http://myblog">';    
        die();

    }
    else 
    {
        echo "<div class='main'><br>" .
        "You cannot log out because you are not logged in";
    }
?>

    <br><br></div>
  </body>
</html>
