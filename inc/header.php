<?php
  include_once'classes/Logo.php';
  include_once'classes/Social.php';
  include_once'classes/Category.php';


    $category = new Category();
    $logo = new Logo();
    $social = new Social();

    $logoData = $logo->logo_data();
    
    $logoData = mysqli_fetch_array($logoData);

    $socialData = $social->social_data();

    $socialData = mysqli_fetch_array($socialData);

    $category_Data = $category->all_active_category();

?>

<!doctype html>
<html lang="en">
<head>
<title>Colorlib Wordify &mdash; Minimal Blog Template</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300, 400,700|Inconsolata:400,700" rel="stylesheet">

<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/owl.carousel.min.css">

<link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
<link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
<link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

<!-- Theme Style -->
<link rel="stylesheet" href="css/style.css">
</head>
<body>


<div class="wrap">

<header role="banner">
  <div class="top-bar">
    <div class="container">
      <div class="row">
        <div class="col-9 social">
          <a href="<?php echo $socialData['twitter'];?>"><span class="fa fa-twitter"></span></a>
          <a href="<?php echo $socialData['facebook'];?>"><span class="fa fa-facebook"></span></a>
          <a href="<?php echo $socialData['instagram'];?>"><span class="fa fa-instagram"></span></a>
          <a href="<?php echo $socialData['youtube'];?>"><span class="fa fa-youtube-play"></span></a>
        </div>
        <div class="col-3 search-top">
          <!-- <a href="#"><span class="fa fa-search"></span></a> -->
          <form action="search-post.php" method="post" class="search-top-form">
            <span class="icon fa fa-search"></span>
            <input type="text" name="value" id="s" placeholder="Type keyword to search...">
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="container logo-wrap">
    <div class="row pt-5">
      <div class="col-12 text-center">
        <a class="absolute-toggle d-block d-md-none" data-toggle="collapse" href="#navbarMenu" role="button" aria-expanded="false" aria-controls="navbarMenu"><span class="burger-lines"></span></a>
        <h1 class="site-logo"><a href="index.php">
          <img style="width: 100px; height: 40px" src="admin/uploads/<?php echo $logoData['logo'];?>">
        </a></h1>
      </div>
    </div>
  </div>
  
  <nav class="navbar navbar-expand-md  navbar-light bg-light">
    <div class="container">
      
     
      <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link active" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Business</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="category.php" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Travel</a>
            <div class="dropdown-menu" aria-labelledby="dropdown04">
              <a class="dropdown-item" href="category.php">Asia</a>
              <a class="dropdown-item" href="category.php">Europe</a>
              <a class="dropdown-item" href="category.php">Dubai</a>
              <a class="dropdown-item" href="category.php">Africa</a>
              <a class="dropdown-item" href="category.php">South America</a>
            </div>

          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="category.php" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
            <div class="dropdown-menu" aria-labelledby="dropdown05">
              <?php
                $getCategories = $category->all_active_category();

                if ($getCategories) {

                  while($categoryData = mysqli_fetch_assoc($getCategories)){

              ?>
                  <a class="dropdown-item" href="category.php?category-id=<?php echo $categoryData['cat_id'];?>"><?php echo $categoryData['cat_name'];?></a>
              <?php

                  }
                  
                }
              ?>
            </div>

          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
        </ul>
        
      </div>
    </div>
  </nav>
</header>
<!-- END header -->