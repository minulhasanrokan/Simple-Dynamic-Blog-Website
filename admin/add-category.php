<?php

    include_once('inc/header.php');
    include_once('inc/sidebar.php');

    include_once('../classes/Category.php');

    $addCategory = new Category();

    if ($_SERVER['REQUEST_METHOD']=="POST") {

        $catName = $_POST['cat_name'];
        $catDes = $_POST['cat_des'];
        $catImg = $_FILES['cat_img'];

        $addNewCategory = $addCategory->add_category($catName,$catDes,$catImg);

        // code...
    }
?>

<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h2 class="mb-0">Add New Category</h2>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                            if (isset($addNewCategory)) {
                                echo '<h2 class="mb-0">'.$addNewCategory.'</h2>';
                            }
                        ?>
                        
                        <form class="needs-validation" method="post" action="" enctype="multipart/form-data">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="mb-12">
                                        <label class="form-label" for="validationCustom01">Category name</label>
                                        <input type="text" name="cat_name" class="form-control" id="validationCustom01" placeholder="Category name" value="Mark" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-12">
                                        <label class="form-label" for="validationCustom02">Category Description</label>
                                        <textarea name="cat_des" class="form-control" id="validationCustom02" placeholder="Last name" value="Otto"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-12">
                                        <label class="form-label" for="validationCustom03">Category Image</label>
                                        <input type="file" name="cat_img" class="form-control" id="validationCustom03" placeholder="City" required>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <button style="float:right;" class="btn btn-primary" type="submit">Add Category</button>
                        </form>
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
