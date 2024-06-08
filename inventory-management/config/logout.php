<?php 

$base_path = str_replace("\\" , "/" ,$_SERVER['DOCUMENT_ROOT'].$_SERVER['base_path']);
require_once  $base_path. '/config/config.php';

session_unset();
session_destroy();

$url = base_url;

header("Location: $url");