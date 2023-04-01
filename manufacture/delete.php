<?php  
session_start();
require_once('../config.php');

DeleteTableData('manufactures',$_REQUEST['id']);

$url = GET_APP_URL().'/manufacture?success=Delete Successfully!';
 
header("location:$url");
