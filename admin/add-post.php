<?php

    include_once('inc/header.php');
    include_once('inc/sidebar.php');

    include_once('../classes/category.php');

    include_once('../classes/Post.php');

    $category = new Category();

    $getCategories = $category->all_active_category();

    $post = new Post();

    if ($_SERVER['REQUEST_METHOD']=="POST") {

        $addNewPost = $post->add_post($_POST, $_FILES);

    }
?>

<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h2 class="mb-0">Add New Post</h2>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                            if (isset($addNewPost)) {
                                echo '<h2 class="mb-0">'.$addNewPost.'</h2>';
                            }
                        ?>
                        
                        <form class="needs-validation" method="post" action="" enctype="multipart/form-data">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="mb-12">
                                        <label class="form-label" for="validationCustom01"><h4 class="mb-0">Post Title</h4></label>
                                        <input type="text" name="post_title" class="form-control" id="validationCustom01" placeholder="Post Title" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-12">
                                        <label class="form-label" for="validationCustom02"><h4 class="mb-0">Select Post Category</h4></label>
                                        <select name="post_category" class="form-select">
                                            <?php while ($category= mysqli_fetch_assoc($getCategories)) {
                                                
                                            ?>
                                            <option value="<?php echo $category['cat_id'];?>"><?php echo $category['cat_name'];?></option>
                                            <?php }?>                                          
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-12">
                                        <label class="form-label" for="elm1"><h4 class="mb-0">Post Description 01</h4></label>
                                        <textarea id="classic-editor" name="post_des_o1"></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <div class="mb-12">
                                        <label class="form-label" for="elm1"><h4 class="mb-0">Post Description 02</h4></label>
                                        <textarea id="c-editor" name="post_des_o2"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-12">
                                        <label class="form-label" for="validationCustom03"><h4 class="mb-0">Post Image 01</h4></label>
                                        <input type="file" name="img_01" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-12">
                                        <label class="form-label" ><h4 class="mb-0">Post Image 02</h4></label>
                                        <input type="file" name="img_02" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-12">
                                    <label class="form-label" for="validationCustom02"><h4 class="mb-0">Select Post Type</h4></label>
                                    <select name="post_type" class="form-select">
                                        <option value="0">Post</option>
                                        <option value="1">Slider</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-12">
                                    <label class="form-label"><h4 class="mb-0">Post Tag</h4></label>
                                    <input type="text" name="post_tag" class="form-control" >
                                </div>
                            </div>
                            <br/>
                            <button style="float:right;" class="btn btn-primary" type="submit">Add New Post</button>
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
