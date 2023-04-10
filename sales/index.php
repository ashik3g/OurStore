<?php 
    require_once('../config.php'); 
    get_header(); 
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                    <h4 class="card-title">All Sales</h4>
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
                                    <th>Product Name</th>
                                    <th>Manufacture</th>
                                    <th>Group</th>
                                    <th>Quantity</th>
                                    <th>Sub Price</th>
                                    <th>Date</th>
                                    <th>Action</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sales = GetTableData('sales');
                                $a=1;
                                foreach($sales as $sale):
                                ?>
                                <tr>
                                    <td><?php  echo $a;$a++; ?></td>
                                    <td><?php  echo getProductName('name',$sale['product_id']); ?></td>
                                    <td><?php  echo getManufactureName('name',$sale['manufacture_id']); ?></td>
                                    <td><?php  echo getGroupNameByID('group_name',$sale['group_id'],$sale['product_id']); ?></td>
                                    <td><?php  echo $sale['quantity']; ?></td>
                                    <td><?php  echo $sale['sub_total']; ?></td>
                                    <td><?php  echo date('d-m-Y',strtotime($sale['created_at'])); ?></td>  
                                    <td>
                                        <a href="view.php?id=<?php echo $sale['id']; ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;

                                        <a href="edit.php?id=<?php echo $sale['id']; ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a> &nbsp;&nbsp;
                                        
                                        <a onclick="return confirm('Are you Sure?');" href="delete.php?id=<?php echo $sale['id']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
<?php  get_footer(); ?>