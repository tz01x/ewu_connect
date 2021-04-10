<?php 
require("helper.php");

if(isset($_POST['submit'])){


$username=$_POST['username'];
$password=$_POST['password'];
$sql='SELECT * FROM `user` WHERE username="'.$username.'"  ';
$data=fetch_data($sql);
// print_r($data);
if($data[0]['password']==$password){
    session_unset(); 
    session_start();
    // user can login 
    $_SESSION['uid']=$data[0]['id'];
    $_SESSION['username']=$data[0]['username'];
    echo "<script>window.location.assign('http://localhost/ewu_connect/profile.php');</script>  ";
    // go to index page 
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
    

    

        <div class="container">
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




    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->

 
  </body>
</html>