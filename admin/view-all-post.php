
<?php

    include_once('inc/header.php');

    include_once('inc/sidebar.php');

    include_once('../classes/Post.php');

    include_once '../helpers/Format.php';

    $allPost = new Post();

    $format = new Format();

    if (isset($_GET['delete'])) {

        $postId= $_GET['delete'];

        $deletecategory = $allPost->delete_post($postId);
    }

    if (isset($_GET['deactive'])) {
        
        $postId = $_GET['deactive'];

        $status = $allPost->deactive_post($postId);
    }

    if (isset($_GET['active'])) {
        
        $postId = $_GET['active'];

        $status = $allPost->active_post($postId);
    }

    $getAllPost = $allPost->all_post($userId);

    


?>
<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h2 class="mb-0">View All Post</h2>
                </div>
            </div>
        </div>
        <!-- end page title -->

          <div class="row">
             <?php
                            if (isset($deletecategory)) {
                                echo '<h2 class="mb-0">'.$deletecategory.'</h2>';
                            }

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
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>Image 01</th>
                                                <th>Image 02</th>
                                                <th>Post Type</th>
                                                <th>Tags</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            <?php
                                            if ($getAllPost) {
                                                $serial = 0;
                                                while($post = mysqli_fetch_assoc($getAllPost)){
                                                    $serial++;


                                            ?>
                                            <tr>
                                                <td><?php echo $serial;?></td>
                                                <td><?php echo $post['post_title'];?></td>
                                                <td><?php echo $post['cat_name'];?></td>
                                                <td><img width="30px" src="uploads/<?php echo $post['image_one'];?>"/></td>
                                                <td><img width="30px" src="uploads/<?php echo $post['image_two'];?>"/></td>
                                                <td>
                                                <?php
                                                    if ($post['post_type']==0) {
                                                        echo "Post";
                                                    }
                                                    elseif($post['post_type']==1){
                                                        echo "Slider";
                                                    }
                                                ?>
                                                    
                                                </td> 
                                                <td><?php echo $format->text_shorten($post['post_tag'], 5);?></td>
                                                <td><?php
                                                    if ($post['post_status']==0) {
                                                        echo "In Active";
                                                    }
                                                    elseif($post['post_status']==1){
                                                        echo "Active";
                                                    }
                                                ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($post['post_status']==0) {
                                                       ?>
                                                       <a href="?active=<?php echo $post['post_id'];?>" class="btn btn-primary btn-sm"><i class="fas fa-arrow-up"></i></a>
                                                       <?php
                                                    }
                                                    elseif($post['post_status']==1){
                                                       ?>
                                                       <a href="?deactive=<?php echo $post['post_id'];?>" class="btn btn-danger btn-sm"><i class="fas fa-arrow-down"></i></a>
                                                       <?php
                                                    }
                                                ?>
                                                    <a href="edit-post.php?edit-id=<?php echo $post['post_id'];?>" class="btn btn-primary btn-sm">Edit</a><a href="?delete=<?php echo $post['post_id'];?>" onClick="return confirm('Are You Sure Want to delete this Post?')" class="btn btn-danger btn-sm">Delete</a><a href="" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg-<?php echo $post['post_id'];?>">View</a></td>
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
    $modelData = $allPost->model_data();

    if ($modelData) {

        while ($data = mysqli_fetch_assoc($modelData)) {
    ?>

<!--  Large modal example -->
<div class="modal fade bs-example-modal-lg-<?php echo $data['post_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Post Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <td>Title:</td>
                        <td><?php echo $data['post_title'];?></td>
                    </tr>
                    <tr>
                        <td>Category:</td>
                        <td><?php echo $data['cat_name'];?></td>
                    </tr>
                    <tr>

                        <td>Image 01:</td>

                        <td><img width="30px" src="uploads/<?php echo $data['image_one'];?>"/></td>
                    </tr>
                    <tr>
                        <td>Image 02:</td>
                        <td><img width="30px" src="uploads/<?php echo $data['image_two'];?>"/></td>
                    </tr>
                    <tr>
                        <td>Description 01:</td>
                        <td><?php echo $data['des_one'];?></td>
                    </tr>

                    <tr>
                        <td>Description 02:</td>
                        <td><?php echo $data['des_two'];?></td>
                    </tr>

                    <tr>
                        <td>Post Type:</td>
                        <td><?php
                                if ($data['post_type']==0) {
                                    echo "Post";
                                }
                                elseif($data['post_type']==1){
                                    echo "Slider";
                                }
                        ?></td>
                    </tr>
                    <tr>
                        <td>Tags:</td>
                        <td><?php echo $data['post_tag'];?></td>
                    </tr>
                    <tr>
                        <td>Status:</td>
                        <td><?php
                                if ($data['post_status']==0) {
                                    echo "Un Published";
                                }
                                elseif($data['post_status']==1){
                                    echo "Published";
                                }
                        ?></td>
                    </tr>
                    
                </table>
                
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php 
            }
    }
?>

<?php

include_once('inc/footer.php');
?>
