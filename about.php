
<?php
  include_once('inc/header.php');

  include_once('classes/About.php');

    $about = new About();

    $aboutData = $about->about_data();

    $aboutData = mysqli_fetch_array($aboutData);
?>
    <section class="site-section pt-5">
      <div class="container"> 
        
        <div class="row blog-entries">
          <div class="col-md-12 col-lg-8 main-content">
            
            <div class="row">
              <div class="col-md-12">
                <h2 class="mb-4"><?php echo $aboutData['title'];?></h2>
                <p class="mb-5"><img src="admin/uploads/<?php echo $aboutData['image'];?>" alt="Image placeholder" class="img-fluid"></p>
                <p><?php echo $aboutData['details'];?></p>
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