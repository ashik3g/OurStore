<?php 
    require_once('../config.php'); 
    admin_header(); 
    $id = $_REQUEST['id'];
   
    $Details = $connection->prepare("SELECT * FROM users WHERE id=?");
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
                                    <td><?php   echo  $result['username'];?></td>
                                </tr>
                                <tr>
                                    <td><b>Name:</b></td>
                                    <td><?php echo $result['name'];?></td>
                                </tr> 
                                <tr>
                                    <td><b>Email:</b></td>
                                    <td><?php echo  $result['email'];?></td>
                                </tr>
                                <tr>
                                    <td><b>Mobile:</b></td>
                                    <td><?php echo  $result['mobile'];  ?></td>
                                </tr>
                                <tr>
                                    <td><b>Business Name:</b></td>
                                    <td><?php echo  $result['business_name'];  ?></td>
                                </tr>
                                <tr>
                                    <td><b>Address:</b></td>
                                    <td><?php echo  $result['address'];  ?></td>
                                </tr> 
                                <tr>
                                    <td><b>Gender:</b></td>
                                    <td><?php echo  $result['gender'];  ?></td>
                                </tr>
                                <tr>
                                    <td><b>Birthday:</b></td>
                                    <td><?php echo  $result['date_of_birth'];  ?></td>
                                </tr>
                                <tr>
                                    <td><b>Status:</b></td>
                                    <td>
                                    <?php   
                                    if( $result['status'] == "Active"){
                                        echo "<span class='badge badge-success'>Active</span>";
                                    }
                                    else if( $result['status'] == "Pending"){
                                        echo "<span class='badge badge-warning'>Pending</span>";
                                    }
                                    else{
                                        echo "<span class='badge badge-danger'>". $result['status']."</span>";
                                    }
                                    ?></td>
                                </tr>
                                <tr>
                                    <td><b>Registration Date:</b></td>
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