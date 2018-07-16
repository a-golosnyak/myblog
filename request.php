<?php
    header("Content-type: text/txt; charset=UTF-8");
//    echo var_dump($_POST) . "<br>";

//    echo var_dump($_FILES) . "<br>";

    if(isset($_FILES) && isset($_FILES['file']))
    {
        $saveto = "xxx.jpg";
        $image = $_FILES['file']['name'];
//        move_uploaded_file($_FILES['file']['blob'], $saveto);
//        $imageFormat = explode('.', $image['blob']);

        echo var_dump($_FILES) . "<br>";
    }

    

/*        switch($_POST['image']['type'])
        {
          case "image/gif":   $src = imagecreatefromgif($saveto); break;
          case "image/jpeg":  // Both regular and progressive jpegs
          case "image/pjpeg": $src = imagecreatefromjpeg($saveto); break;
          case "image/png":   $src = imagecreatefrompng($saveto); break;
          default:            $typeok = FALSE; break;
        }  

    if ($typeok)
    {
        list($w, $h) = getimagesize($saveto);

        $max = 200;
        $tw  = $w;
        $th  = $h;

        if ($w > $h && $max < $w)
        {
            $th = $max / $w * $h;
            $tw = $max;
        }
        elseif ($h > $w && $max < $h)
        {
            $tw = $max / $h * $w;
            $th = $max;
        }
        elseif ($max < $w)
            $tw = $th = $max;

        $tmp = imagecreatetruecolor($tw, $th);
        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
        imageconvolution($tmp, array(array(-1, -1, -1),
        array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
        imagejpeg($tmp, $saveto);
        imagedestroy($tmp);
        imagedestroy($src);
    }
    else
        echo "Type problem <br>";

    echo var_dump($_POST) . "<br>";

    if(isset($_FILES['image']['name']))
    {
    }
       

    if (isset($_POST['file']["blob"])) 
    {
        echo var_dump($_POST) . "<br>";

        if ($_POST['q'] == 1)
        {
            echo "Condition ok<br>";

    //        echo '<div>' . trim($ch[count($ch) - 1]) . '</div>';
        }
    }*/
?>
        