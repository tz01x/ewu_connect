<?php 
require("helper.php");
session_start();
if(isset($_GET['token'])){
    $token=$_GET['token'];
    $velidity=verifyToken($token);

    if(!$velidity['status']){

        echo '<h1>'.$velidity['details'].'</h1>';
        return;

    }
    print_r($velidity);
    $sql='update user set is_active=1 where id='.$velidity['uid'];
    $res=$GLOBALS['conn']->query($sql);
    if($res===TRUE){

        if($GLOBALS['conn'] -> affected_rows==0){
            echo "account activation unsuccessful." ;
        }
        $_SESSION['uid']=$velidity['uid'];
        $_SESSION['username']=$velidity['username'];

        header("Location:".getHost().'/profile.php');

    }else{

        echo "Error: " . $sql . "<br>" . $GLOBALS['conn']->error;
    }

}
?>