<?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

include 'routes/web.php';


}else{
     
     require_once("resources/views/auth/login-page.php");
}
 ?>