<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title>Login Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css?v=<?php echo time(); ?>">
        <style>
            body {
                background-image: url("../images/foodee.jpg");
                               background-size: cover;*/
                               
                          }

.errorr{
    color:blue;
}
        </style>
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1> <br>

            <?php
            if(isset($_SESSION['login']))

            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset( $_SESSION['no-login-message']))
            {
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            }
            ?>
            <br><br>


            <!--Login form starts Here-->
            <form action="" method="POST" class="text-center">
                Username: <input type="text" name="username" placeholder="Enter Username" style="width: 200px; height: 30px;"> <br><br>
                Password:&nbsp; <input type="password" name="password" placeholder="Enter password" style="width: 200px; height: 30px; "> <br><br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary" style="width: 100px; height: 30px;">


            </form>
            <!--Login form End Here-->
           <br><br> <h2 class="text-center" >Created By - <a href="https://www.instagram.com/prince_.022/">Prince</a></h2>
        </div>
    </body>
</html>
<?php 
//check whether the submit btn is clicked or not
if(isset($_POST['submit']))
{
    //process for login
    //1.Get the data from login form
    //$username = $_POST['username'];
    //$password = md5($_POST['password']);
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,md5($_POST['password']));

    //2. sql to check whether the user with username and password exusts or not
    $sql="SELECT * FROM tbl_admin WHERE username='$username' AND '$password' ";

    //3. execute the query
    $res=mysqli_query($conn,$sql);

    //4.count rows to check whether the user exsuts or not
    $count=mysqli_num_rows($res);

    if($count==1)
    {
        //user Available and Login Success
        $_SESSION['login']="<div class='success' > Login Successful.</div>";
        $_SESSION['user']=$username; // To check whether the user is logged in or not and logout will unset

        //Redirect to the home  Page/Daskboard
        header('location:'.SITEURL.'admin/');
    }
    else
    {
        //user not available and Login Failed
        $_SESSION['login']="<div class='errorr text-center'> Username and or password not match.</div>";
        //Redirect to the home  Page/Daskboard
         header('location:'.SITEURL.'admin/login.php');
    }
    


    
}
?>