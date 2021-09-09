<?php
    $db_host="localhost";
    $db_user="root";
    $db_password="";
    $db_name="shopping";
    $con=mysqli_connect($db_host,$db_user,$db_password,$db_name);
    //connection check
    if(!$con){
        die("Connection failed");
    }
?>