<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $base_path = str_replace("\\", "/", $_SERVER['DOCUMENT_ROOT'] . $_SERVER['base_path']);
    require_once $base_path . '/config/db_conn.php';

    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    
    $time_date = date("Y-m-d h:i:sa");


    $folder = "./app/Http/Controllers/";
    $files = glob($folder . "*.php");
    foreach ($files as $phpFile)
    {
        require_once ("$phpFile");
    }

}
else
{
    header("Location:".base_url."");
    exit();
}

?>
