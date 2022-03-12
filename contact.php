
<?php
  include_once('inc/header.php');


  include_once'classes/Contact.php';

  $contact = new Contact();

  if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=='POST' ) {
    

    $addNewContact = $contact->add_contact($_POST);
  }
?>


    <section class="site-section">
      <div class="container">
        <div class="row mb-4">
          <div class="col-md-6">
            <h1>Contact Me</h1>
          </div>
        </div>
        <div class="row blog-entries">
          <div class="col-md-12 col-lg-8 main-content">
            <?php
                if (isset($addNewContact)) {
                    echo '<h2 class="mb-0">'.$addNewContact.'</h2>';
                }
            ?>
            
            <form action="" method="post">
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="name">Name</label>
                      <input type="text" name="name" class="form-control ">
                    </div>
                    <div class="col-md-12 form-group">
                      <label for="phone">Phone</label>
                      <input type="text" name="phone" class="form-control ">
                    </div>
                    <div class="col-md-12 form-group">
                      <label for="email">Email</label>
                      <input type="email" name="email" class="form-control ">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <label for="message">Write Message</label>
                      <textarea name="message" name="message" class="form-control " cols="30" rows="8"></textarea>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <input type="submit" value="Send Message" class="btn btn-primary">
                    </div>
                  </div>
                </form>
            

          </div>

          <!-- END main-content -->

          <?php include_once("inc/snameebar.php");?>
          <!-- END snameebar -->

        </div>
      </div>
    </section>
  
     <?php include_once("inc/footer.php");?>