<?php
function connect(){
    $server = "localhost";
    $user = "root";
    $password = "";
    $db = "test";
    $conn = new mysqli($server,$user,$password,$db);
    if($conn->connect_errno){
        echo "Error: Unable to connect to MySQL";
        exit;
    }
    return $conn;
    
}