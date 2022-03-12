<?php
    include_once('inc/header.php');
    include_once('inc/sidebar.php');

    include_once('../classes/category.php');

    $editCategory = new Category();

    if (isset($_GET['edit-id'])) {

    	$catId = $_GET['edit-id'];

    	$Category = $editCategory->get_edit_category_data($catId);



    }


    if ($_SERVER['REQUEST_METHOD']=="POST") {

        $catName = $_POST['cat_name'];
        $catDes = $_POST['cat_des'];
        $catImg = $_FILES['cat_img'];


        $catId = $_GET['edit-id'];

        $updateCategory = $editCategory->update_category($catName,$catDes,$catImg,$catId);
    }
?>

<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h2 class="mb-0">Edit Category</h2>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">

                        <?php
                            if (isset($updateCategory)) {
                                echo '<h2 class="mb-0">'.$updateCategory.'</h2>';
                            }
                        ?>
                        <?php
                            if (isset($addNewCategory)) {
                                echo '<h2 class="mb-0">'.$addNewCategory.'</h2>';
                            }


                        ?>
                        
                        <?php
                        if ($Category) {
                        	
                        	while($categoryData = mysqli_fetch_assoc($Category)){
                        	
                        
                        ?>

                        <form class="needs-validation" method="post" action="" enctype="multipart/form-data">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="mb-12">
                                        <label class="form-label" for="validationCustom01">Category name</label>
                                        <input type="text" name="cat_name" class="form-control" id="validationCustom01" placeholder="Category name" value="<?php echo $categoryData['cat_name'];?>" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-12">
                                        <label class="form-label" for="validationCustom02">Category Description</label>
                                        <textarea name="cat_des" class="form-control" id="validationCustom02" placeholder="Last name" value="Otto"><?php echo $categoryData['cat_des'];?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-12">
                                        <label class="form-label" for="validationCustom03">Category Image</label>
                                        <img width="50px" src="uploads/<?php echo $categoryData['cat_img'];?>">
                                        <input type="file" name="cat_img" class="form-control" id="validationCustom03" placeholder="City">
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <button style="float:right;" class="btn btn-primary" type="submit">Update Category</button>
                        </form>
                    <?php } }?>
                    </div>
                </div>
                <!-- end card -->
            </div> <!-- end col -->
        </div>
<!-- end row -->
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->


<?php
include_once('inc/footer.php');
?>
