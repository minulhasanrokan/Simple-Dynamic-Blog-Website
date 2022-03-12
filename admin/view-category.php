
<?php

    include_once('inc/header.php');

    include_once('inc/sidebar.php');

    include_once('../classes/category.php');

    $allCat = new Category();

    $allCategory = $allCat->all_category();

    if (isset($_GET['delete'])) {

        $catId= $_GET['delete'];

        $deletecategory = $allCat->delete_category($catId);
        // code...
    }


?>
<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h2 class="mb-0">View Category</h2>
                </div>
            </div>
        </div>
        <!-- end page title -->

  		  <div class="row">
             <?php
                            if (isset($deletecategory)) {
                                echo '<h2 class="mb-0">'.$deletecategory.'</h2>';
                            }
                        ?>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Serial</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            <?php
                                            if ($allCategory) {
                                            	$serial = 0;
                                            	while($category = mysqli_fetch_assoc($allCategory)){
                                            		$serial++;


                                            ?>
											<tr>
                                                <td><?php echo $serial;?></td>
                                                <td><img width="30px" src="uploads/<?php echo $category['cat_img'];?>"></td>
                                                <td><?php echo $category['cat_name'];?></td>
                                                <td><?php echo $category['cat_status'];?></td>
                                                <td><a href="category-adit.php?edit-id=<?php echo $category['cat_id'];?>" class="btn btn-primary btn-sm">Edit</a><a href="?delete=<?php echo $category['cat_id'];?>" onClick="return confirm('Are You Sure Want to delete this Category??')" class="btn btn-danger btn-sm">Delete</a><a href="<?php echo $category['cat_id'];?>" class="btn btn-success btn-sm">View</a></td>
                                            </tr>
                                            <?php
                                        		}
                                            }
                                            else{
                                            	echo $allCategory;
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
