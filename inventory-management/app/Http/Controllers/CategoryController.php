<?php

include('uploadFiles.php');

 ################################################################################################ Category
    
 if (isset($_REQUEST['AddCategory']))
 {

     $categoryExists = $conn->query("SELECT * FROM `category` WHERE `name` = '" . $_POST['name'] . "'");
     if ($categoryExists->rowCount() > 0)
     {
         $res = array(
             "status" => false,
             "message" => "Category Name Already Exists",
             "CategoryName" => $_POST['name']
         );
     }
     else
     {
         $insCategory = $conn->query("INSERT INTO `category` (`name`,`img`)
           VALUES ('$_POST[name]','$uploadDirectory$_POST[img]')");

         if ($insCategory)
         {

             $details_date = date("Y-m-d h:i:sa");
             $details_name = $_POST['name'];
             $details_data = $conn->query("SELECT * FROM category where `name` like '$details_name'")->fetch(PDO::FETCH_ASSOC);
             $details_run = $conn->query("INSERT INTO `category_details` (`id`, `create_date`, `create_by`)
                 VALUES ('$details_data[id]','$details_date','$_SESSION[name]')");

             if ($details_run)
             {
                 $add_action = 'Add New Category ' . $_POST['name'];
                 $user_active_query = $conn->query("INSERT INTO `user_activity`(`user_id`,`action`,`action_date`)        
                     VALUES ('$_SESSION[id]','$add_action','$time_date')");

                 $res = array(
                     'status' => true,
                     'message' => 'Category Add'
                 );

             }
         }
         else
         {
             $res = array(
                 "status" => false,
                 "CategoryName" => $_POST['name']
             );
         }
     };

     echo json_encode($res);

 }

 ################################################################################################
 if (isset($_REQUEST['EditCategory']))
 {

     $id = $_POST['id'];
     $run = $conn->query("UPDATE category set  `img` = '$uploadDirectory$_POST[img]' WHERE id like '$id';");
     if ($run)
     {

         $details_date = date("Y-m-d h:i:sa");
         $details_data = $conn->query("SELECT * FROM category where id like '$id'")->fetch(PDO::FETCH_ASSOC);
         $details_run = $conn->query("UPDATE `category_details` set `modify_by`= '$_SESSION[name]', `modify_date`= '$details_date' WHERE id like '$details_data[id]';");
         if ($details_run)
         {

             $add_action = 'Edit in Category name ' . $_POST['name'];

             $user_active_query = $conn->query("INSERT INTO `user_activity`(`user_id`,`action`,`action_date`)
             VALUES ('$_SESSION[id]','$add_action','$time_date')");

             $res = array(
                 'status' => true,
                 'message' => 'Category updated'
             );
         }

     }
     echo json_encode($res);

 }

 ################################################################################################
 

 if (isset($_REQUEST['category_del']))
 {

     $categoryExists = $conn->query("SELECT * FROM `product` WHERE category_id = '" . $_POST['category_del'] . "'");
     if ($categoryExists->rowCount() > 0)
     {
         $res = array(
             "status" => false,
             "message" => "This category cannot be deleted because it contains products."
         );

     }
     else
     {

         $delete_id = $_POST['category_del'];
         $categorydata = $conn->query("SELECT * FROM category where `id` =  '$delete_id'")->fetch(PDO::FETCH_ASSOC);
         $delproduct = $conn->query("DELETE FROM `category` WHERE id = '$delete_id'");
         if ($delproduct)
         {

             $add_action = 'Delete Category ' . $categorydata['name'];
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

     };

     echo json_encode($res);

 }



 ?>