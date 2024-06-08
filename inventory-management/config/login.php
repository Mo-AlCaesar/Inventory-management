<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: ../?error=User-Name-is-required");
	    exit();
	}else if(empty($pass)){
        header("Location: ../?error=Password-is-required");
	    exit();
	}else{

        $userLog = $conn->query("SELECT * FROM users WHERE user_name ='$uname' AND `password` ='$pass'");
		
        if($userLog->rowCount() > 0)
        {
            $row = $conn->query("SELECT * FROM users WHERE user_name ='$uname' AND `password` ='$pass'")->fetch(PDO::FETCH_ASSOC);
            if ($row['user_name'] === $uname && $row['password'] === $pass) {
            	$_SESSION['user_name'] = $row['user_name'];
            	$_SESSION['name'] = $row['name'];
            	$_SESSION['id'] = $row['id'];
            	$_SESSION['role'] = $row['role'];
            	$_SESSION['img'] = $row['img'];
            	header("Location: ../");
		        exit();
            }else{
				header("Location: ../?error=Incorect-User-name-or-password");
		        exit();
			}
        }
        else
        {
			header("Location: ../?error=Incorect-User-name-or-password");
	        exit();
        };

	}
	
}else{
	header("Location: ../");
	exit();
}



