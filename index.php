<?php 
require("helper.php");

 $mydata=fetch_data("select * from user");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EWU-connect</title>
    <link rel="stylesheet" href="./asset/style.css">
</head>
<body>
    <div>
        this is a home page of Ewu connect 
    </div>

    <?php

//print_r($mydata);
foreach($mydata as $item) {
    echo $item['id'];
    echo $item['username'];
    echo $item['password'];


    // to know what's in $item
   // echo '<pre>'; var_dump($item);
}





    ?> 




    <div class="myapp"></div>
</body>
</html>