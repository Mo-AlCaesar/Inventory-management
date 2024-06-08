<?php

//require_once  $base_path. '/app/Http/Middleware/session.php';
$base_path = str_replace("\\", "/", $_SERVER['DOCUMENT_ROOT'] . $_SERVER['base_path']);
require_once $base_path . '/config/config.php';

$page = $_GET['page'];

switch ($page)
{

    case 'product':
        include ("resources/views/admin/product/home.php");
    break;

    case 'add-product':
        include ("resources/views/admin/product/add-product.php");
    break;

    case 'product-view':
        include ("resources/views/admin/product/product-view.php");
    break;

    case 'product-manage':
        include ("resources/views/admin/product/product-manage.php");
    break;

    case 'add-category':
        include ("resources/views/admin/category/add-category.php");
    break;

    case 'category-manage':
        include ("resources/views/admin/category/category-manage.php");
    break;

    case 'users':

        if ($_SESSION['role'] == "Admin")
        {
            include ("resources/views/admin/users/users-view.php");
        }
        else
        {
          header("Location:".base_url."");
          exit();
        }

    break;

    case 'user-manage':
        if ($_SESSION['role'] == "Admin")
        {
            include ("resources/views/admin/users/user-manage.php");
        }
        else
        {
          header("Location:".base_url."");
          exit();
        }

    break;
    
    case 'user-add':
        if ($_SESSION['role'] == "Admin")
        {
            include ("resources/views/admin/users/user-add.php");
        }
        else
        {
          header("Location:".base_url."");
          exit();
        }

    break;

    case 'user-activity':
        if ($_SESSION['role'] == "Admin")
        {
            include ("resources/views/admin/users/user-activity.php");
        }
        else
        {
          header("Location:".base_url."");
          exit();
        }

    break;

    case 'edit-profile':
        include ("resources/views/admin/users/edit-profile.php");
    break;

    case 'ajax':
        include ("app/Classes/master.php");
    break;

    case 'logout':
        include ("config/logout.php");
    break;

    default:
        include ("resources/views/admin/dashboard.php");
    break;
}

?>
