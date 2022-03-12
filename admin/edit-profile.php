<?php

    include_once('inc/header.php');
    include_once('inc/sidebar.php');

    include_once('../classes/User.php');

    $user = new User();

    if ($_SERVER['REQUEST_METHOD']=="POST") {

        $userName = $_POST['user_name'];
        $userImg = $_FILES['user_img'];

        $addNewCategory = $user->update_user($userName,$userImg);

        // code...
    }

    $userData = $user->get_user_info($userId);
?>

<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h2 class="mb-0">User Profile Update</h2>
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
                        <?php
                          if (isset($userData)) {

                            while($user = mysqli_fetch_assoc($userData)){


                        ?>
                        <form class="needs-validation" method="post" action="" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-12">
                                        <label class="form-label" for="validationCustom01">User name</label>
                                        <input type="text" name="user_name" class="form-control" value="<?php echo $user['user_name'];?>"  required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-12">
                                        <label class="form-label" for="validationCustom03">User Image</label>
                                        <img style="width: 60px;" src="uploads/<?php echo $user['image'];?>">
                                        <input type="file" name="user_img" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <button style="float:right;" class="btn btn-primary" type="submit">Update Profile</button>
                        </form>
                        <?php                         
                            }
                            
                          }
                        ?>
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
