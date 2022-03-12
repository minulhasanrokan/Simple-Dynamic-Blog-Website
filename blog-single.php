
<?php
  include_once('inc/header.php');

   include_once "classes/Post.php";

   include_once "classes/Comment.php";

    $post = new Post();

    $comment = new Comment();

  if (isset($_GET['post-id'])) {
    
    $postId = $_GET['post-id'];


    if ($_SERVER['REQUEST_METHOD']=="POST") {

      $addNewComment = $comment->add_comment($_POST,$postId);
    }

    $getSinglePsot = $post->get_single_post_data($postId);

    $allComment = $comment->get_all_comment($postId);
  }
?>

    <section class="site-section py-lg">
      <div class="container">
        
        <div class="row blog-entries element-animate">

          <?php
            if ($getSinglePsot) {
              while($singlePsot = mysqli_fetch_assoc($getSinglePsot)){
                $catId = $singlePsot['cat_id'];
          ?>
              <div class="col-md-12 col-lg-8 main-content">
                <img src="admin/uploads/<?php echo $singlePsot['image_one'];?>" alt="Image" class="img-fluid mb-5">
                 <div class="post-meta">
                            <span class="author mr-2"><?php echo $singlePsot['cat_name'];?></span>&bullet;
                            <span class="mr-2"><?php echo $singlePsot['create_time'];?> </span> &bullet;
                            <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                          </div>
                <h1 class="mb-4"><?php echo $singlePsot['post_title'];?></h1>
                <div class="post-content-body">
                  <p><?php echo $singlePsot['des_one'];?></p>
                <div class="row mb-5">
                  <div class="col-md-12 mb-4">
                    <img src="admin/uploads/<?php echo $singlePsot['image_two'];?>"  class="img-fluid">
                  </div>
                </div>
                <p><?php echo $singlePsot['des_two'];?></p>
                </div>
                <div class="pt-5">
                  <?php
                    if ($allComment) {

                      while($comment = mysqli_fetch_assoc($allComment)){

                  ?>
             
                  <ul class="comment-list">

                    <li class="comment">
                      <div class="vcard">
                        <img src="images/person_1.jpg" alt="Image placeholder">
                      </div>
                      <div class="comment-body">
                        <h3><?php echo $comment['name'];?></h3>
                        <div class="meta"><?php echo $comment['create_at'];?></div>
                        <p><?php echo $comment['comment'];?></p> 
                      </div>

                      <ul class="children">
                        <li class="comment">
                          <div class="vcard">
                            <img src="images/person_1.jpg" alt="Image placeholder">
                          </div>
                          <?php
                            if (isset($comment['admin_replay'])) {
                          ?>
                          <div class="comment-body">
                            <h3>Admin Replay</h3>   
                            <p><?php echo $comment['admin_replay'];?></p>
                           
                          </div>
                          <?php
                            }
                          ?>
                        </li>
                      </ul>
                    </li>
                  </ul>
                  <!-- END comment-list -->
                  <?php
                    }
                        // code...
                      }
                  ?>
                  
                  <div class="comment-form-wrap pt-5">
                    <h3 class="mb-5">Leave a comment</h3>
                    <?php if(isset($addNewComment)){?>
                    <h3 class="mb-5"><?php echo $addNewComment;?></h3>
                  <?php }?>
                    <form action="#" method="post" class="p-5 bg-light">
                      <div class="form-group">
                        <label for="name">Name *</label>
                        <input type="text" class="form-control" name="name" id="name">
                      </div>
                      <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" class="form-control" name="email" id="email">
                      </div>
                      <div class="form-group">
                        <label for="website">Website</label>
                        <input type="url" class="form-control" name="website" id="website">
                      </div>

                      <div class="form-group">
                        <label for="message">Message</label>
                        <textarea name="message" id="message"  cols="30" rows="10" class="form-control"></textarea>
                      </div>
                      <div class="form-group">
                        <input type="submit" name="comment" value="Post Comment" class="btn btn-primary">
                      </div>
                    </form>
                  </div>
                </div>

              </div>
          <?php
              }
            }
          ?>
          <!-- END main-content -->

          <?php include_once("inc/sidebar.php");?>
          <!-- END sidebar -->

        </div>
      </div>
    </section>

    <section class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="mb-3 ">Related Post</h2>
          </div>
        </div>
        <div class="row">
          <?php
          $getRelatedPsot = $post->get_related_post_data($postId,$catId);

          if ($getRelatedPsot) {
              while($relatedPsot = mysqli_fetch_assoc($getRelatedPsot)){

          ?>
          <div class="col-md-6 col-lg-4">
            <a href="blog-single.php?post-id=<?php echo $relatedPsot['post_id'];?>" class="a-block sm d-flex align-items-center height-md" style="background-image: url('admin/uploads/<?php echo $relatedPsot['image_one'];?>'); ">
              <div class="text">
                <div class="post-meta">
                  <span class="category"><?php echo $relatedPsot['cat_name'];?></span>
                  <span class="mr-2"><?php echo $relatedPsot['create_time'];?> </span> &bullet;
                </div>
                <h3><?php echo $relatedPsot['post_title'];?></h3>
              </div>
            </a>
          </div>
          <?php

              }
            }
          ?>
         
        </div>
      </div>


    </section>
    <!-- END section -->
  
     <?php include_once("inc/footer.php");?>