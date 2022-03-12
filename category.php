
<?php
  include_once('inc/header.php');

    include_once'classes/Post.php';

    $post = new Post();

  if (isset($_GET['category-id'])) {
    
    $catId = $_GET['category-id'];

    $limit = 12;

    if (isset($_GET['page'])) {

      $page = $_GET['page'];
    }
    else{
      $page = 1;
    }

  $ofset = ($page-1)*$limit;

    $getCategoryPost = $post->get_category_post($catId,$ofset, $limit);
  }
?>
    <section class="site-section pt-5">
      <div class="container">
        <div class="row blog-entries">
          <div class="col-md-12 col-lg-8 main-content">
            <div class="row mb-5 mt-5">
              <div class="col-md-12">

                <?php

                if ($getCategoryPost) {
                    while($categoryPost = mysqli_fetch_assoc($getCategoryPost)){
                ?>

                <div class="post-entry-horzontal">
                  <a href="blog-single.php?post-id=<?php echo $categoryPost['post_id'];?>">
                    <div class="image element-animate" data-animate-effect="fadeIn" style="background-image: url(admin/uploads/<?php echo $categoryPost['image_one'];?>);"></div>
                    <span class="text">
                      <div class="post-meta">
                        <span class="mr-2"><?php echo $categoryPost['cat_name'];?></span>&bullet;
                        <span class="mr-2"><?php echo $categoryPost['create_time'];?></span> &bullet;
                      </div>
                      <h2><?php echo $categoryPost['post_title'];?></h2>
                    </span>
                  </a>
                </div>
                 <?php
                    }
                  }
                ?>

              </div>
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
                <li class="page-item  active"><a class="page-link" href="category.php?category-id=<?php echo $catId;?>&&Page=<?php echo $i;  ?>"><?php echo $i;  ?></a></li>
                <?php 
}
                   }
                ?>
        
              </ul>
            </nav>
          </div>
        </div>

            

          </div>

          <!-- END main-content -->

          <?php include_once("inc/sidebar.php");?>
          <!-- END sidebar -->

        </div>
      </div>
    </section>
  
     <?php include_once("inc/footer.php");?>