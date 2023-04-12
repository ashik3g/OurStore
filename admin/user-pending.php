<?php 
    require_once('../config.php'); 
    admin_header(); 
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                    <h4 class="card-title">All Users</h4> 
                    <?php if(isset($_REQUEST['success'])):?>
                    <div class="alert alert-success">
                        <?php echo $_REQUEST['success'];  ?>
                    </div> 
                    <?php endif; ?>
                    <div class="table-responsive">
                        
                        <table class="table header-border">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                 $stm = $connection->prepare("SELECT * FROM users WHERE status=?");
                                 $stm->execute(array("Pending"));
                                 $users = $stm->fetchAll(PDO::FETCH_ASSOC); 
                                $a=1;
                                foreach($users as $user): ?>
                                <tr>
                                    <td><?php  echo $a;$a++; ?></td>
                                    <td><a href="user-profile.php?id=<?php  echo $user['id']; ?>"><?php  echo $user['name']; ?></a></td>
                                    <td><?php  echo $user['mobile']; ?></td>
                                    <td><?php  echo $user['email']; ?></td>
                                    <td>
                                    <?php   
                                    if( $user['status'] == "Active"){
                                        echo "<span class='badge badge-success'>Active</span>";
                                    }
                                    else if( $user['status'] == "Pending"){
                                        echo "<span class='badge badge-warning'>Pending</span>";
                                    }
                                    else{
                                        echo "<span class='badge badge-danger'>". $user['status']."</span>";
                                    }
                                    ?></td>
                                    <td>
                                        <a href="user-profile.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;
                                        <?php if( $user['status'] == "Blocked") :  ?>
                                         <a onclick="return confirm('Are you Sure?');" href="unblock.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-info">Unblock</a>
                                        <?php else :  ?>
                                            <a onclick="return confirm('Are you Sure?');" href="block.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-danger">Block</a>
                                        <?php endif;  ?>
                                    </td>
                                    
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
            
    </div>
</div>
<?php  admin_footer(); ?>