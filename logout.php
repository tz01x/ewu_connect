<?php 

require_once("helper.php");
 session_start(); 
//  unset($_SESSION['uid']);
session_unset();
$get_host=getHost();
 header("Location: $get_host");

?>