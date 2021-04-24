<?php 
require("helper.php");
session_start();
 $mydata=fetch_data("select * from user");

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

  <title>Ewu connect </title>
</head>

<style>
.d{
/* background: #95959e; */
height: 100vh;
}
.e{
  /* background: #968181; */

}
</style>

<body>

<!-- nav var  -->
<?php require_once('component/nav.php'); ?>
  


  <div class="container mt-3">
   <div class="row">
   <div class="col-md-8 d">
    <!-- create post section  -->
    <div class="card mb-3 mt-3">
    <div class="card-body" style="cursor: pointer;" onclick="goToCreatePostPage()"> 
    <div  style=
    "display: flex;
    align-items: baseline;
    justify-content: space-between;
    flex-direction: row; ">
    
      <h5 class="card-title">Create Post</h5>
      <div>
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
        <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
        <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
        </svg>
      </div> 
    </div>
    
    </div>
    </div>
    <!-- end create post section  -->
   <hr>
   <div>
   fatch all post
   </div>
   </div>
   <div class="col-sm-4 ">
    
    <div class="community_list card">
    <div class="card-header">Communitys</div>
      <ol class="list-group list-group-numbered">

      <?php 
          $data=fetch_data("select community_name,tag_name from community ");
          for($i=0;$i<count($data);$i++){
      ?>
        <li class="list-group-item d-flex justify-content-between align-items-start">
          <div class="ms-2 me-auto">
            <div class="fw-bold">
            <a href="./community.php?c=<?=$data[$i]['tag_name'];?>">
            <?=$data[$i]['community_name'];?>
            </a>
            </div>
          </div>
          <!-- <span class="badge bg-primary rounded-pill">14</span> -->
        </li>
        <?php
     } 
    ?>
  
      </ol>
    </div>

    <div>
    
    

    <div class="card mt-3">
    <a class="btn btn-outline-secondary" href="./create_community.php"> 🌐 Crate a new community </a>
    </div>
    </div>

   </div>
   </div>

  <div>



  <!-- Optional JavaScript; choose one of the two! -->

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
        
        function goToCreatePostPage(){
          window.location.assign("../ewu_connect/createpost.php");
        }
    </script>
</body>

</html>