<?php  
session_start();
require_once('../config.php');

DeleteTableData('categories',$_REQUEST['id']);

$url = GET_APP_URL().'/categories?success=Delete Successfully!';
 
header("location:$url");
