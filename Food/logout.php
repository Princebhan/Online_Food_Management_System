<?php 
    // Include constans.php for SITEURL
    include('config/constants.php');

    // 1. destory the session 
    session_destroy();  //unsets $_SESSION['user']

    //2.redirect to login page
    header('location:'.SITEURL.'login.php');
?>