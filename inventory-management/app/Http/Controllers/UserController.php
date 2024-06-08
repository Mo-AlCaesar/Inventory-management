<?php

include('uploadFiles.php');



  ################################################################################################
  if (isset($_REQUEST['AddUser']))
  {

    $userExists = $conn->query("SELECT * FROM users where `user_name` =  '$_POST[user_name]'");
    if ($userExists->rowCount() > 0)
    {
        $res = array(
            "status" => false,
            "message" => "User Name Already Exists",
            "userName" => $_POST['name']
        );
    }
    else
    {
        

        $insUser = $conn->query("INSERT INTO `users` (`user_name`, `password`, `name`, `role`, `img`, `email`)

          VALUES ('$_POST[user_name]','$_POST[password]','$_POST[name]', '$_POST[role]','$uploadDirectory$_POST[img]','$_POST[email]')");

        if ($insUser)
        {

                $add_action = 'Add User ' . $_POST['name'] ;
                $user_active_query = $conn->query("INSERT INTO `user_activity`(`user_id`,`action`,`action_date`)        
                    VALUES ('$_SESSION[id]','$add_action','$time_date')");

                $res = array(
                    'status' => true,
                    'message' => 'User Add'
                );

        }
        else
        {
            $res = array(
                "status" => false,
                "userName" => $_POST['name']
            );
        }
    };

    echo json_encode($res);

  }


  ################################################################################################
  if (isset($_REQUEST['UpdateUser']))
  {

      $Userdata = $conn->query("SELECT * FROM users where `user_name` =  '$_POST[user_name]'")->fetch(PDO::FETCH_ASSOC);

      if (empty($_POST['password']))
      {

          $run = $conn->query("UPDATE users set  
          `name` = '$_POST[name]',
          `email` = '$_POST[email]',
          `role` = '$_POST[role]',
          `img` =  '$uploadDirectory$_POST[img]'
          WHERE `user_name` like '$_POST[user_name]';");

      }
      else
      {

          $run = $conn->query("UPDATE users set  
          `name` = '$_POST[name]',
          `email` = '$_POST[email]',
          `password` = '$_POST[password]',
          `role` = '$_POST[role]',
          `img` =  '$uploadDirectory$_POST[img]'
          WHERE `user_name` like '$_POST[user_name]';");

      }

      if ($run)
      {

          $add_action = 'Edit Profile in User Name: ' . $_POST['user_name'];

          $user_active_query = $conn->query("INSERT INTO `user_activity`(`user_id`,`action`,`action_date`)
              VALUES ('$_SESSION[id]','$add_action','$time_date')");


    if ($_SESSION['user_name'] == $_POST['user_name']) {
      $_SESSION['name'] = $_POST['name'];
      $_SESSION['role'] = $_POST['role'];
      $_SESSION['img'] = '$uploadDirectory'.$_POST['img'];
    }else{
    }          


          $res = array(
              'status' => true,
              'message' => 'Profile updated'
          );

      }
      echo json_encode($res);

  }

  ################################################################################################
  
  if (isset($_REQUEST['user_del']))
  {

      $delete_id = $_POST['user_del'];

      $userdata = $conn->query("SELECT * FROM users where id like '$delete_id'")->fetch(PDO::FETCH_ASSOC);
      
      $deluser = $conn->query("DELETE FROM `users` WHERE id = '$delete_id'");
      if ($deluser)
      {
        $add_action = 'Delete User '.$userdata['name'];

        $user_active_query = $conn->query("INSERT INTO `user_activity`(`user_id`,`action`,`action_date`)
            VALUES ('$_SESSION[id]','$add_action','$time_date')");

          $res = array(
              'status' => true,
              'message' => 'User deleted'
          );
      }
      else
      {
          $res = array(
              "status" => false
          );
      };

      echo json_encode($res);

  }

 ?>