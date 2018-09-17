<?php 
    session_start();

    require_once '../functions.php';

    if (isset($_POST['getcategory'])) 
    {
        $result = queryMysql("SELECT * FROM category");
/*        while ($row = mysqli_fetch_assoc($result)) {        // Способ 2
            $category[] = $row;     */

        $row = mysqli_fetch_assoc($result);

        $category = $row['category_name'];

        echo "Ajax получен";
    } 

/*      echo "DB : "; 
        print_r($pl_usermail);
        echo "<br>";         
        echo "<pre>";
        print_r($category);
        echo "</pre>";
        echo "<br>"; 
*/     
?>
