<?php 
    require_once('../config.php'); 
    get_header(); 
    $id = $_REQUEST['id'];
    $user_id = $_SESSION['user']['id'];

    $Details = $connection->prepare("SELECT * FROM groups WHERE user_id=? AND id=?");
    $Details->execute(array($user_id,$id));
    $result = $Details->fetch(PDO::FETCH_ASSOC);
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                    <h4 class="card-title">Purchase Details</h4>
                    <hr>
                    <div class="table-responsive">
                        
                        <table class="table header-border"> 
                            <tbody>
                                <tr>
                                    <td><b>Group Name:</b></td>
                                    <td><?php echo  $result['group_name'];  ?></td>
                                </tr>
                                <tr>
                                    <td><b>Product Name:</b></td>
                                    <td><?php echo  getProductName('name',$result['product_id']);  ?></td>
                                </tr>
                                
                                <tr>
                                    <td><b>Expire Date:</b></td>
                                    <td><?php echo date('d-m-Y',strtotime($result['expire_date'])); ?></td>
                                </tr>
                                <tr>
                                    <td><b>Quantity:</b></td>
                                    <td><?php echo  $result['quantity'];  ?></td>
                                </tr>
                                <tr>
                                    <td><b>Per Item Price:</b></td>
                                    <td><?php echo  $result['per_item_price'];  ?> tk</td>
                                </tr>
                                <tr>
                                    <td><b>Per Item Manufacture Price:</b></td>
                                    <td><?php echo  $result['per_item_m_price'];  ?> tk</td>
                                </tr>
                                <tr>
                                    <td><b>Total Price:</b></td>
                                    <td><?php echo  $result['total_price'];  ?> tk</td>
                                </tr>
                                <tr>
                                    <td><b>Total Manufacture Price:</b></td>
                                    <td><?php echo  $result['total_m_price'];  ?> tk</td>
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
<?php  get_footer(); ?>