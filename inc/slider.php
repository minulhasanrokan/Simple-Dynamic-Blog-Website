<section class="site-section pt-5 pb-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <div class="owl-carousel owl-theme home-slider">
          <?php
            if ($sliderPost) {
              while($slider = mysqli_fetch_assoc($sliderPost)){

          ?>
          <div>
            <a href="blog-single.php?post-id=<?php echo $slider['post_id'];?>" class="a-block d-flex align-items-center height-lg" style="background-image: url('admin/uploads/<?php echo $slider['image_one'];?>'); ">
              <div class="text half-to-full">
                <span class="category mb-5"><?php echo $slider['cat_name'];?></span>
                <div class="post-meta">
                  
                  <span class="author mr-2"><?php echo $slider['post_title'];?> </span>&bullet;
                  <span class="mr-2"><?php echo $slider['create_time'];?> </span> &bullet;
                  
                </div>
                <p><?php echo $format->text_shorten($slider['des_one'], 15);?></p>
              </div>
            </a>
          </div>
        <?php
               }
            }
          ?>
        </div>
        
      </div>
    </div>
    
  </div>


</section>
<!-- END section -->