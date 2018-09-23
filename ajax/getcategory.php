<?php 
    session_start();

    require_once '../functions.php';

    if (isset($_POST['getcategory'])) 
    {
        $result = queryMysql("SELECT * FROM category");
/*        while ($row = mysqli_fetch_assoc($result)) {        // Способ 2
            $category[] = $row;     */
        $catNumber = mysqli_num_rows($result);
        $data = array();   

        for($i=0; $i<$catNumber; $i++) 
        {
            $row = mysqli_fetch_assoc($result);
            $data[$row['id']] = $row['category_name'];
        }
        header('Content-Type: application/json');
        echo json_encode($data);
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
