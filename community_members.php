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
      width: 80px;
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
  


<div class="container">



<div >
<?php
$result=fetch_data("select username from user join community_users ON user.id= community_users.user_id where community_users.community_id='$communiy_id';");
echo " Commmunity Population List:  ";
for($i=0; $i<count( $result);$i++)
{
   ?>
   <div> <?=$result[$i]['username'];?> </div>

 <?php     
}
?>

</div>



</div>






  

</body>

</html>