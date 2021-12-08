<?php 
   
    $server = "";   
    $user = ""; 
    $pass = ""; 
    $dbname = "";  
    
    $conn = new mysqli($server,$user,$pass,$dbname);

    if(mysqli_connect_errno()){
        echo "Error. No connectat a la base de dades", mysqli_connect_error();
        exit();
    }


