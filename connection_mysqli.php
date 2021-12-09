<?php 
   
    $server = "";   
    $user = ""; 
    $pass = ""; 
    $dbname = "";  
    
    $conn = new mysqli($server,$user,$pass,$dbname);

    if(mysqli_connect_errno()){
        echo "Error. Not connected to database.", mysqli_connect_error();
        exit();
    }


