<?php 
require("helper.php");
require('mailer.php');
session_start();
$messageModal=['show'=>FALSE,'title'=>'...','body'=>'...'];



if(isset($_POST['submit'])){

  $email=$_POST['email'];
  $password=$_POST['password'];
  $username="";

  $result=find_match($email);//search for specfice patten 

  if($result[0]){
  $username=$result[1];

  

    $sql="INSERT INTO `user`( `username`, `password`, `email`,is_active) VALUES ('$username','$password','$email',0)";
    $res=$GLOBALS['conn']->query($sql);
    if ($res === TRUE) {
     
      $token=generateToken($GLOBALS['conn']->insert_id,$username); // generate token 
      $get_host=getHost()."/vfuser.php/?token=$token";
      // send_mail($email,'Welcome to EWU-Connect, you are one setp way to connect with us!','
      // <p>
      // dear '.$username.',
      // Open the urls to verify your account <a href="'.$get_host.'">'.$get_host.'</a>

      
      // </p>
      // ');
      
      $messageModal['show']=TRUE;
      $messageModal['title']='Account been created !';
      $messageModal['body']="We have send a varify mail to your email address, Please check in order to active your account!";
  

      // echo "<script>window.location.assign('');;</script>  ";

    
      
    } else {
      $messageModal['show']=TRUE;
      $messageModal['title']='invalid information !';
      $messageModal['body']="Your email isn't unique,";
  
      //echo "Error: " . $sql . "<br>" . $GLOBALS['conn']->error;
  }
  }else{
    //show some-kind of error 
    $messageModal['show']=TRUE;
    $messageModal['title']='Invalid Email';
    $messageModal['body']="the email address,your are using to signup, Isn't match with EWU domain email address ";

  }


}

  function find_match( $email )
 {

  /** check for specfic patten on the email and determein the username  */
  //  return  a  array that contain patten finding resualt {true or false } and username
  //  echo $email;

   $pattern = "/(@std.ewubd.edu)|(@ewubd.edu)/";
   if(preg_match($pattern, $email)){
     //2018-1-60-665@std.ewubd.edu
    $username="";
    for ($i=0; $i < strlen($email); $i++) { 
      if($email[$i]=='@'){
        break;
      }
      // string concatenation 

      $username=$username.$email[$i];
    

    }
    return array(TRUE,$username);
    
  }
  return array(FALSE,'');
  
 }

?>



<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

  <title>ewu connect sign up page </title>
</head>

<body>
  <!-- nav var  -->
  <?php require_once('component/nav.php'); ?>
  
  </div>



  <div class="container">
    <h1 class="text-center">signup page </h1>

    <div class="row">
      <div class="col-sm"></div>
      <div class="col-md">
        <form method="post" action="">
          <!-- <div class="form-floating mb-3">
            <input type="text" class="form-control" name="username" id="username" placeholder="Username">
            <label for="floatingInput"> Username </label>
            </div> -->
          <div class="form mb-3">
            <label for="email">Email address</label>
            <input type="email" class="form-control" name="email" id="email"
              placeholder="name@std.ewubd.edu/name@ewubd.edu">
          </div>
          <div class="form-">
            <label for="floatingPassword">Password</label>
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
          </div>
          <br>

          <button type="submit" name="submit" class="btn btn-primary btn-lg">SignUp !</button>
        </form>
      </div>

      <div class="col-sm"></div>


    </div>



  </div>



  <!-- Modal -->
  <div class="modal fade" id="myModal55" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><?=$messageModal['title']?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p><?=$messageModal['body']?></p>
        </div>

      </div>
    </div>
  </div>



  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
  </script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->

  <script>
    var myModal = new bootstrap.Modal(document.getElementById('myModal55'), {});

    <?php
    if ($messageModal['show']) {
      echo 'myModal.toggle();';

    }?>
  </script>




</body>

</html>