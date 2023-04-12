<?php 
    require_once('../config.php'); 
    admin_header(); 
    $id = $_REQUEST['id'];
   
    $Details = $connection->prepare("SELECT * FROM products WHERE id=?");
    $Details->execute(array($id));
    $result = $Details->fetch(PDO::FETCH_ASSOC);
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                    <h4 class="card-title">Product Details</h4>
                    <hr>
                    <div class="table-responsive">
                        
                        <table class="table header-border"> 
                            <tbody>
                                <tr>
                                    <td><b>User Name:</b></td>
                                    <td><?php  
                                     $userData = getProfile($result['user_id']);
                                    echo $userData['name'];
                                    ?></td>
                                </tr>
                                <tr>
                                    <td><b>Product Name:</b></td>
                                    <td><?php echo $result['name'];?></td>
                                </tr> 
                                <tr>
                                    <td><b>Stock:</b></td>
                                    <td><?php echo  $result['stock'];?></td>
                                </tr>
                                <tr>
                                    <td><b>Description:</b></td>
                                    <td><?php echo  $result['description'];  ?></td>
                                </tr>
                                <tr>
                                    <td><b>Photo:</b></td>
                                    <td><img style="width:200px;height:auto;" src="../uploads/products/<?php echo  $result['photo'];  ?>" ></td>
                                </tr>  
                                <tr>
                                    <td><b>Created Date:</b></td>
                                    <td><?php echo  date('d-m-Y H:i:s',strtotime($result['created_at']));?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
            
    </div>
</div>
<?php admin_footer(); ?>