<?php include('config/constants.php'); ?>
<html>
    <head>
        <title>Register Food Order System</title>
        
        <link rel="stylesheet" href="css/admin.css?v=<?php echo time(); ?>">
       <style>
        body {
            background-image: url("images/fast.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            }

       </style>

    </head>
    <body>
        <div class="login">
            <h1 class="text-center" style="color: white;">Register</h1> <br>

            <?php
            if(isset($_SESSION['register']))

            {
                echo $_SESSION['register'];
                unset($_SESSION['register']);
            }

        
            ?>
            <br><br>


            <!--Login form starts Here-->
            <form action="" method="POST" class="text-center">
                <p style="color: white;">Username: <input type="text" name="username" placeholder="Enter Username" style="width: 200px; height: 30px;"> <br><br></p>
                <p style="color: white;">  Password:&nbsp; <input type="password" name="password" placeholder="Enter password" style="width: 200px; height: 30px;"> <br><br><br></p>

                <input type="submit" name="submit" value="Register" class="btn-primary" style="width: 100px; height: 30px; ">


            </form>

            <!--Login form End Here-->

            <br><br> <h2 class="text-center" style="color: white;">Already have an account?<a href="login.php">Log in</a></h2>

           <br><br> <h3 class="text-center" style="color: white;">Created By - <a href="https://www.instagram.com/prince_.022/">Prince</a></h3>
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
    //$username = mysqli_real_escape_string($conn,$_POST['username']);
    //$password = mysqli_real_escape_string($conn,md5($_POST['password']));

    $username = $_POST["username"];
    $password = md5($_POST["password"]); //password encrption with MD5

    //2. sql to check whether the user with username and password exusts or not
    //$sql="SELECT * FROM tbl_user WHERE username='$username' AND '$password' ";
    
   $sql = "INSERT INTO tbl_user SET
   username='$username',
   password='$password'
  ";
 

    //3. execute the query
    $res=mysqli_query($conn,$sql);
    //or die(mysqli_error());

    //4.count rows to check whether the user exsuts or not
   // $count=mysqli_num_rows($res);

    if($res==TRUE)
    {
        //user Available and Login Success
        $_SESSION['register']="<div class='success'> User Added Successfully<br>Now You can Login</div>";
       // $_SESSION['user']=$username; // To check whether the user is logged in or not and logout will unset

        //Redirect to the home  Page/Daskboard
       
       header('location:'.SITEURL.'login.php');
      
    }
    else
    {
        //user not available and Login Failed
        $_SESSION['register']="<div class='error text-center'> Failed to add user.</div>";
        //Redirect to the home  Page/Daskboard
         header('location:'.SITEURL.'createAccount.php');
    }
    

}
?>