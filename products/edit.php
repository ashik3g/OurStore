<?php 
require_once('../config.php'); 
get_header(); 
$id = $_REQUEST['id'];
$user_id = $_SESSION['user']['id'];

if(isset($_POST['update_form'])){
    $target_directory = "../uploads/products/";

    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $description = $_POST['description']; 

    if(empty($product_name)){
        $error = "Product Name is Required!";
    }
    else if(empty($product_category)){
        $error = "Category is Required!";
    }  
    else{
        $image_link = getProductName('photo',$id); 
        if(!empty($_FILES['photo']['name'])){ 
            $target_file = $target_directory . basename($_FILES["photo"]["name"]);
            $photoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            if($photoFileType != 'jpg' && $photoFileType != 'jpeg' && $photoFileType != 'png'){
                $error = "Photo must be Jpg or Png!";
            } 
            else{  
                $new_photo_name = $user_id."-".rand(1111,9999)."-".time().'.'.$photoFileType;  
                move_uploaded_file($_FILES["photo"]["tmp_name"],$target_directory.$new_photo_name);
                
                if(file_exists($target_directory.$image_link)){
                    unlink($target_directory.$image_link); 
                } 
            }  
            $image_link =  $new_photo_name;
        } 
        
        $stm=$connection->prepare("UPDATE products SET name=?,category_id=?,description=?,photo=? WHERE id=?");
        $stm->execute(array($product_name,$product_category,$description,$image_link,$id));

        $success = "Product Update Successfully!"; 
    }

}

// option 1
// if(!empty($_FILES['photo']['name'])){ 
//     $target_file = $target_directory . basename($_FILES["photo"]["name"]);
//     $photoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//     if($photoFileType != 'jpg' && $photoFileType != 'jpeg' && $photoFileType != 'png'){
//         $error = "Photo must be Jpg or Png!";
//     } 
//     else{ 
//         $new_photo_name = $user_id."-".rand(1111,9999)."-".time().'.'.$photoFileType; 
//         // $getSize = getimagesize($_FILES["photo"]["tmp_name"]); 
//         // print_r($getSize); 
//         move_uploaded_file($_FILES["photo"]["tmp_name"],$target_directory.$new_photo_name);

//         $stm=$connection->prepare("UPDATE products SET name=?,category_id=?,description=?,photo=? WHERE id=?");
//         $stm->execute(array($product_name,$product_category,$description,$new_photo_name,$id));

//         $success = "Product Update Successfully!";
//     }
// } 
// else{

//     $stm=$connection->prepare("UPDATE products SET name=?,category_id=?,description=? WHERE id=?");
//     $stm->execute(array($product_name,$product_category,$description,$id));

//     $success = "Product Update Successfully!";

// }


?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Product</h4>
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
                        <form method="POST" action="" enctype="multipart/form-data">
                            <?php  
                            $data = GetSingleData('products',$id);
                            
                            ?>
                            <div class="form-group">
                                <label for="product_name">Product Name:</label>
                                <input type="text" name="product_name" id="product_name" class="form-control input-default" value="<?php echo $data['name'];?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="product_category">Select Category:</label>
                                <select name="product_category" id="product_category" class="form-control">
                                    <?php  
                                    $categories = GetTableData('categories');
                                    foreach( $categories as $category) :
                                    ?>
                                    <option value="<?php echo $category['id'];  ?>"
                                    <?php if($data['category_id'] == $category['id'] ){
                                        echo "selected";
                                    };?>
                                    ><?php echo $category['category_name']  ?></option>
                                    <?php  endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="description">Description:</label>
                               <textarea name="description" id="description" class="form-control summernote" cols="30" rows="8"><?php echo $data['description']  ?></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="photo">Photo: <mark>Skip it, if won't update photo!</mark></label>
                               <input type="file" name="photo" id="photo" class="form-control">

                               <div class="preview">
                                <img style="height:100px;width:auto;" src="../uploads/products/<?php echo $data['photo']  ?>">
                               </div>
                            </div>

                            <div class="form-group">
                                <input type="submit" name="update_form" class="btn btn-success" value="Update">
                            </div>
                        </form>
                    </div>
                </div>
            </div>  
        </div>
            
    </div>
</div>
<?php  get_footer(); ?>