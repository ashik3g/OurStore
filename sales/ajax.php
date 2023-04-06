<?php   
require_once('../config.php');

 

if(isset($_POST['product_id'])){

    $stm=$connection->prepare("SELECT manufacture_id,product_id FROM purchases WHERE product_id=?");
    $stm->execute(array($_POST['product_id']));
    $productCount = $stm->rowCount();
    
    if( $productCount == 1){
        $result = $stm->fetch(PDO::FETCH_ASSOC); 
        $manufacture_name = getManufactureName('name',$result['manufacture_id']);

        // Get Groups
        $stm2=$connection->prepare("SELECT id,group_name,product_id FROM groups WHERE product_id=?");
        $stm2->execute(array($_POST['product_id']));
        $groups = $stm2->fetchAll(PDO::FETCH_ASSOC);

        $data = array(
            'message' => 'Product Get Success',
            'count' => $productCount,
            'manufacture_id' => $result['manufacture_id'],
            'manufacture_name' => $manufacture_name,
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



?>