<!-- END main-content -->

<div class="col-md-12 col-lg-4 sidebar">
  <div class="sidebar-box">
    <h3 class="heading">Categories</h3>
    <ul class="categories">
      <?php
      if ($category_Data) {

          while($category = mysqli_fetch_assoc($category_Data)){

              ?>
              <li><a href="category.php?category-id=<?php echo $category['cat_name'];?>"><?php echo $category['cat_name'];?></a></li>
              
              <?php

                  }
                  
                }
              ?>
    </ul>
  </div>
  <!-- END sidebar-box -->
</div>
<!-- END sidebar -->