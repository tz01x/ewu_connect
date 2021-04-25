<?php


    $server="localhost";
    $username="root";
    $password="";
    $database="ewu_connect";
    // if(getenv("DEBUG")==false){
    
    //     $server = "sql204.epizy.com";
    //     $username = "epiz_28465196";
    //     $password = "aESF0fAA7YosrJ";
    //     $database = "epiz_28465196_ewu_connect";
    //     $post='3306';
    // }
    



// Create connection
$conn = new mysqli($server, $username, $password, $database,"3306");
// $conn = new mysqli($server, $username, $password, $database);
// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>