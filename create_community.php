<?php 
require("helper.php");
session_start();
LoginCheck();

?>

<?php

if(isset($_POST['create_community'])){
    $community_name=$_POST['community_name'];
    //lowercase every char and remove white space in between  
    $community_tag_name=join("",preg_split("/ /",strtolower($community_name)));
    

      $dose_exist=fetch_data("select id from community where tag_name='$community_tag_name'");
      
      if(count($dose_exist)!=0){
       
        redirect_with_interval('this community name alreaday exits !',getHost().'./create_community.php');
        return;

      }
     
  
  
    $about=$_POST['about'];
    $public=$_POST['public'];
    $cover_photo_url=getHost()."/asset/img/default_cover.jpg";
    $avater_photo_url=getHost()."/asset/img/defualt_logo.jpg";

    if(isset($_FILES['cover_photo'])){
      $cover_photo=$_FILES['cover_photo'];
      $target_file=$cover_photo['tmp_name'];
      $cover_photo_url='./media/'.$cover_photo['name'];
      move_uploaded_file($target_file,$cover_photo_url);

    }
    if(isset($_FILES['avater_photo'])){
      $avater_photo=$_FILES['avater_photo'];
      $target_file=$avater_photo['tmp_name'];
      $avater_photo_url='./media/'.$avater_photo['name'];
      move_uploaded_file($target_file,$avater_photo_url);


    }



    $res=insert_data("INSERT into community (community_name,tag_name,about,public,user_id,cover_photo_url,logo_url) 
    values('$community_name','$community_tag_name','$about','$public',".$_SESSION['uid'].",'$cover_photo_url',
    '$avater_photo_url' )");

    if($res['status']){
        $cid=$res['id'];
        // make curret user admin to this group 
        insert_data("insert into community_users (community_id,user_id,approveed) values('$cid',".$_SESSION['uid'].",1)");
        
        redirect('http://localhost/ewu_connect/community.php?c='.$community_tag_name);
    }else{
        
        echo 'something wrong !, '.$res['details'];
        

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
    
    <form  method="post" action="" class="needs-validation" enctype="multipart/form-data" novalidate>

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

    <div class="input-group mt-3">
      <label class="input-group-text" for="inputGroupSelect01">Public group? </label>
      <select class="form-select" name="public" id="inputGroupSelect01">
        <option selected>Choose...</option>
        <option value="1">yes</option>
        <option value="0">no</option>
      </select>
    </div>

    <div class="mb-3">
            <label for="formFileMultiple1" class="form-label">Cover photo</label>
            <input class="form-control" type="file" name="cover_photo" id="formFileMultiple1" accept="image/png, image/jpeg" >
    </div>
    <div class="mb-3">
            <label for="formFileMultiple" class="form-label">Avatar photo</label>
            <input class="form-control" type="file" name="avater_photo" id="formFileMultiple" accept="image/png, image/jpeg" >
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