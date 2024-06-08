<?php

$uploadDirectory = 'public/assets/img/';

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $randomName = $_POST['randomName'];
    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    $filePath = $uploadDirectory . basename($randomName);
    
    if (move_uploaded_file($file['tmp_name'], $filePath)) {

    } else {

    }
} else {

}

?>