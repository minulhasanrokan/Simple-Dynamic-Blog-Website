
<?php

  include_once "classes/Post.php";
  include_once 'helpers/Format.php';

  $post = new Post();
  $format = new Format();

  if (!isset($_POST['value']) || empty($_POST['value'])) {
    
    $message = "<h1>Search Result Not Found...</h1>";

  }
  elseif(isset($_POST['value'])){
    
    $getPsot = $post->search_post($_POST);
  }


  include_once('inc/header.php');

?>

<section class="site-section py-sm">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2 class="mb-4">Search post Posts</h2>
      </div>
    </div>
    <div class="row blog-entries">
      <?php
        if (isset($getPsot)) {
      ?>
      <div class="col-md-12 col-lg-8 main-content">
        <div class="row">
          <?php
            if ($getPsot) {
              while($psot = mysqli_fetch_assoc($getPsot)){

          ?>
          <div class="col-md-6">
            <a href="blog-single.php?post-id=<?php echo $psot['post_id'];?>" class="blog-entry element-animate" data-animate-effect="fadeIn">
              <img src="admin/uploads/<?php echo $psot['image_one'];?>" alt="Image placeholder">
              <div class="blog-content-body">
                <div class="post-meta">
                  <span class="author mr-2"> <?php echo $psot['cat_name'];?></span>
                  <span class="mr-2"><?php echo $psot['create_time'];?> </span> 
                </div>
                <a href="blog-single.php?post-id=<?php echo $psot['post_id'];?>">
                  <h2><?php echo $psot['post_title'];?></h2>
                </a>
              </div>
            </a>
          </div>
          <?php
               }
            }
          ?>
        </div>

        <div class="row mt-5">
          <div class="col-md-12 text-center">
            <nav aria-label="Page navigation" class="text-center">
              <ul class="pagination">
                <li class="page-item  active"><a class="page-link" href="#">&lt;</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#">5</a></li>
                <li class="page-item"><a class="page-link" href="#">&gt;</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    <?php }
    else{
      ?>
      <div class="col-md-12 col-lg-8 main-content">
        <div class="row">
        </div>

        <?php echo $message;?>
      </div>
      <?php
    }
    ?>
   <?php include_once("inc/sidebar.php");?>

    </div>
  </div>
</section>

 <?php include_once("inc/footer.php");?>