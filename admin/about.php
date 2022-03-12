<?php

    include_once('inc/header.php');
    include_once('inc/sidebar.php');

    include_once('../classes/About.php');

    $about = new About();

    if ($_SERVER['REQUEST_METHOD']=="POST") {

        $addNewAbout = $about->add_about($_POST,$_FILES);
    }

    $aboutData = $about->about_data();

    $aboutData = mysqli_fetch_array($aboutData);

?>

<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h2 class="mb-0">About Us</h2>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                            if (isset($addNewAbout)) {
                                echo '<h2 class="mb-0">'.$addNewAbout.'</h2>';
                            }
                        ?>
                        
                        <form class="needs-validation" method="post" action="" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-12">
                                        <label class="form-label" for="validationCustom01">About Title</label>
                                        <input type="text" name="title" class="form-control"  value="<?php echo $aboutData['title'];?>" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-12">
                                        <label class="form-label" for="validationCustom01">About Details</label>
                                        <textarea type="text" name="details" class="form-control" required> <?php echo $aboutData['details'];?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-12">
                                    <label class="form-label" for="validationCustom03">Site Logo</label>
                                    <img style="width: 50px" src="uploads/<?php echo $aboutData['image'];?>">
                                    <input type="file" name="image" class="form-control" id="validationCustom03">
                                </div>
                            </div>
                            <br/>
                            <button style="float:right;" class="btn btn-primary" type="submit">Update About</button>
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