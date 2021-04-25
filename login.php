<?php 
require("helper.php");
session_start();
if(isset($_POST['submit'])){


$username=$_POST['username'];
$password=$_POST['password'];
$sql='SELECT * FROM `user` WHERE username="'.$username.'" and is_active=1 ';
$data=fetch_data($sql);
// print_r($data);
if(count($data)==1){
if($data[0]['password']==$password){
    session_unset(); 
    session_start();
    // user can login 
    $_SESSION['uid']=$data[0]['id'];
    $_SESSION['username']=$data[0]['username'];
    $get_host=getHost();
    echo "<script>window.location.assign('$get_host/profile.php');</script>  ";
    // go to index page 
}else {
  echo "<script>alert('password dont match')</script>  ";
}
}else {
  echo "<script>alert('this account isn't active ')</script>  ";
}
}


// $res=$GLOBALS['conn']->query($sql);
// if ($res === TRUE) {
//     echo "<script>alert('account created'); window.location.assign('');;</script>  ";
//   } else {
//     echo "Error: " . $sql . "<br>" . $conn->error;
// }
// }

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>ewu connect sign up page </title>
  </head>
  <body>
    

  <!-- nav var  -->
  <?php require_once('component/nav.php'); ?>
  



    

        <div class="container ">
      


        <div class="row">
      <div class="col-sm"></div>
      <div class="col-md">
      <h1>Login page </h1>
            <form method="post" action="">
            <div class="form-floating mb-3">
            <input type="text" class="form-control" name="username" id="username" placeholder="Username">
            <label for="floatingInput"> Username </label>
            </div>
           
            <div class="form-floating">
            <input type="password" name="password"class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
            </div>
            <br>

            <button type="submit" name="submit" class="btn btn-primary btn-lg">login </button>
            </form>
            </div>

      <div class="col-sm"></div>


    </div>


        </div>




    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->

 
  </body>
</html>