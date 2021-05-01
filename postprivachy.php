<?php 
require_once("helper.php");
session_start();
LoginCheck();
$post_id="";
$public_sta=-1;
$mypost_info=[];
if(isset($_GET['p'])){
 $post_id=$_GET['p'];  
 $public_sta=$_GET['pb'] ;
}
$mypost_info=fetch_data("SELECT post.id as pid,post.title as post_title,text,link,post.user_id as post_uid,community_name,post.public as post_public, community.public as community_public from post join community on post.community_id=community.id where post.id=$post_id and post.user_id=".$_SESSION['uid']);
if(count($mypost_info)!=1 && $public_sta!=-1){
    $get_host=getHost();
    echo "<h1>you cant delete this post </h1>
    <script>
        setInterval(() => {
            window.location.assign('$get_host');
        }, 1000);
    </script>
    ";
    return ;
}

$res=insert_data('update post  set public='.$public_sta.' where id='.$mypost_info[0]['pid'].' and user_id='.$_SESSION['uid']);
if($res['status']){
    redirect(getHost().'/profile.php');
}else{

    redirect_with_interval('Someting is wrong! ',getHost().'/profile.php');
}

?>
