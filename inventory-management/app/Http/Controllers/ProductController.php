<?php
include('uploadFiles.php');
  ################################################################################################
    
  if (isset($_REQUEST['AddProduct']))
  {

      $productExists = $conn->query("SELECT * FROM `product` WHERE `name` = '" . $_POST['name'] . "'");
      if ($productExists->rowCount() > 0)
      {
          $res = array(
              "status" => false,
              "message" => "Product Name Already Exists",
              "productName" => $_POST['name']
          );
      }
      else
      {
          $productData = $conn->query("SELECT * FROM category where `name` like '$_POST[category_id]'")->fetch(PDO::FETCH_ASSOC);
          $insProduct = $conn->query("INSERT INTO `product` (`name`, `description`, `img`, `purchase_price`,`Battery`, `Charger`,  `Disk`,   `Ram`, `Screen`, `Keyboard`,  `Total_cost`,  `category_id`)

            VALUES ('$_POST[name]',
             '$_POST[description]',
             '$uploadDirectory$_POST[img]', 
             '$_POST[purchase_price]',
             '$_POST[Battery]',
             '$_POST[Charger]',
             '$_POST[Disk]',
             '$_POST[Ram]',
             '$_POST[Screen]',
             '$_POST[Keyboard]',
             '$_POST[Total_cost]',
             '$productData[id]')");

          if ($insProduct)
          {
              $details_date = date("Y-m-d h:i:sa");
              $details_data = $conn->query("SELECT * FROM product where `name` like '$_POST[name]'")->fetch(PDO::FETCH_ASSOC);

              $details_run = $conn->query("INSERT INTO `product_details` (`id`, `create_date`, `create_by`)
                  VALUES ('$details_data[id]','$details_date','$_SESSION[name]')");

              if ($details_run)
              {

                  $add_action = 'Add ' . $_POST['name'] . ' in category ' . $productData['name'];
                  $user_active_query = $conn->query("INSERT INTO `user_activity`(`user_id`,`action`,`action_date`)        
                      VALUES ('$_SESSION[id]','$add_action','$time_date')");

                  $res = array(
                      'status' => true,
                      'message' => 'Product Add'
                  );

              }
          }
          else
          {
              $res = array(
                  "status" => false,
                  "productName" => $_POST['name']
              );
          }
      };

      echo json_encode($res);
  }

  ################################################################################################
  if (isset($_REQUEST['EditProduct']))
  {

      $productData = $conn->query("SELECT * FROM category where `name` like '$_POST[category_id]'")->fetch(PDO::FETCH_ASSOC);

      $id = $_POST['id'];

      $run = $conn->query("UPDATE product set
       `name`= '$_POST[name]', 
      `description`= '$_POST[description]', 
      `img` = '$uploadDirectory$_POST[img]',
      `purchase_price` =  '$_POST[purchase_price]',
      `Battery` =      '$_POST[Battery]',
      `Charger` =     '$_POST[Charger]',
      `Disk` =      '$_POST[Disk]',
      `Ram` =      '$_POST[Ram]',
      `Screen` =      '$_POST[Screen]',
      `Keyboard` =      '$_POST[Keyboard]',
      `Total_cost` =     '$_POST[Total_cost]',
       `category_id`= '$productData[id]' WHERE id like '$id';");

      if ($run)
      {

          $details_date = date("Y-m-d h:i:sa");
          $details_data = $conn->query("SELECT * FROM product where id like '$id'")->fetch(PDO::FETCH_ASSOC);
          $details_run = $conn->query("UPDATE product_details set `modify_by`= '$_SESSION[name]', `modify_date`= '$details_date' WHERE id like '$details_data[id]';");
          if ($details_run)
          {

              $add_action = 'Edit in product name ' . $_POST['name'] . ' in category ' . $productData['name'];

              $user_active_query = $conn->query("INSERT INTO `user_activity`(`user_id`,`action`,`action_date`)
              VALUES ('$_SESSION[id]','$add_action','$time_date')");

              $res = array(
                  'status' => true,
                  'message' => 'Product updated'
              );
          }

      }
      echo json_encode($res);

  }

  ################################################################################################
  
  if (isset($_REQUEST['product_del']))
  {

      $delete_id = $_POST['product_del'];
      $productdata = $conn->query("SELECT * FROM product where id like '$delete_id'")->fetch(PDO::FETCH_ASSOC);
      $categorydata = $conn->query("SELECT * FROM category where `id` like '$productdata[category_id]'")->fetch(PDO::FETCH_ASSOC);
      $delproduct = $conn->query("DELETE FROM `product` WHERE id = '$delete_id'");
      if ($delproduct)
      {
          $add_action = 'Delete product ' . $productdata['name'] . ' from category ' . $categorydata['name'];
          $user_active_query = $conn->query("INSERT INTO `user_activity`(`user_id`,`action`,`action_date`)        
          VALUES ('$_SESSION[id]','$add_action','$time_date')");

          $res = array(
              'status' => true,
              'message' => 'Product deleted'
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