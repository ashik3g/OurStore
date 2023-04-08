<?php   
require_once('../config.php');

 
// GET Product Data
if(isset($_POST['product_id'])){

    $stm=$connection->prepare("SELECT manufacture_id,product_id FROM purchases WHERE product_id=?");
    $stm->execute(array($_POST['product_id']));
    $productCount = $stm->rowCount();
    
    if( $productCount != 0){
        $result = $stm->fetch(PDO::FETCH_ASSOC); 
        $manufacture_name = getManufactureName('name',$result['manufacture_id']);

        // Get Groups
        $stm2=$connection->prepare("SELECT id,group_name,product_id FROM groups WHERE product_id=?");
        $stm2->execute(array($_POST['product_id']));
        $groups = $stm2->fetchAll(PDO::FETCH_ASSOC);

        // Get Product Stock
        $stock = getProductName('stock',$_POST['product_id']);

        $data = array(
            'message' => 'Product Get Success',
            'count' => $productCount,
            'manufacture_id' => $result['manufacture_id'],
            'manufacture_name' => $manufacture_name,
            'stock' => $stock,
            'groups' => $groups
        );

    }
    else{
        $data = array(
            'count' => $productCount,
            'message' => 'Product is Out of Stock'
        );
    }
     
    echo json_encode($data);
 
}


// GET Group Details
if(isset($_POST['group_id'])){

    $stm=$connection->prepare("SELECT id,expire_date,per_item_price,per_item_m_price FROM groups WHERE id=?");
    $stm->execute(array($_POST['group_id']));
    $result = $stm->fetch(PDO::FETCH_ASSOC);

    echo json_encode($result);


}


?>