
<?php

    include_once('inc/header.php');

    include_once('inc/sidebar.php');

    include_once('../classes/Comment.php');

    include_once '../helpers/Format.php';

    $comment = new Comment();

    $format = new Format();

    if (isset($_GET['delete'])) {

        $commentId= $_GET['delete'];

        $status = $comment->delete_comment($commentId);
    }

    if (isset($_GET['deactive'])) {
        
        $commentId = $_GET['deactive'];

        $status = $comment->deactive_comment($commentId);
    }

    if (isset($_GET['active'])) {
        
        $commentId = $_GET['active'];

        $status = $comment->active_comment($commentId);
    }

    $getComment = $comment->all_comment();

    


?>
<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h2 class="mb-0">View All comment</h2>
                </div>
            </div>
        </div>
        <!-- end page title -->

          <div class="row">
             <?php
                            if (isset($status)) {
                                echo '<h2 class="mb-0">'.$status.'</h2>';
                            }

                        ?>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Website</th>
                                                <th>Post Title</th>
                                                <th>Comment</th>
                                                <th>Admin Replay</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            <?php
                                            if ($getComment) {
                                                $serial = 0;
                                                while($comment = mysqli_fetch_assoc($getComment)){
                                                    $serial++;


                                            ?>
                                            <tr>
                                                <td><?php echo $serial;?></td>
                                                <td><?php echo $comment['name'];?></td>
                                                <td><?php echo $comment['name'];?></td>
                                                <td><?php echo $comment['website'];?></td>
                                                <td><?php echo $comment['post_title'];?></td>
                                                <td><?php echo $comment['comment'];?></td>
                                                <td><?php echo $comment['admin_replay'];?></td>
                                                <td><?php
                                                    if ($comment['status']==0) {
                                                        echo "In Active";
                                                    }
                                                    elseif($comment['status']==1){
                                                        echo "Active";
                                                    }
                                                ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($comment['status']==0) {
                                                       ?>
                                                       <a href="?active=<?php echo $comment['id'];?>" class="btn btn-primary btn-sm"><i class="fas fa-arrow-up"></i></a>
                                                       <?php
                                                    }
                                                    elseif($comment['status']==1){
                                                       ?>
                                                       <a href="?deactive=<?php echo $comment['id'];?>" class="btn btn-danger btn-sm"><i class="fas fa-arrow-down"></i></a>
                                                       <?php
                                                    }
                                                ?>
                                                    <a href="replay-comment.php?replay-id=<?php echo $comment['id'];?>" class="btn btn-primary btn-sm">Replay</a><a href="?delete=<?php echo $comment['id'];?>" onClick="return confirm('Are You Sure Want to delete this comment?')" class="btn btn-danger btn-sm">Delete</a></td>
                                            </tr>
                                            <?php
                                                }
                                            }
                                            else{
                                                
                                            }
                                            ?>

                                            
                                            </tbody>
                                        </table>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
<!-- end row -->
    </div> <!-- container-fluid -->
</div>

<?php

include_once('inc/footer.php');
?>
