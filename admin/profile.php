<?php

    include_once('inc/header.php');
    include_once('inc/sidebar.php');

    include_once('../classes/category.php');

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
            <div class="col-6">
                <div class="">
                    <h2 class="mb-0">User Profile</h2>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <label>User Name</label>
                                    <td><?php echo $userName =  Session::getSession('userName');?></td>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>User Photo</label>
                                    <td>
                                        <img src="uploads/<?php echo $image =  Session::getSession('image');?>">
                                    </td>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    
                                </td>
                                <td>
                                    <a href="edit-profile.php"><button style="float:right" class="btn btn-primary">Edit Profile</button></a>
                                </td>
                            </tr>
                        </table>
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
