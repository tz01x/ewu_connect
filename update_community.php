<?php 
require("helper.php");
session_start();
LoginCheck();
$community_tag_name="";
$community_name="";
$communiy_id="";

if(isset($_GET['c'])){
  $community_tag_name=$_GET['c'];
  }else{
    // redirect(getHost());
  }
  $community_objs=fetch_data("select * from community where tag_name='$community_tag_name' and user_id=".$_SESSION['uid']);
  //if there is no community 
  if(count($community_objs)==0){
   // redirect(getHost());
    redirect_with_interval('you are not permited to update community info',getHost());
  }


?>

<?php

if(isset($_POST['update_community'])){
    $community_name=$_POST['community_name'];
    //lowercase every char and remove white space in between  
    $community_tag_name=join("",preg_split("/ /",strtolower($community_name)));
    

      $res=fetch_data("select id,user_id from community where tag_name='$community_tag_name'");
      
      if(count($res)==1){
        // 
       if($res[0]['user_id']!=$community_objs[0]['user_id']){
        redirect_with_interval('This Name is Alreday Exits! ',getHost().'./update_community.php?c='.$community_tag_name);
        return;
       }
      }
     
  
  
    $about=$_POST['about'];
    $public=$_POST['public'];
    $cover_photo_url=$community_objs[0]['cover_photo_url'];
    $avater_photo_url=$community_objs[0]['logo_url'];

    if(isset($_FILES['cover_photo'])){
      // echo 'cover pic find ';
      $cover_photo=$_FILES['cover_photo'];
      if($cover_photo['size']!=0){
        $target_file=$cover_photo['tmp_name'];
        $cover_photo_url='./media/'.$cover_photo['name'];
        move_uploaded_file($target_file,$cover_photo_url);
      }
      

    }
    if(isset($_FILES['avater_photo'])){
 
      $avater_photo=$_FILES['avater_photo'];
      if($avater_photo['size']!=0){
      $target_file=$avater_photo['tmp_name'];
      $avater_photo_url='./media/'.$avater_photo['name'];
      move_uploaded_file($target_file,$avater_photo_url);
      }


    }



    $res=insert_data("update  community  set community_name='$community_name',tag_name='$community_tag_name',about='$about',public='$public',user_id=".$_SESSION['uid'].",cover_photo_url='$cover_photo_url',logo_url='$avater_photo_url'
    where id=".$community_objs[0]['id']."
    ");

    if($res['status']){
        $cid=$res['id'];
        // make curret user admin to this group 
        // insert_data("insert into community_users (community_id,user_id,approveed) values('$cid',".$_SESSION['uid'].",1)");
        $get_host=getHost();
        redirect($get_host.'/community.php?c='.$community_tag_name);
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
      <input type="text" class="form-control" id="validationTooltip01" value="<?=$community_objs[0]['community_name']?>" name="community_name" placeholder="Enter Community Name"  required>
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
      <textarea name="about" id="validationTooltip01"  class="form-control" cols="10" rows="5" required><?=$community_objs[0]['about']?></textarea>
      <div class="valid-tooltip">
        Looks good!
      </div>
      <div class="invalid-tooltip">
          
      </div>
    </div>
    </div>

    <div class="input-group mt-3">
      <label class="input-group-text" for="inputGroupSelect01">Public group? </label>
      <select class="form-select" value="<?=$community_objs[0]['public']?>" name="public" id="inputGroupSelect01">
        <!-- <option selected>Choose...</option> -->
        <option value="1">yes</option>
        <option value="0">no</option>
      </select>
    </div>

    <div class="mb-3">
            <label for="formFileMultiple1" class="form-label">Cover photo</label>
            <input class="form-control" type="file" name="cover_photo" id="formFileMultiple1" accept="image/png, image/jpeg" >
            <small>upload a new image will overright the last image </small>
            <br>
            <img src="<?=getHost().$community_objs[0]['cover_photo_url']?>" alt="" style="height: 100px" srcset="">
            
    </div>
    <div class="mb-3">
            <label for="formFileMultiple" class="form-label">Avatar photo</label>
            <input class="form-control" type="file" name="avater_photo" id="formFileMultiple" accept="image/png, image/jpeg" >
            <small>upload a new image will overright the last image </small>
            <br>

            <img src="<?=getHost().$community_objs[0]['logo_url']?>" alt=""  style="height: 100px" srcset="">


            

    </div>
    <input type="submit" class="mt-3 btn btn-primary"name="update_community" value="Create">
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