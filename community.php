<?php 

require("helper.php");
session_start();
$messageModal=['show'=>FALSE,'title'=>'...','body'=>'...'];
// LoginCheck();
$community_tag_name="";
$community_name="";
$communiy_id="";
?>



<?php 

if(isset($_GET['c'])){
$community_tag_name=$_GET['c'];
}else{
  // redirect(getHost());
}
$community_obj=fetch_data("select * from community where tag_name='$community_tag_name'");
//if there is no community 
if(count($community_obj)==0){
  redirect(getHost());
}
$community_name=$community_obj[0]['community_name'];
$communiy_id=$community_obj[0]['id'];
$is_connected_user=False;
// check if the user login or not 
if(isset($_SESSION['uid'])){
  // if user allreaday joined to this community 
  $res=fetch_data('SELECT user_id from community_users where community_id='.$communiy_id.' and user_id='.$_SESSION['uid']);
  if(count($res)!=0){
    $is_connected_user=True;
    // echo 'colleted';
  }
}

?>


<?php 
// join to comunity 

if(isset($_POST['join_to_community'])){
  LoginCheck();
  if($is_connected_user){
    return;
  }
  $res=insert_data("insert into community_users (community_id,user_id,approveed_as_mod) values (".$community_obj[0]['id'].",".$_SESSION['uid'].",0)");
  if($res['status']){
    // echo 'you are joined';
    echo "<script> window.location.assign('');</script>  ";

  }

}

?>

<!-- Leave community -->
<?php
  if(isset($_POST['leave_community'])){
    LoginCheck();
    if(!$is_connected_user){
      return;
    }
    $res= insert_data(" DELETE FROM community_users WHERE user_id=".$_SESSION['uid']." AND community_id=".$community_obj[0]['id']."");
    
    if($res['status']){
  
      echo "<script> window.location.assign('');</script> ";
  
    }else{
     
    }
  
  }

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="./asset/community.css">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

  <title><?=$community_name?></title>
  <style>
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

    .post-img {

      margin-top: 21px;
    }

    .community-title {
      display: flex;
      flex-wrap: nowrap;
      align-items: center;
      position: relative;
      top: -27px;
      left: 12px;

    }

    .community-title form {
      margin: 10px;
    }

    .logo-pic {
      /* width: 80px; */
      height: 80px;
      border-radius: 51px;
      margin-right: 19px;
    }

    .community-name {
      font-weight: 400;
      text-shadow: -1px 1px 1px black;
    }
  </style>
</head>

<body>
  <?php require_once('component/nav.php'); ?>
  <div class="container">
    <div class="coverPic">
      <img class="cover" style="object-fit: cover;" src="<?=$community_obj[0]['cover_photo_url']?>" alt="">
    </div>
  </div>

  <div class="container">
    <div class=" community-title">

      <img src="<?=$community_obj[0]['logo_url']?>" class="logo-pic" style="" alt="">

      <div class="display-6 community-name"><?=$community_name?> </div>

      <!-- Join community -->
      <?php 
      if($community_obj[0]['user_id']!=$_SESSION['uid']){
          if(!$is_connected_user){
          ?>
          <form method="post" action="">
            <button type="submit" class="btn btn-outline-secondary" name="join_to_community">join</button>
          </form>
          <?php }?>

          <!-- Leave Community -->

          <?php 
          if($is_connected_user){
            ?>
          <form method="post" action="">
            <button type="submit" class="btn btn-outline-secondary" name="leave_community">Leave</button>
          </form>
    
          <?php 
            }
        }else{

        ?>
        <a href="<?php echo getHost().'./update_community.php?c='.$community_tag_name; ?>">edit</a>
        <?php 
        
        }
      ?>


    </div>

    <!-- <div class="row">
      <div class="col-9">
        <nav class="nav">
          <a class="nav-link active" aria-current="page" href="#">New</a>
          <a class="nav-link" href="#">Top</a>
          <a class="nav-link" href="#">Sort</a>

        </nav>
      </div>
      <div class="col-3">
        ....
      </div>

    </div> -->
  </div>




  <div class="container">
    <!-- laft side for post-->


    <div class="row">
      <div class="col-md-8 ">

        <!-- create post section  -->
        <div class="card mb-3">
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

            <?php
            $getpost=fetch_data("select post.id as pid,title,text,date,user.id as uid,username  from post,user where community_id=$communiy_id and post.user_id=user.id and post.public=1");
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
                  <small>Posted by <a href=""><?=$getpost[$i]['username']?></a></small>
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

      <!--end col9-->



      <!--right side -->
      <!--About session -->

      
     
      <div class="col-sm-4 ">


        <div class="card border-secondary mb-3" style="max-width: 18rem;">
          <div class="card-header">ABOUT</div>
          <div class="card-body text-secondary">
            <p>
              <?=$community_obj[0]['about']?>
            </p>
            <form method="get" action="http://localhost/ewu_connect/community_members.php">
            
            <input type="text" hidden value="<?=$community_obj[0]['tag_name']?>" name="c">
          <button type="submit" class="btn btn-primary" name="member" >Members
          [<span class="badge bg-primary rounded-pill"><?php 
              $result=fetch_data("select count(user_id) as total_mem FROM community_users where community_id='$communiy_id';");
              echo($result[0]['total_mem']);
              ?></span>]</button>
        </form>
            <hr>
            <small>🍰 Created : <?=$community_obj[0]['created']?></small>
            <br>
            <small>
              Total Members: 
              <?php 
              $result=fetch_data("select count(user_id) as total_mem FROM community_users where community_id='$communiy_id';");
              echo($result[0]['total_mem']);
              ?>
            </small>

          </div>
        </div>


        <!--  -->

        <div class="card border-secondary mb-3" style="max-width: 18rem;">
          <div class="card-header">Rules</div>
          <div class="card-body text-secondary">

            <!-- rules gouse here  -->

          </div>
        </div>

      </div>

      <!--end col9-->
    </div>
    <!-- row end -->

  </div>

  <!--end container-->



  <!--pagging-->
  <!-- <div class="container d-flex justify-content-center">
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Next</a></li>
      </ul>
    </nav>
  </div>
 -->


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
  </script>

  <script>
    function goToCreatePostPage() {

      window.location.assign("<?php echo getHost();?>/createpost.php?c=<?=$community_tag_name?>");
    }
  </script>

</body>

</html>