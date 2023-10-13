<?php
include('config/constants.php');
?>

<html>
<head>
    <title>Login Food Order System</title>
    <link rel="stylesheet" href="css/admin.css?v=<?php echo time(); ?>">
    <style>
        body{
            background-image: url("images/foos.jpg");
            background-size: cover;
            }

    </style>
</head>

<body>


    <div class="login">
        <h1 class="text-center" style="color: white;">Login</h1><br>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>
        <br><br>

        <!-- Login form starts Here -->
        <form action="" method="POST" class="text-center">
        <p style="color: white;">   Username: <input type="text" name="username" placeholder="Enter Username" style="width: 200px; height: 30px;"><br><br></p>
        <p style="color: white;">Password: <input type="password" name="password" placeholder="Enter password" style="width: 200px; height: 30px;"><br><br><br></p>

            <input type="submit" name="submit" value="Login" class="btn-primary" style="width: 100px; height: 30px; ">
        </form>
        <!-- Login form End Here -->

        <br><br>
        <h3 class="text-center" style="color: white;">Don't have an account? <a href="createAccount.php">Create an account</a></h3>

        <br><br>
        <h4 style="color: white;" class="text-center">Created By - <a href="https://www.instagram.com/prince_.022/">Prince</a></h4>
    </div>
</body>
</html>

<?php
// Check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    // Process for login
    // Get the data from the login form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    // SQL to check whether the user with username and password exists or not
    $sql = "SELECT * FROM tbl_user WHERE username='$username' AND password='$password'";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // User available and login successful
        $_SESSION['login'] = "<div class='success'> Login Successful.</div>";
        $_SESSION['user'] = $username; // To check whether the user is logged in or not and logout will unset

        // Redirect to the home Page/Dashboard
        header('location: ' . SITEURL . 'index.php');
    } else {
        // User not available and login failed
        $_SESSION['login'] = "<div class='error text-center'> Username and/or password do not match.</div>";

        // Redirect to the login Page
        header('location: ' . SITEURL . 'login.php');
    }
}
?>
