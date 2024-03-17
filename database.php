<?php 
    $host_name = "localhost";
    $db_user = "root";
    $db_password =""; 
    $db_name= "login_registration_1";
    $connection = mysqli_connect($host_name , $db_user , $db_password , $db_name);
    
    if(!$connection){
        die('Something went wrong!');

    }
?>