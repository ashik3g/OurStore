<?php 
    require_once('../config.php'); 
    admin_header(); 
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                    <h4 class="card-title">All Product Categories</h4> 
                    <div class="table-responsive">
                        
                        <table class="table header-border">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Name</th>
                                    <th>Category Slug</th>
                                    <th>Date</th>
                                    <th>User</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php $catgories = GetAdminData('categories');
                                $a=1;
                                foreach($catgories as $category): 
                                $userData = getProfile($category['user_id']);
                                ?>
                                <tr>
                                    <td><?php  echo $a;$a++; ?></td>
                                    <td><?php  echo $category['category_name']; ?></td>
                                    <td><?php  echo $category['category_slug']; ?></td>
                                    <td><?php  echo date('d-m-Y',strtotime($category['created_at'])); ?></td> 
                                    <td><a href="user-profile.php?id=<?php echo $category['user_id'];?>"><?php echo $userData['name'];?></a></td> 
                                    
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