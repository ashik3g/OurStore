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
 