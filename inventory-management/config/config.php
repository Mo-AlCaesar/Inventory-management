<?php

if(!defined('base_url')) define('base_url',$_SERVER['base_url']);

// $localIP = getHostByName(getHostName());
// if(!defined('base_url')) define('base_url',"http://".$localIP."/".$_SERVER['base_path']);       

ob_start();
ini_set('date.timezone','Asia/Manila');
date_default_timezone_set('Asia/Manila');



include('db_conn.php');


require_once('initialize.php');



function e($string){
return htmlspecialchars($string);
}


function redirect($url=''){
	if(!empty($url))
	echo '<script>location.href="'.base_url .$url.'"</script>';
}

function isMobileDevice(){
    $aMobileUA = array(
        '/iphone/i' => 'iPhone', 
        '/ipod/i' => 'iPod', 
        '/ipad/i' => 'iPad', 
        '/android/i' => 'Android', 
        '/blackberry/i' => 'BlackBerry', 
        '/webos/i' => 'Mobile'
    );

    //Return true if Mobile User Agent is detected
    foreach($aMobileUA as $sMobileKey => $sMobileOS){
        if(preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])){
            return true;
        }
    }
    //Otherwise return false..  
    return false;
}
ob_end_flush();





?>

