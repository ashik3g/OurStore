<?php  
session_start();
require_once('../config.php');

$user_id = $_REQUEST['id'];

$stm = $connection->prepare("UPDATE users SET status=? WHERE id=?");
$stm->execute(array("Active",$user_id));

$url = GET_APP_URL().'/admin/user-all.php?success=Unblock Successfully!';
 
header("location:$url");
