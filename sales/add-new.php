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
  
    if(empty($group_name)){
        $error = "Group Name is Required!";
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

        $success = "Create Successfully!";
    }

}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create New Sale</h4>
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
 
                    <div id="ajaxError" style="display:none;" class="alert alert-danger"></div> 


                    <div class="basic-form">
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="customer_name">Customer Name:</label>
                                <input type="text" name="customer_name" id="customer_name" class="form-control input-default" placeholder="Customer Name">
                            </div>

                            <div class="form-group">
                                <label for="product_id">Select Product:</label>
                                <select name="product_id" id="product_id" class="form-control">
                                    <option value="#">Select Product</option>
                                    <?php  
                                    $products = GetTableData('products');
                                    foreach( $products as $product) :
                                    ?>
                                    <option value="<?php echo $product['id']  ?>"><?php echo $product['name']  ?></option>
                                    <?php  endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="manufacture_name">Manufacture:</label>
                                <input type="text" name="manufacture_name" id="manufacture_name" class="form-control input-default" readonly>
                                <input type="hidden" name="manufacture_id" id="manufacture_id">
                            </div>
                            
                            <div class="form-group">
                                <label for="group_name">Group Name:</label>
                                <select name="group_name" id="group_name" class="form-control">
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="expire_date">Expire Date:</label>
                                <input type="text" name="expire_date" id="expire_date" class="form-control input-default" readonly>
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" name="price" id="price" class="form-control input-default" readonly>
                            </div>
                            <div class="form-group">
                                <label for="mprice">Manufacture Price:</label>
                                <input type="text" name="mprice" id="mprice" class="form-control input-default" readonly>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity: <span id="available_stock" class="badge badge-info"></span></label>
                                <input type="number" name="quantity" id="quantity" class="form-control input-default" placeholder="Quantity">
                                <input type="hidden" name="stock" id="stock">
                            </div>
                            <div class="form-group">
                                <label for="total_price">Total Price:</label>
                                <input type="text" name="total_price" id="total_price" class="form-control input-default" readonly>
                            </div>
                            
                            <div class="form-group">
                                <label for="discount_type">Discount Type:</label>
                                <select name="discount_type" id="discount_type" class="form-control">
                                    <option value="none">None</option>
                                    <option value="fixed">Fixed</option>
                                    <option value="percentage">Percentage</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="discount_amount">Discount Amount:</label>
                                <input type="text" name="discount_amount" id="discount_amount" class="form-control input-default">
                            </div>

                            <div class="form-group">
                                <label for="sub_total">Sub Total:</label>
                                <input type="text" name="sub_total" id="sub_total" class="form-control input-default" readonly>
                            </div>

                            <div class="form-group">
                                <input type="submit" id="saleBtn" name="add_new_form" class="btn btn-success" value="Create Sale" disabled>
                            </div>
                        </form>
                    </div>
                </div>
            </div>  
        </div>
            
    </div>
</div>
<?php  get_footer(); ?>
<script>
    var valid = 0;
    // GET Product Data
    $('#product_id').on('change',function(){
        let product_id = $(this).val();  
        $.ajax({
            type:"POST",
            url: 'ajax.php',
            data:{
                product_id:product_id
            },
            success: function(response){
                let productResult = JSON.parse(response);  
                if(productResult.count == 0){
                    $('#ajaxError').show().text(productResult.message);  
                }
                else{
                    $('#ajaxError').hide();
                    $('#manufacture_name').val(productResult.manufacture_name);
                    $('#manufacture_id').val(productResult.manufacture_id);
                    $('#stock').val(productResult.stock);
                    $('#available_stock').text("Available Stock: "+productResult.stock);

                    // Groups 
                    $('#group_name').empty();
                    let groups = productResult.groups;
                    $('#group_name').append('<option value="#">Select Group</option>');

                    $.each(groups,function(i,item){
                        $('<option value="'+groups[i].id+'" >').html(
                            '<span>'+groups[i].group_name+'</span>'
                        ).appendTo('#group_name');
                    });
                    
                } 
            } 
        }); 
    });


    // GET Ajax Data
    $('#group_name').on('change',function(){
        let group_id = $(this).val(); 
        $.ajax({
            type:"POST",
            url:"ajax.php",
            data:{
                group_id:group_id
            },
            success:function(response){
                let groupResult = JSON.parse(response); 
                $('#expire_date').val(groupResult.expire_date);
                $('#price').val(groupResult.per_item_price);
                $('#mprice').val(groupResult.per_item_m_price);
            }
        });
    });

    // Get Calculate Total Price
    $('#quantity').on('keyup',function(){
        let price = $('#price').val();
        let quantity = $(this).val();
        let stock = $('#stock').val();

        if(price.length == 0){
            $('#ajaxError').show().text("Please First Select Product and Group"); 
        }
        else if(!jQuery.isNumeric(quantity)){
            $('#ajaxError').show().text("Quantity Must be Number!"); 
        }
        else if(quantity>stock){
            $('#ajaxError').show().text("Product Stock is Low!"); 
        }
        else{
            $('#ajaxError').hide();
            let total_price = price*quantity;

            $('#total_price').val(total_price);
            $('#sub_total').val(total_price);

            valid = 1;
        } 
    });

    // Get Discount Total Price
    $('#discount_amount').on('keyup',function(){
        let type = $('#discount_type').val();
        let discount_amount = $(this).val();

        if(type == "fixed"){
            if(!jQuery.isNumeric(discount_amount)){
                $('#ajaxError').show().text("Discount Amount Must be Number!"); 
                valid = 0;
            }
            else{
                let total__price = $('#total_price').val();
                let new_sub_total = total__price-discount_amount;
                $('#sub_total').val(new_sub_total);

                valid = 1;
            } 
        }
        else if(type == "percentage"){
            if(!jQuery.isNumeric(discount_amount)){
                $('#ajaxError').show().text("Discount Amount Must be Number!"); 
                valid = 0;
            }
            else{
                let total___price = $('#total_price').val();
                let percentage_amount = total___price*discount_amount/100;
                let new__sub_total = total___price-percentage_amount;
                $('#sub_total').val(new__sub_total);

                valid = 1;
            } 
        } 
        else{
            $('#discount_amount').val('');
            let total__price = $('#total_price').val();
            $('#sub_total').val(total__price); 
            valid = 1;
        } 
    });

    $('#discount_type').on('change',function(){
        let dis_type = $(this).val(); 
        if(dis_type == "none"){
            $('#discount_amount').val('');
            let total__price = $('#total_price').val();
            $('#sub_total').val(total__price); 

            valid = 1;
        }
    });

    if(valid == 1){
        alert('Done');
        $('#saleBtn').removeAttr('disabled');
    }

    console.log(valid);
</script>