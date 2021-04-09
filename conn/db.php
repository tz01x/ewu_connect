<?php
require ("settings.php");
    if(!getenv("DEBUG")){
        $server="localhost";
        $username="root";
        $password="";
        $database="epiz_28006799_test_001";

    }else{
        $server = "192.168.0.172";
        $username = "epiz_28006799";
        $password = "h89wlcSXk0";
        $database = "epiz_28006799_test_001";
    }
    



// Create connection
$conn = new mysqli($server, $username, $password, $database,"3306");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>