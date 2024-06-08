<?php



$host = "localhost";
$user = "root";
$pass = "";
$db   = "inventory_management";
$conn = null;

try {
  $conn = new PDO("mysql:host={$host};dbname={$db};",$user,$pass);
} catch (Exception $e) {
  
}

