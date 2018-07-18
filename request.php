<?php
//    header("Content-type: text/txt; charset=UTF-8");
//    echo var_dump($_POST) . "<br>";

    echo var_dump($_FILES) . "<br>";
//    require_once 'main.php';

//    if(isset($_FILES) && isset($_FILES['file']))
    if( isset( $_FILES['file'] ) )
    {
//        echo var_dump($_FILES) . "<br>";
        $image = $_FILES['file'];
        $imageFormat = explode('/', $image['type']);
        $imageType = $imageFormat[0];
        $imageFormat = $imageFormat[1];
        $imageName = 'images_' .  date("Y-m-d His");

        $fileName = $imageName . '.' . $imageFormat;

        if(copy($_FILES['file']['tmp_name'], $fileName))
            echo "Looks like success<br>";
        else
            echo "Shit happens<br>";

/*        move_uploaded_file($_FILES['file']['tmp_name'], $imageName  . '_m' . '.' . $imageFormat);

        $src = imagecreatefromjpeg($imageName  . '_m' . '.' . $imageFormat); 
        $tw = 200; 
        $th = 200;
        $tmp = imagecreatetruecolor($tw, $th);
        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
        imageconvolution($tmp, array(array(-1, -1, -1),
        array(-1, 16, -1), array(-1, -1, -1)), 8, 0);

        imagejpeg($tmp, $imageName .'_i' . '.' . $imageFormat);
*/
/*        header('Content-type: image/jpeg');
        imagejpeg($tmp,null,100);
        exit;
*/

 /*     switch($_FILES['file']['type'])
        {
          case "image/gif":   
            $src = imagecreatefromgif($saveto); 
            break;
          case "image/jpeg":  // Both regular and progressive jpegs
          case "image/pjpeg": 
            $src = imagecreatefromjpeg($saveto); 
            break;
          case "image/png":   
            $src = imagecreatefrompng($saveto); 
            break;
          default:            
            $typeok = false; 
            break;
        } 

        if($typeok == true)
        {
            list($w, $h) = getimagesize($saveto);

            $max = 100;
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
            {
                $tw = $th = $max;
            }

            $tmp = imagecreatetruecolor($tw, $th);
            imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
            imageconvolution($tmp, array(array(-1, -1, -1),
            array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
            imagejpeg($tmp, $saveto);
            imagedestroy($tmp);
            imagedestroy($src);
*/
/*
            $saveto = $imageName . '.' . $imageType;

            if (move_uploaded_file($_FILES['file']['tmp_name'], $saveto)) 
//            $tmp = imagecreatetruecolor(100, 100);
//            if(imagejpeg($tmp, $saveto))

            if (move_uploaded_file($imageName, $saveto)) 
                $status = 'success';
            else
                $status = 'error';

//            move_uploaded_file($_FILES['file']['blob'], $saveto);
        }
*/
//        echo $saveto . "<br>";
//        echo $imageType . ' ' . $imageFormat . ' ' . $imageName . ' ' . $status;
//        echo var_dump($imageName) . "<br>";
//        echo var_dump($_FILES['file']['name']) . "<br>";
//        echo var_dump($_FILES) . "<br>";
    }
    
/*        

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
        