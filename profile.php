<?php 
session_start();

if (isset($_SESSION['uid'])) {
    // continue 
}else{

    // /redirect to login page 

    header("Location: http://localhost/ewu_connect/login.php");
    die();

}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Ewu connect-User profile</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">EWU Connect</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="http://localhost/ewu_connect/login.php">Login Page</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="http://localhost/ewu_connect/signup.php">Sign Up Page</a>
        </li>
        
        <?php
         
        //session_start();
            if(isset($_SESSION['uid'])){
              echo'<li class="nav-item">
              <a class="nav-link active" aria-current="page" href="http://localhost/ewu_connect/profile.php">Profile Page</a>
          
            </li>';
            }


        ?>

<li class="nav-item">
          <a class="nav-link active" aria-current="page" href="http://localhost/ewu_connect/logout.php">Logout</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>
</div>


  


<div class="container">
<h1>welcome <?php echo $_SESSION['username']?></h1>

</div>

<div class="mt-5"></div>
<div class="mt-5"></div>

<div class="container">
<h2>Edit Profile</h2>
<form class="row g-3">
  <div class="col-md-6">
    <label for="inputUNAme4" class="form-label">User Name</label>
    <input type="text" class="form-control" id="inputUName4">
  </div>
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Alternate Email</label>
    <input type="email" class="form-control" id="inputEmail4">
  </div>
  <div class="col-12">
    <label for="inputFName" class="form-label">Full Name</label>
    <input type="text" class="form-control" id="inputFName">
  </div>
 
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
</div>



<div class="container mt-5">
<h2>Password Change</h2>
<form class="row g-3">
  <div class="col-md-6">
    <label for="inputOPass4" class="form-label">Old Password</label>
    <input type="password" class="form-control" id="inputOPass4">
  </div>
  <div class="col-md-6">
    <label for="inputNPass4" class="form-label">New Password</label>
    <input type="password" class="form-control" id="inputNPassl4">
  </div>
  <div class="col-12">
    <label for="inputCPass4" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="inputCPass4">
  </div>
 
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
</div>














    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>