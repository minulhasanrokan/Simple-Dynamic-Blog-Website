
<?php

  include_once "classes/Post.php";
  include_once 'helpers/Format.php';

  $post = new Post();
  $format = new Format();

  $sliderPost = $post->slider_post();

  $limit = 2;

  if (isset($_GET['page'])) {

    $page = $_GET['page'];
  }
  else{
    $page = 1;
  }

  $ofset = ($page-1)*$limit;
  $getPsot = $post->all_latest_post($ofset, $limit);

  include_once('inc/header.php');
  include_once('inc/slider.php');

?>

<section class="site-section py-sm">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2 class="mb-4">Latest Posts</h2>
      </div>
    </div>
    <div class="row blog-entries">
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
                <?php
                  $totalPost = $post->number_if_post();

                  if ($totalPost) {
                    $totalRecord = mysqli_num_rows($totalPost);
                    
                    $totalPage = ceil($totalRecord/$limit);
                    for ($i=1; $i<=$totalPage ; $i++) { 
         
                 ?>
                <li class="page-item  active"><a class="page-link" href="index.php?Page=<?php echo $i;  ?>"><?php echo $i;  ?></a></li>
                <?php 
}
                   }
                ?>
        
              </ul>
            </nav>
          </div>
        </div>
      </div>

   <?php include_once("inc/sidebar.php");?>

    </div>
  </div>
</section>

 <?php include_once("inc/footer.php");?>