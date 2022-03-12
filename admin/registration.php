<?php
  include_once '../classes/Register.php';

  $register = new Register();

  if ($_SERVER['REQUEST_METHOD']=='POST') {

    $addNewUser = $register->add_new_user($_POST);
  }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Registration Form</title>
  </head>
  <body>
    <div class="container py-5">
      <div class="row d-flex justify-content-center">
        <div class="col-md-6">
          <span>
            <?php
              if (isset($addNewUser)) {
            ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $addNewUser; ?>
                <button style="float:right;" type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php } ?>
          </span>
          <div class="card">
            <h5 class="card-header">Registration Form</h5>
            <div class="card-body">
              <form action="" method="post">
                  <div class="form-group">
                      <label for="inputEmail">Full Name</label>
                      <input type="text" name="name" class="form-control" id="inputEmail" placeholder="Email">
                  </div>
                  <div class="form-group">
                      <label for="inputEmail">Phone</label>
                      <input type="text" name="phone" class="form-control" id="inputEmail" placeholder="Email">
                  </div>
                  <div class="form-group">
                      <label for="inputEmail">Email</label>
                      <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email">
                  </div>
                  <div class="form-group">
                      <label for="inputPassword">Password</label>
                      <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
                  </div>
                  <div class="form-group">
                      <label for="inputPassword">Retype Password</label>
                      <input type="password" name="re_password" class="form-control" id="inputPassword" placeholder="Retype Password">
                  </div>
                  <br>
                  <div class="form-group">
                      <button type="submit" class="btn btn-success">Sign Up</button>
                      <a href="login.php" class="btn btn-primary">Login</a>
                  <a style="text-decoration: none; margin-top:10px ;" href="#" class="float-end">Forget Your Password</a>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>
