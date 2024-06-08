<?php

$base_path = str_replace("\\" , "/" ,$_SERVER['DOCUMENT_ROOT'].$_SERVER['base_path']);
require_once  $base_path. '/config/config.php';

session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    if (empty($_GET['page'])) {
        header("Location:".base_url."");
        exit(); 
    }else{
        
    }
}else{
    header("Location:".base_url."");
    exit();
}

?>