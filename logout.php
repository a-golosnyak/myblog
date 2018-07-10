<?php // Example 26-12: logout.php
    session_start();

    if (isset($_SESSION['user']))
    {
        session_unset();
        
        header('Location: index.php');    
 //       echo '<meta http-equiv="refresh" content="0; url=index.php">';    
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
