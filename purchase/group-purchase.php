<?php 
    require_once('../config.php'); 
    get_header(); 
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                    <h4 class="card-title">All Purchase</h4>
                    <?php if(isset($_REQUEST['success'])):?>
                    <div class="alert alert-success">
                        <?php echo $_REQUEST['success'];  ?>
                    </div> 
                    <?php endif; ?>
                    <div class="table-responsive">
                        
                        <table class="table header-border">
                            <thead>
                                <tr> 
                                    <th>Product Name</th>
                                    <th>Manufacture</th>
                                    <th>Group</th>
                                    <th>Expire</th>
                                    <th>Quantity</th>
                                    <th>Item Price</th>
                                    <th>Manufacture Price</th>
                                    <th>Total Price</th>
                                    <th>Action</th> 
                                </tr>
                            </thead>
                            <tbody> 
                                <tr> 
                                    <td>
                                        <div class="form-group">
                                            <select name="" class="form-control" id="">
                                                <option value="">Select Product</option>
                                                <option value="">Prouct Name</option> 
                                                <option value="">Prouct Name</option> 
                                                <option value="">Prouct Name</option> 
                                                <option value="">Prouct Name</option> 
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <select name="" class="form-control" id="">
                                                <option value="">Select Manufacture</option>
                                                <option value="">Manufacture Name</option>  
                                                <option value="">Manufacture Name</option>  
                                                <option value="">Manufacture Name</option>  
                                                <option value="">Manufacture Name</option>  
                                            </select>
                                        </div>
                                    </td>
                                    <td><input type="text" class="form-control" name="" placeholder="Group Name" id=""></td>
                                    <td><input type="date" class="form-control" name="" placeholder="Expire" id=""></td>
                                    <td><input type="number" class="form-control" name="" placeholder="Quantity" id=""></td>
                                    <td><input type="number" class="form-control" name="" placeholder="Item Price" id=""></td> 
                                    <td><input type="number" class="form-control" name="" placeholder="Manufacture Price" id=""></td> 
                                    <td><input type="number" class="form-control" name="" placeholder="Total Price" id=""></td> 
                                    <td> 
                                        <a onclick="return confirm('Are you Sure?');" href="" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Remove</a>
                                    </td>
                                </tr> 

                                <tr>
                                    <td colspan="10" class="text-right"><button type="button" class="btn btn-primary">Add New</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
        </div>
            
    </div>
</div>
<?php  get_footer(); ?>