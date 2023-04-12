<?php 
    require_once('../config.php'); 
    admin_header(); 
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                    <h4 class="card-title">All Products</h4> 
                    <div class="table-responsive">
                        
                        <table class="table header-border">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Photo</th>
                                    <th>Date</th>
                                    <th>User</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php $products = GetAdminData('products');
                                $a=1;
                                foreach($products as $product):
                                    $userData = getProfile($product['user_id']);
                                ?>
                                <tr>
                                    <td><?php  echo $a;$a++; ?></td>
                                    <td><a href="product.php?id=<?php  echo $product['id']; ?>"><?php  echo $product['name']; ?></a></td>
                                    <td><?php echo getProductCategoryName('category_name',$product['category_id']); ?></td>
                                    <td><img width="100" src="../uploads/products/<?php  echo $product['photo']; ?>" alt="<?php  echo $product['name']; ?>"></td>
                                    <td><?php  echo date('d-m-Y',strtotime($product['created_at'])); ?></td> 
                                    <td><a href="user-profile.php?id=<?php echo $product['user_id'];?>"><?php echo $userData['name'];?></a></td> 
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