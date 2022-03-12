
<?php

    include_once('inc/header.php');

    include_once('inc/sidebar.php');

    include_once('../classes/Contact.php');

    $contact = new Contact();


    if (isset($_GET['read'])) {

        $contactId= $_GET['read'];

        $status = $contact->read_contact($contactId);
    }

    if (isset($_GET['un-read'])) {
        
        $contactId = $_GET['un-read'];

        $status = $contact->un_read_contact($contactId);
    }

    if (isset($_GET['delete'])) {
        
        $contactId = $_GET['delete'];

        $status = $contact->delete_contact($contactId);
    }

    $getContact = $contact->all_contact();

    


?>
<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h2 class="mb-0">View All contact</h2>
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
                                                <th>Phone</th>
                                                <th>Message</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                            if ($getContact) {
                                                $serial = 0;
                                                while($contact = mysqli_fetch_assoc($getContact)){
                                                    $serial++;

                                            ?>
                                            <tr>
                                                <td><?php echo $serial;?></td>
                                                <td><?php echo $contact['name'];?></td>
                                                <td><?php echo $contact['email'];?></td>
                                                <td><?php echo $contact['phone'];?></td>
                                                <td><?php echo $contact['message'];?></td>
                                                <td><?php
                                                    if ($contact['status']==0) {
                                                        echo "Unread";
                                                    }
                                                    elseif($contact['status']==1){
                                                        echo "Read";
                                                    }
                                                ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($contact['status']==0) {
                                                       ?>
                                                       <a href="?read=<?php echo $contact['id'];?>" class="btn btn-primary btn-sm"><i class="fas fa-arrow-up"></i></a>
                                                       <?php
                                                    }
                                                    elseif($contact['status']==1){
                                                       ?>
                                                       <a href="?un-read=<?php echo $contact['id'];?>" class="btn btn-danger btn-sm"><i class="fas fa-arrow-down"></i></a>
                                                       <?php
                                                    }
                                                ?>
                                                   <a href="?delete=<?php echo $contact['id'];?>" onClick="return confirm('Are You Sure Want to delete this contact?')" class="btn btn-danger btn-sm">Delete</a></td>
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
