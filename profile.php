

  
<?php 

require("helper.php");
session_start();
$messageModal=['show'=>FALSE,'title'=>'...','body'=>'...'];
LoginCheck();
?>

<?php
  $user_data= fetch_data("select username,full_name,alternate_email,email from user where id=".$_SESSION['uid']);

  if(isset($_POST['update'])){
    $newName=$_POST['newName'];
    $newAltMail=$_POST['newAltMail'];
    $newFullName=$_POST['newFullName'];

    $sql="update user set username='$newName',full_name='$newFullName',alternate_email='$newAltMail' where id=".$_SESSION['uid'];
       $res=$GLOBALS['conn']->query($sql); 

       if($res===TRUE)
       {
        $get_host=getHost();
        header("Location: $get_host/profile.php");

        // $messageModal['show']=TRUE;
        // $messageModal['title']='INFO Updated';
        // $messageModal['body']="Information Successfully Updated";
        
       }
      else{
        $messageModal['show']=TRUE;
        $messageModal['title']='Failed to change';
        $messageModal['body']="Something went wrong. Please try again!";
      }

      


  }
?>




<?php



if(isset($_POST['Password_Change'])){


$Old_Password=$_POST['Old_Password'];

$New_Password=$_POST['New_Password'];

$Confirm_Password=$_POST['Confirm_Password'];

$result= fetch_data("Select password from user where id=".$_SESSION['uid']);

if($result[0]["password"]==$Old_Password)
   {
       if( $New_Password== $Confirm_Password )
       {
       $sql="update user set password='$Confirm_Password' where id=".$_SESSION['uid'];
       $res=$GLOBALS['conn']->query($sql); 
       if($res===TRUE)
       {



        $messageModal['show']=TRUE;
        $messageModal['title']='Password Changed Succesfully!';
        $messageModal['body']="We have updated your password. Please use the new password from now on!";
       }
      else{
        $messageModal['show']=TRUE;
        $messageModal['title']='Failed to change Password!';
        $messageModal['body']="Something went wrong. Please try again!";
      }


   }
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

    <title>Ewu connect-User profile</title>
  </head>
  <body>
 
 <!-- nav var  -->
 <?php require_once('component/nav.php'); ?>


  


<div class="container">
<h1>welcome <?php echo $_SESSION['username']?></h1>

</div>



<div class="container mt-5 ">
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" id="nav-timeline" aria-current="page" href="#"  onclick="showThisTab('timeline')"  >My time line</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="nav-aboutme" href="#" onclick="showThisTab('aboutme')" >About me </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="nav-edit-profile" href="#" onclick="showThisTab('edit-profile')" >Edit my info </a>
    </li>
    <!-- <li class="nav-item">
      <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
    </li> -->
  </ul>
</div>

  <div id="timeline" style="display:block">
    <div class="container">
      <?php 
          $sql="select post.id as pid ,title,date,community_name,tag_name,post.public as post_public from post  join community on post.community_id=community.id where  post.user_id=".$_SESSION['uid']."";
          $res=fetch_data($sql);

          for ($i=0; $i < count($res); $i++) { 
            ?>
            <!-- html block start  -->

            <div class="card mt-3">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-8">
                    <h4><?=$res[$i]['title']?></h4>
                    <small>Last modify:  <?=$res[$i]['date']?></small>
                  </div>
                  <div class="col-sm-4">
                    <?php 
                    if($res[$i]['post_public']){
                        echo '<div ><span class="badge rounded-pill bg-success m-2">public</span>';
                        echo '<a href="'.getHost().'/postprivachy.php/?p='.$res[$i]['pid'].'&&pb=0'.'"><span class="badge bg-secondary">make private</span></a></div>';
                    }else{

                      echo '<div > <span class="badge rounded-pill bg-warning m-2">private</span>';
                      echo '<a href="'.getHost().'/postprivachy.php/?p='.$res[$i]['pid'].'&&pb=1'.'"><span class="badge bg-secondary">make Public</span></a></div>';

                    }
                    ?>
                    <a href="<?php echo getHost().'/updatepost.php/?p='.$res[$i]['pid'];?>">
                      <span class="badge rounded-pill bg-info m-2">edit</span>
                    </a>

                    <a href="<?php echo getHost().'/deletepost.php/?p='.$res[$i]['pid'];?>">
                      <span class="badge rounded-pill bg-danger m-2">delete</span>
                    </a>
                  
                  </div>
                  

                </div>
              </div>
            
            </div>
            
            <!-- end -->

            <?php 

          }
      ?>
    </div>
  </div>
  <div id="aboutme" style="display:none">
      <div class="container">
         

          <dl class="row">
            <dt class="col-sm-3">Username</dt>
            <dd class="col-sm-9"><?=$user_data[0]['username']?></dd>

            <dt class="col-sm-3">Full name</dt>
            <dd class="col-sm-9"><?=$user_data[0]['full_name']?></dd>

            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9">
              <p><?=$user_data[0]['email']?></p>
      
            </dd>


            <dt class="col-sm-3">Alternet Email</dt>
            <dd class="col-sm-9"><?=$user_data[0]['alternate_email']?></dd>

            
        </dl>
      </div>
  </div>
  <div id="edit-profile"  style="display:none">
    <div class="container">
      <h2>Edit Profile</h2>
      <form method="post" action="" class="row g-3 ">
        <div class="col-md-6">

          <label for="inputUNAme4" class="form-label">User Name</label>
          <input type="text " value="<?=$user_data[0]['username']?>" class="form-control" id="inputUName4" name="newName">
        </div>
        <div class="col-md-6">
          <label for="inputEmail4" class="form-label">Alternate Email</label>
          <input type="email" value="<?=$user_data[0]['alternate_email']?>" class="form-control" id="inputEmail4" name="newAltMail">
        </div>
        <div class="col-12">
          <label for="inputFName" class="form-label">Full Name</label>
          <input type="text"value="<?=$user_data[0]['full_name']?>" class="form-control" id="inputFName" name="newFullName">
        </div>
      
        <div class="col-12">
          <button type="submit" class="btn btn-primary" name="update" >Submit</button>
        </div>
      </form>

      <div class=" mt-5">
        <h2>Password Change</h2>
        <form  method="post" action="" class="row g-3">
          <div class="col-md-6">
            <label for="inputOPass4" class="form-label">Old Password</label>
            <input type="password" class="form-control" id="inputOPass4" name="Old_Password">
          </div>
          <div class="col-md-6">
            <label for="inputNPass4" class="form-label">New Password</label>
            <input type="password" class="form-control" id="inputNPassl4" name="New_Password">
          </div>
          <div class="col-12">
            <label for="inputCPass4" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="inputCPass4" name="Confirm_Password">
          </div>

          <div class="col-12">
            <button type="submit" name="Password_Change" class="btn btn-primary">Change Password</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>





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





    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

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

    function showThisTab(ele_id_name) {
   
      document.getElementById(ele_id_name).style.display="block";
      document.getElementById('nav-'+ele_id_name).classList.toggle('active');
      const ids=['timeline','aboutme', 'edit-profile'];
      for (let index = 0; index < ids.length; index++) {
        const ele_ids = ids[index];
        if(ele_ids!=ele_id_name){
          document.getElementById('nav-'+ele_ids).classList.forEach(cls_name => {
            if(cls_name=='active'){
              document.getElementById('nav-'+ele_ids).classList.toggle('active');
            }
          });
          document.getElementById(ele_ids).style.display="none";
        }
        
      }
    }

  </script>

  </body>
</html>

