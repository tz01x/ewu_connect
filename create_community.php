<?php 
require("helper.php");
session_start();
LoginCheck();

?>

<?php

if(isset($_POST['create_community'])){
    $community_name=$_POST['community_name'];
    $about=$_POST['about'];

    $res=insert_data("INSERT into community (community_name,about,user_id,cover_photo_url,logo_url) values('$community_name','$about',".$_SESSION['uid'].",'./asset/img/default_cover.jpg','./asset/img/defualt_logo.jpg' )");

    if($res['status']){

        // echo "good";
        redirect('http://localhost/ewu_connect/create_community.php');
    }else{
        // echo "bad";
        

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Comunity Create </title>
  </head>
  <body>
    

  <!-- nav var  -->
  <?php require_once('component/nav.php'); ?>
  

    <div class="container ">

    <div class="display-2">Create new community</div>

    <div class="jumbotron row ">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
    
    <form  method="post" action="" class="needs-validation" novalidate>

    <div class="form-row">
    <div class="">
      <label for="validationTooltip01">Community Name</label>
      <input type="text" class="form-control" id="validationTooltip01" name="community_name" placeholder="Enter Community Name"  required>
      <div class="valid-tooltip">
        Looks good!
      </div>
      <div class="invalid-tooltip">
          Please choose a unique and valid Community name.
        </div>
    </div>
    </div>
    <div class="form-row">
    <div class="">
      <label for="validationTooltip01">About</label>
      <!-- <input type="text"  class="form-control" id="validationTooltip01"  name="about" placeholder="About"  required> -->
      <textarea name="about" id="validationTooltip01"  class="form-control" cols="10" rows="5" required></textarea>
      <div class="valid-tooltip">
        Looks good!
      </div>
      <div class="invalid-tooltip">
          
        </div>
    </div>
    </div>

    <input type="submit" class="mt-3 btn btn-primary"name="create_community" value="Create">
   
    </form>

    
    </div>
    <div class="col-sm-4"></div>
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