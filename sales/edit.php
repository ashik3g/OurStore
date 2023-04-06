<?php 
require_once('../config.php'); 
get_header(); 
$id = $_REQUEST['id'];
$user_id = $_SESSION['user']['id'];

if(isset($_POST['update_form'])){
    $category_name = $_POST['cat_name'];
    $category_slug = $_POST['cat_slug'];

    $slugCount = GetColumnCount('categories','category_slug',$category_slug);
    $pattern1 = "/^[a-z-0-9]+$/";

    $stm = $connection->prepare("SELECT category_slug FROM categories WHERE category_slug=? AND id=?");
    $stm->execute(array($category_slug,$id));
    $ownSlugCount=$stm->rowCount();
 
    if(empty($category_name)){
        $error = "Category Name is Required!";
    }
    else if(empty($category_slug)){
        $error = "Category Slug is Required!";
    }
    else if($slugCount != 0 AND $ownSlugCount !=1){
        $error = "Category Slug Already Exists!";
    } 
    else if(!preg_match($pattern1, $category_slug)){
        $error = "Slug doesn't support any Special or White Space or Uppsercase Characters!";
    } 
    else{
        $now = date('Y-m-d H:i:s');
        $stm=$connection->prepare("UPDATE categories SET category_name=?,category_slug=? WHERE user_id=? AND id=?");
        $stm->execute(array($category_name,$category_slug,$user_id,$id));

        $success = "Category Update Successfully!";
    }

}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create New Category</h4>
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
                        <form method="POST" action="">
                            <?php  
                            $cat_data = GetSingleData('categories',$id);
                            
                            ?>
                            <div class="form-group">
                                <label for="cat_name">Category Name:</label>
                                <input type="text" name="cat_name" id="cat_name" class="form-control input-default" value="<?php echo $cat_data['category_name'] ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="cat_slug">Category Slug:</label>
                                <input type="text" name="cat_slug" id="cat_slug" class="form-control input-default" value="<?php echo $cat_data['category_slug'] ?>">
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