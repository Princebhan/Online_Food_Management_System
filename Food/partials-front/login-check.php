<?php 
    //Authorization - access control
    //check whether the user is logged in or not
    if(!isset($_SESSION['user'])) //if user session is not set
    {
        //user is not looged in
        //redirected to login with msg
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access User panel.</div>";
        //redirected to logn page
        header('location:'.SITEURL.'login.php');
    }

?>