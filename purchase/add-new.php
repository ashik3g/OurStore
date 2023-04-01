<?php 
require_once('../config.php'); 
get_header(); 

$user_id = $_SESSION['user']['id'];

if(isset($_POST['add_new_form'])){
    $manu_name = $_POST['manu_name'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];

    $mobileCount = GetColumnCount('manufactures','mobile',$mobile);
 
    if(empty($manu_name)){
        $error = "Name is Required!";
    }
    else if(empty($address)){
        $error = "Address is Required!";
    }
    else if(empty($mobile)){
        $error = "Mobile Number is Required!";
    }
    else if(!is_numeric($mobile)){
        $error = "Mobile Number must be Number!";
    }
    else if(strlen($mobile) != 11){
        $error = "Mobile Number must be 11 Digits!";
    }
    else if($mobileCount != 0){
        $error = "Mobile Number Already Exists!";
    }  
    else{
        $now = date('Y-m-d H:i:s');
        $stm=$connection->prepare("INSERT INTO manufactures(user_id,name,address,mobile,created_at) VALUES(?,?,?,?,?)");
        $stm->execute(array($user_id,$manu_name,$address,$mobile,$now));

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
                                <label for="manu_name">Select Product:</label>
                                <select name="product_category" id="product_category" class="form-control">
                                    <?php  
                                    $products = GetTableData('products');
                                    foreach( $products as $product) :
                                    ?>
                                    <option value="<?php echo $product['id']  ?>"><?php echo $product['name']  ?></option>
                                    <?php  endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="manu_name">Select Manufacture:</label>
                                <select name="product_category" id="product_category" class="form-control">
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
                                <label for="total_price">Total Price:</label>
                                <input type="text" name="total_price" id="total_price" class="form-control input-default" readonly>
                            </div>
                            <div class="form-group">
                                <label for="total_m_price">Total Manufacture Price:</label>
                                <input type="text" name="total_m_price" id="total_m_price" class="form-control input-default" readonly>
                            </div>
                            <div class="form-group">
                                <label for="expire">Expire Date:</label>
                                <input type="date" name="expire" id="expire" class="form-control input-default" placeholder="Expire Date">
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