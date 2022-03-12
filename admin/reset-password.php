<?php
  include_once '../classes/Register.php';

  $resetPassowrd = new Register();

  if (isset($_GET['token'])) {
    
    $_SESSION['token'] = $_GET['token'];
  }
  else{
    header('location:login.php');
  }

  if ($_SERVER['REQUEST_METHOD']=='POST') {

    $pass1 = $_POST['newpass1'];

    $pass2 = $_POST['newpass2'];

    $token = $_SESSION['token'];

    if (isset($pass1) && isset($pass2) && isset($token)) {
      
      $resetPass = $resetPassowrd->reset_pass($pass1,$pass2,$token);

      unset($_SESSION['token']);
    }
    else{
      $errorMassage = "Input Field Must Not Be Empty";
      return $errorMassage;
    }

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

    <title>Reset passwrord</title>
  </head>
  <body>
    <div class="container py-5">
      <div class="row d-flex justify-content-center">
        <div class="col-md-6">
          <div class="card">
            <h5 class="card-header">Reset passwrord Form</h5>
            <?php
              if (isset($resetPass)) {
                echo '<h5 class="card-header">'.$resetPass.'</h5>';
              }
            ?>
            <div class="card-body">
              <form action="" method="post">
                  <div class="form-group">
                      <label for="inputEmail">New Password</label>
                      <input type="password" name="newpass1" class="form-control" id="inputEmail" placeholder="Email">
                  </div>
                  <div class="form-group">
                      <label for="inputEmail">Confirm New Password</label>
                      <input type="password" name="newpass2" class="form-control" id="inputEmail" placeholder="Email">
                  </div>
                  <br>
                  <button type="submit" class="btn btn-success">Resend Email</button>
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