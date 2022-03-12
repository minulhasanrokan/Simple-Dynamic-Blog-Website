<?php

    include_once('inc/header.php');
    include_once('inc/sidebar.php');

    include_once('../classes/Comment.php');

    $comment = new Comment();
    if (isset($_GET['replay-id'])) {

        $commentId = $_GET['replay-id'];

        if ($_SERVER['REQUEST_METHOD']=="POST") {

            $addReplay = $comment->replay_comment($_POST,$commentId);
        }
    }
    else{

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
                            if (isset($addReplay)) {
                                echo '<h2 class="mb-0">'.$addReplay.'</h2>';
                            }
                        ?>
                        
                        <form class="needs-validation" method="post" action="">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="mb-12">
                                        <label class="form-label" for="validationCustom01">Replay Message</label>
                                        <textarea name="comment_replay" class="form-control" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <button style="float:right;" class="btn btn-primary" type="submit">Replay Comment</button>
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
