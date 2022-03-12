<?php

    include_once('inc/header.php');
    include_once('inc/sidebar.php');

    include_once('../classes/Logo.php');

    $logo = new Logo();

    if ($_SERVER['REQUEST_METHOD']=="POST") {

        $addNewLogo = $logo->add_logo($_POST,$_FILES);
    }

    $logoData = $logo->logo_data();

    $logoData = mysqli_fetch_array($logoData);

?>

<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h2 class="mb-0">Site Logo, tagnile And Title</h2>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                            if (isset($addNewLogo)) {
                                echo '<h2 class="mb-0">'.$addNewLogo.'</h2>';
                            }
                        ?>
                        
                        <form class="needs-validation" method="post" action="" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-12">
                                        <label class="form-label" for="validationCustom01">Site Title</label>
                                        <input type="text" name="title" class="form-control"  value="<?php echo $logoData['title'];?>" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-12">
                                        <label class="form-label" for="validationCustom01">Site Tagline</label>
                                        <input type="text" name="tagline" class="form-control"  value="<?php echo $logoData['tagline'];?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-12">
                                    <label class="form-label" for="validationCustom03">Site Logo</label>
                                    <img style="width: 50px" src="uploads/<?php echo $logoData['logo'];?>">
                                    <input type="file" name="logo" class="form-control" id="validationCustom03">
                                </div>
                            </div>
                            <br/>
                            <button style="float:right;" class="btn btn-primary" type="submit">Update Logo</button>
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