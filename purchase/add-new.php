<?php 
require_once('../config.php'); 
get_header(); 

$user_id = $_SESSION['user']['id'];

if(isset($_POST['add_new_form'])){

    $product_id = $_POST['product_id'];
    $manufacture_id = $_POST['manufacture_id'];
    $group_name = $_POST['group_name'];
    $price_per_item = $_POST['price'];
    $price_per_m_item = $_POST['mprice'];
    $quantity = $_POST['quantity'];
    $expire_date = $_POST['expire_date'];

     
    $groupCount = GetColumnCount('purchases','group_name',$group_name);
  
    if(empty($group_name)){
        $error = "Group Name is Required!";
    }
    else if($groupCount != 0){
        $error = "Group Name Already Exists!";
    }
    else if(empty($price_per_item)){
        $error = "Price is Required!";
    }
    else if(!is_numeric($price_per_item)){
        $error = "Price must be Number!";
    }
    else if(empty($price_per_m_item)){
        $error = "Manufacture Price is Required!";
    }
    else if(!is_numeric($price_per_m_item)){
        $error = "Manufacture Price must be Number!";
    }
    else if(empty($quantity)){
        $error = "Quantity is Required!";
    }
    else if(!is_numeric($quantity)){
        $error = "Quantity must be Number!";
    }
    else if(empty($expire_date)){
        $error = "Expire Date is Required!";
    }
    else{
        $now = date('Y-m-d H:i:s');
        $total_price = $price_per_item*$quantity;
        $total_m_price = $price_per_m_item*$quantity;

        // Create Group
        $stm=$connection->prepare("INSERT INTO groups(user_id,group_name,product_id,quantity,expire_date,per_item_price,per_item_m_price,total_price,total_m_price,created_at) VALUES(?,?,?,?,?,?,?,?,?,?)");
        $stm->execute(array($user_id,$group_name,$product_id,$quantity,$expire_date,$price_per_item,$price_per_m_item,$total_price,$total_m_price,$now));

        // Create Purchase
        $stm=$connection->prepare("INSERT INTO purchases(user_id,manufacture_id,product_id,group_name,quantity,per_item_price,per_item_m_price,total_price,total_m_price,created_at) VALUES(?,?,?,?,?,?,?,?,?,?)");
        $stm->execute(array($user_id,$manufacture_id,$product_id,$group_name,$quantity,$price_per_item,$price_per_m_item,$total_price,$total_m_price,$now));

        // Update Product Stock
        $stm2=$connection->prepare("UPDATE products SET stock=stock+? WHERE id=? AND user_id=?");
        $stm2->execute(array($quantity,$product_id,$user_id));

        $success = "Create Successfully!";
    }

}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create New Purchase</h4>
                    <hr> 
                    <?php if(isset($error)):?>
                    <div class="alert alert-danger">
                        <?php echo $error;  ?>
                    </div>
                    <?php endif; ?>
                    <?php if(isset($success)):?>
                    <div class="alert alert-success">
                        <?php echo $success;  ?>
                    </div> 
                    <?php endif; ?>

                    <div class="basic-form">
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="product_id">Select Product:</label>
                                <select name="product_id" id="product_id" class="form-control">
                                    <?php  
                                    $products = GetTableData('products');
                                    foreach( $products as $product) :
                                    ?>
                                    <option value="<?php echo $product['id']  ?>"><?php echo $product['name']  ?></option>
                                    <?php  endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="manufacture_id">Select Manufacture:</label>
                                <select name="manufacture_id" id="manufacture_id" class="form-control">
                                    <?php  
                                    $manufactures = GetTableData('manufactures');
                                    foreach( $manufactures as $manu) :
                                    ?>
                                    <option value="<?php echo $manu['id']  ?>"><?php echo $manu['name']." - ".$manu['mobile'];  ?></option>
                                    <?php  endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="group_name">Group Name:</label>
                                <input type="text" name="group_name" id="group_name" class="form-control input-default" placeholder="Group Name">
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" name="price" id="price" class="form-control input-default" placeholder="Price">
                            </div>
                            <div class="form-group">
                                <label for="mprice">Manufacture Price:</label>
                                <input type="text" name="mprice" id="mprice" class="form-control input-default" placeholder="Manufacture Price">
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity:</label>
                                <input type="text" name="quantity" id="quantity" class="form-control input-default" placeholder="Quantity">
                            </div>
                            
                            <div class="form-group">
                                <label for="expire_date">Expire Date:</label>
                                <input type="date" name="expire_date" id="expire_date" class="form-control input-default" placeholder="Expire Date">
                            </div>
                            
                            <div class="form-group">
                                <input type="submit" name="add_new_form" class="btn btn-success" value="Purchase">
                            </div>
                        </form>
                    </div>
                </div>
            </div>  
        </div>
            
    </div>
</div>
<?php  get_footer(); ?>