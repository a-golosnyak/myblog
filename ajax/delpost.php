<?php 
    session_start();

    require_once '../functions.php';

    $art_id = '';

    if ($_SESSION['usermail'] == '') 
        die();
    else
    {
        if (isset($_POST['art_id']))
        {
            $art_id = sanitizeString($_POST['art_id']);

            $result = $connection->query("DELETE FROM posts WHERE id=$art_id");
            $rowsAffected = mysqli_affected_rows($connection);

            if ($rowsAffected == 0) 
                echo "No rows were deleted";
            elseif ($rowsAffected == 1) 
                echo "1 row was deleted";
            elseif ($rowsAffected > 0) 
                echo "$rowsAffected rows were deleted";
            else 
                echo "Request error";
        }
    }
?>
