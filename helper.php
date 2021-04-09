<?php 
require("conn/db.php");

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

//   $data=fetch_data("select * from mobile");
//   echo json_encode($data);
?>