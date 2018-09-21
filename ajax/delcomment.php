<?php 
    session_start();

    require_once '../functions.php';

    $comment_id = '';

    if ($_SESSION['usermail'] == '') 
        die();
    else
    {
        if (isset($_POST['comment_id']))
        {
            $comment_id = sanitizeString($_POST['comment_id']);

            if (mysqli_query($connection, "DELETE FROM comments WHERE id = $comment_id")) 
            {
                $rowsAffected = mysqli_affected_rows($connection);

                if ($rowsAffected == 0) 
                {
                    echo "No rows were deleted";
                } 
                elseif ($rowsAffected == 1) 
                {
                    echo "1 row was deleted";
                } 
                elseif ($rowsAffected > 1)
                {
                    echo "$rowsAffected rows were deleted";
                }
            } 
            else 
            {
                echo "Error occurred: " . mysqli_error($connection);
            }


 /*         $result = $connection->query("DELETE * FROM comments WHERE id='$comment_id'");
            $rowsAffected = mysqli_affected_rows($connection);

            if ($rowsAffected == 0) 
            {
                echo "No rows were deleted";
            }
            else if ($rowsAffected == 1) 
            {
                echo "1 row was deleted";
            }
            else if($rowsAffected > 1) 
            {
                echo "$rowsAffected rows were deleted";
            }
            */
        }
    }
?>
