<?php 
require("conn/db.php");

function insert_data($sql){
  $res=$GLOBALS['conn']->query($sql);
  if($res==TRUE){
    return ['status'=>True,'id'=>$GLOBALS['conn']->insert_id];
  }else{
    return ['status'=>False,'details'=>$GLOBALS['conn']->error];
  }

}
function fetch_data($sql) {
    $result = $GLOBALS['conn']->query($sql);
    if ($result->num_rows > 0) {
        $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
        return $data;
        
    }else{
      echo $GLOBALS['conn']->error;
      return  array( );
    }
  }

   function generateToken($uid,$username){
    //
    //time to live or expire date 
    $ttl=time()+604800 ;// current time + 1 week in second 
    $data=$uid.".".$username.".".$ttl;
    $token= bin2hex($data);

    return $token;

  }

  function verifyToken($token){
    $ptext=hex2bin($token);
    //id.username.ttl
    $data= (preg_split('/[.]/',$ptext));
    $len = count($data);
    
    if(($len<3)){
      return ['status'=>FALSE,'details'=>'invalid token!'];
    }
    $exp_time_in_second=$data[$len-1];
    if(intval($exp_time_in_second)<(time())){
      // echo(' expire !' . "<br>");
      return ['status'=>FALSE,'details'=>"Token has expaired",'expired_time'=>$exp_time_in_second];

    }else{
      // echo( "<br>".'not expire !' . "<br>");
      return ['status'=>TRUE,'uid'=>$data[0],'username'=>$data[1]];

    }

  }


  function getHost(){
    return $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME']."/ewu_connect";
  }


  function LoginCheck(){
    // if the session uid not set then go to login page 
    $get_host=getHost();
    if (!isset($_SESSION['uid'])) {
      
      header("Location: $get_host/ewu_connect/login.php");
  }
  }

  function redirect($url){
    header("Location: $url");
  }

  function redirect_with_interval($msg,$url){
  
        echo "<h1>$msg</h1>
        <script>
            setInterval(() => {
                window.location.assign('$url');
            }, 1000);
        </script>
        ";
  }



//   $data=fetch_data("select * from mobile");
//   echo json_encode($data);
?>