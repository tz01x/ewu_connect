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
  .d {
    /* background: #95959e; */
    min-height: 100vh;
  }

  .e {
    /* background: #968181; */

  }

  .vote_btns {
      display: flex;
      flex-direction: column;
      flex-wrap: nowrap;
      justify-content: space-evenly;
      align-content: center;
      align-items: center;
      cursor: pointer;

      border-left: 10px solid;
      border-right: 0.5px solid darkslategray;
    }

    .vote_btns.up {}

    .vote_btns.down {}
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
            <div style="display: flex;
                align-items: baseline;
                justify-content: space-between;
                flex-direction: row; ">

              <h5 class="card-title">Create Post</h5>
              <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-images"
                  viewBox="0 0 16 16">
                  <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z" />
                  <path
                    d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z" />
                </svg>
              </div>
            </div>

          </div>
        </div>
        <!-- end create post section  -->
        <hr>


        <?php
      $getpost=fetch_data("select post.id as pid,title,text,date,user.id as uid,username,community_name  from post,user,community where post.public = 1 and post.community_id=community.id and  post.user_id='".$_SESSION['uid']."'");
      for ($i=0; $i < count($getpost); $i++) { 
       
      
      ?>

        <div class="card mb-3" style="">
          <div class="row g-0">
            <div class="col-sm-1   vote_btns">

              <div class="up">up</div>
              <div class="down">down</div>

            </div>
            <div class="col-md-8  ">
              <div class="card-body">
                <div>
                  <small><a href=""><b><?=$getpost[$i]['community_name']?></b></a> Posted by <a href=""><?=$getpost[$i]['username']?></a></small>
                </div>
                <h5 class="card-title"><?=$getpost[$i]['title']?></h5>
                <p class="card-text"><?=$getpost[$i]['text']?></p>
                <p class="card-text"><small class="text-muted">Last updated <?=$getpost[$i]['date']?></small></p>
              </div>
            </div>
            <div class="col-md-2 ">
              <?php 
            $pid=$getpost[$i]['pid'];
            $files=fetch_data("select * from file where post_id=$pid");
            if(count($files)!=0){
             if(preg_match('/image/',$files[0]['file_type'])){
              //  image file type
              $img_url=$files[0]['url'];
              echo'<img src="'.$img_url.'" class="img-fluid post-img" alt="" srcset="">';

             }else{
               //application file type /pdf /dox 
               echo '
               <svg xmlns="http://www.w3.org/2000/svg" width="100" height="50" fill="currentColor" class="bi bi-file-earmark-binary mt-3       " viewBox="0 0 16 16">
                <path d="M7.05 11.885c0 1.415-.548 2.206-1.524 2.206C4.548 14.09 4 13.3 4 11.885c0-1.412.548-2.203 1.526-2.203.976 0 1.524.79 1.524 2.203zm-1.524-1.612c-.542 0-.832.563-.832 1.612 0 .088.003.173.006.252l1.559-1.143c-.126-.474-.375-.72-.733-.72zm-.732 2.508c.126.472.372.718.732.718.54 0 .83-.563.83-1.614 0-.085-.003-.17-.006-.25l-1.556 1.146zm6.061.624V14h-3v-.595h1.181V10.5h-.05l-1.136.747v-.688l1.19-.786h.69v3.633h1.125z"/>
                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
              </svg>
              <small>'.$files[0]['file_name'].'</small>
               
               ';
             }

            }

            
            
            ?>


            </div>
          </div>
        </div>
        <?php
       }
      ?>

    



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
      function goToCreatePostPage() {
        window.location.assign("../ewu_connect/createpost.php");
      }
    </script>
</body>

</html>