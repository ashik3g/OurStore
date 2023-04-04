<?php  
session_start();
require_once('../config.php');

DeleteTableData('purchases',$_REQUEST['id']);

$url = GET_APP_URL().'/purchases?success=Delete Successfully!';
 
header("location:$url");
