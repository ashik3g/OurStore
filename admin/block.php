<?php  
session_start();
require_once('../config.php');

$user_id = $_REQUEST['id'];

$stm = $connection->prepare("UPDATE users SET status=? WHERE id=?");
$stm->execute(array("Blocked",$user_id));

$url = GET_APP_URL().'/admin/user-all.php?success=Block Successfully!';
 
header("location:$url");
