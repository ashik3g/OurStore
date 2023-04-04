<?php    
// User Input form Data Count
function InputCount($col,$value){
    global $connection;
    $stm = $connection->prepare("SELECT $col FROM users WHERE $col=?");
    $stm->execute(array($value));
    $count=$stm->rowCount(); 
    return  $count;
}
// Get Column Count
function GetColumnCount($tbl,$col,$value){
    global $connection;
    $stm = $connection->prepare("SELECT $col FROM $tbl WHERE $col=?");
    $stm->execute(array($value));
    $count=$stm->rowCount(); 
    return  $count;
}

// Get Table Data
function GetTableData($tbl){
    global $connection;
    $stm=$connection->prepare("SELECT * FROM $tbl WHERE user_id=?");
    $stm->execute(array($_SESSION['user']['id']));
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
// Get Single Table Data
function GetSingleData($tbl,$id){
    global $connection;
    $stm=$connection->prepare("SELECT * FROM $tbl WHERE user_id=? AND id=?");
    $stm->execute(array($_SESSION['user']['id'],$id));
    $result = $stm->fetch(PDO::FETCH_ASSOC);
    return $result;
}
// Delete Table Data
function DeleteTableData($tbl,$id){
    global $connection;
    $stm=$connection->prepare("DELETE FROM $tbl WHERE user_id=? AND id=?");
    $delete = $stm->execute(array($_SESSION['user']['id'],$id));
    return $delete;
}

// Get Product Category Name
function getProductCategoryName($col,$id){
    global $connection;
    $stm=$connection->prepare("SELECT $col FROM categories WHERE id=?");
    $stm->execute(array($id));
    $result = $stm->fetch(PDO::FETCH_ASSOC);
    return $result[$col];
}
// Get Product Name
function getProductName($col,$id){
    global $connection;
    $stm=$connection->prepare("SELECT $col FROM products WHERE id=?");
    $stm->execute(array($id));
    $result = $stm->fetch(PDO::FETCH_ASSOC);
    return $result[$col];
}
// Get Manufacture Name
function getManufactureName($col,$id){
    global $connection;
    $stm=$connection->prepare("SELECT $col FROM manufactures WHERE id=?");
    $stm->execute(array($id));
    $result = $stm->fetch(PDO::FETCH_ASSOC);
    return $result[$col];
}
// Get Group Name
function getGroupName($col,$name,$pid){
    global $connection;
    $stm=$connection->prepare("SELECT $col FROM groups WHERE group_name=? AND product_id=?");
    $stm->execute(array($name,$pid));
    $result = $stm->fetch(PDO::FETCH_ASSOC);
    return $result[$col];
}

// function getAdmin($id,$col){
//     global $connection;
//     $stm=$connection->prepare("SELECT $col FROM admins WHERE id=?");
//     $stm->execute(array($id));
//     $result=$stm->fetch(PDO::FETCH_ASSOC);
//     return $result[$col];
// }


// Login User Profile data
function getProfile($id){
    global $connection;
    $stm=$connection->prepare("SELECT * FROM users WHERE id=?");
    $stm->execute(array($id));
    $result=$stm->fetch(PDO::FETCH_ASSOC);
    return $result; 
}

function get_header(){
    require_once('includes/header.php');
}
 

function get_footer(){
    require_once('includes/footer.php');
}
 

// Send OTP On Mobile Number
function SendSMS($to,$message){  
    $token = "XXXXXXXXXXXXXXXXXXXXXX";
    $url = "http://api.greenweb.com.bd/api.php?json";

    $data= array(
    'to'=>"$to",
    'message'=>"$message",
    'token'=>"$token"
    ); 
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_ENCODING, '');
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $smsresult = curl_exec($ch);
    $smsresult = json_decode($smsresult,true);
    $status = $smsresult[0]['status'];
    return $status;
    //Error Display
    // echo curl_error($ch);
}
