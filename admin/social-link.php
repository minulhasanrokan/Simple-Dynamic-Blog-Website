<?php

    include_once('inc/header.php');
    include_once('inc/sidebar.php');

    include_once('../classes/Social.php');

    $social = new Social();

    if ($_SERVER['REQUEST_METHOD']=="POST") {

        $addNewSocial = $social->add_social_link($_POST);
    }

    $socialData = $social->social_data();

    $socialData = mysqli_fetch_array($socialData);

    print_r($socialData);
?>

<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h2 class="mb-0">Social Link</h2>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                            if (isset($addNewSocial)) {
                                echo '<h2 class="mb-0">'.$addNewSocial.'</h2>';
                            }
                        ?>
                        
                        <form class="needs-validation" method="post" action="" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-12">
                                        <label class="form-label" for="validationCustom01">Twitter</label>
                                        <input type="text" name="twitter" class="form-control"  value="<?php echo $socialData['twitter'];?>" required>
                                    </div>
                                </div>
        
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-12">
                                        <label class="form-label" for="validationCustom01">Facebook</label>
                                        <input type="text" name="facebook" class="form-control"  value="<?php echo $socialData['facebook'];?>" required>
                                    </div>
                                </div>
        
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-12">
                                        <label class="form-label" for="validationCustom01">Instagram</label>
                                        <input type="text" name="instagram" class="form-control"  value="<?php echo $socialData['instagram'];?>" required>
                                    </div>
                                </div>
        
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-12">
                                        <label class="form-label" for="validationCustom01">Youtube</label>
                                        <input type="text" name="youtube" class="form-control"  value="<?php echo $socialData['youtube'];?>" required>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <button style="float:right;" class="btn btn-primary" type="submit">Add Socila Link</button>
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
