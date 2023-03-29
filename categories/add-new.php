<?php 
require_once('../config.php'); 
get_header(); 

$user_id = $_SESSION['user']['id'];

if(isset($_POST['add_new_form'])){
    $category_name = $_POST['cat_name'];
    $category_slug = $_POST['cat_slug'];

    $slugCount = GetColumnCount('categories','category_slug',$category_slug);
    $pattern1 = "/^[a-z-0-9]+$/";


    if(empty($category_name)){
        $error = "Category Name is Required!";
    }
    else if(empty($category_slug)){
        $error = "Category Slug is Required!";
    }
    else if($slugCount != 0){
        $error = "Category Slug Already Exists!";
    } 
    else if(!preg_match($pattern1, $category_slug)){
        $error = "Slug doesn't support any Special or White Space or Uppsercase Characters!";
    } 
    else{
        $now = date('Y-m-d H:i:s');
        $stm=$connection->prepare("INSERT INTO categories(user_id,category_name,category_slug,created_at) VALUES(?,?,?,?)");
        $stm->execute(array($user_id,$category_name,$category_slug,$now));

        $success = "Category Create Successfully!";
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
                            <div class="form-group">
                                <label for="cat_name">Category Name:</label>
                                <input type="text" name="cat_name" id="cat_name" class="form-control input-default" placeholder="Category Name">
                            </div>
                            
                            <div class="form-group">
                                <label for="cat_slug">Category Slug:</label>
                                <input type="text" name="cat_slug" id="cat_slug" class="form-control input-default" placeholder="Category Slug">
                            </div>
                            
                            <div class="form-group">
                                <input type="submit" name="add_new_form" class="btn btn-success" value="Create">
                            </div>
                        </form>
                    </div>
                </div>
            </div>  
        </div>
            
    </div>
</div>
<?php  get_footer(); ?>