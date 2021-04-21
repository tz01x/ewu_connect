<?php 

require("helper.php");
session_start();
$messageModal=['show'=>FALSE,'title'=>'...','body'=>'...'];
LoginCheck();
$community_name="";
$communiy_id="";
?>



<?php 

if(isset($_GET['community_name']) && isset($_GET['communiy_id'])){
$community_name=$_GET['community_name'];
$communiy_id=$_GET['communiy_id'];

}else{
  redirect(getHost());
}
$community_obj=fetch_data("select * from community where id=$communiy_id");
$user_access_to_this_community=False;
$res=fetch_data('SELECT user_id from community_users where community_id='.$communiy_id.' and user_id='.$_SESSION['uid']);
  if(count($res)!=0){
    $user_access_to_this_community=True;
  }
?>


<?php 
// join to comunity 

if(isset($_POST['join_to_community'])){

  if($user_access_to_this_community){
    return;
  }
  $res=insert_data("insert into community_users (community_id,user_id,approveed) values (".$community_obj[0]['id'].",".$_SESSION['uid'].",1)");
  if($res['status']){

    echo "<script> window.location.assign('');</script>  ";

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

  <title>Community</title>
</head>

<body>
  <?php require_once('component/nav.php'); ?>
  <div class="container">
    <div class="coverPic">
      <img class="cover" src="resources/banner.jpg" alt="">
    </div>
  </div>

  <div class="container">
    <div class="display-6"><?=$community_name?> 


    <?php 
    if(!$user_access_to_this_community){
    ?>
    <form method="post" action="">
    <button type="submit" class="btn btn-secondary" name="join_to_community">join</button>
    </form>
    <?php }?>


    </div>
    <div class="row">
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

    </div>
  </div>




  <div class="container">
    <!-- laft side for post-->
    <div class="row">
    <div class="col-md-8 ">
      <div class="card mb-3" style="">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="..." alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
                content. This content is a little bit longer.</p>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
          </div>
        </div>
      </div>


      post 2

      <div class="card mb-3">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="..." alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
                content. This content is a little bit longer.</p>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
          </div>
        </div>
      </div>

      post 3
      <div class="card mb-3" style="">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="..." alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
                content. This content is a little bit longer.</p>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--end col9-->



    <!--right side -->
    <div class="col-sm-4 ">
      

      <div class="card border-secondary mb-3" style="max-width: 18rem;">
        <div class="card-header">ABOUT</div>
        <div class="card-body text-secondary">
        <p>
          <?=$community_obj[0]['about']?>
          </p>
        </div>
      </div>


      <!--  -->

      <div class="card border-secondary mb-3" style="max-width: 18rem;">
        <div class="card-header">Header</div>
        <div class="card-body text-secondary">
          <h5 class="card-title">Related Group</h5>
          <p class="card-text">-joy <br>-tamzid <br>-habib</p>
        </div>
      </div>

    </div>

    <!--end col9-->
    </div>
    <!-- row end -->

  </div>

  <!--end container-->



  <!--pagging-->
  <div class="container d-flex justify-content-center">
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



  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
  </script>


</body>

</html>