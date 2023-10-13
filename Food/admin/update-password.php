<?php include('partials/menu.php'); ?>

<div class="menu-content">
    <div class="wrapper">
        <h1>change password</h1> <br><br>

        <?php 
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }
        ?>
        <form action="" method="POST">

            Current password: <input type="password" name="current_password" placeholder="Old password"> <br><br> 
            New password:  &nbsp;&nbsp; &nbsp;&nbsp;<input type="password" name="new_password" placeholder="New password"> <br><br>

            <input type="hidden" name="id" value="<?php echo $id; ?>"> 
            Confirm password:  <input type="password" name="confirm_password" placeholder="Confirm password" > <br><br>

                        
            <input type="submit" name="submit" value="change Password" class="btn-secondary"> 

        </form>
    </div>
</div>
<?php 
//check whether the submit is clicked or noy
if(isset($_POST['submit']))
{
    //echo "clicked";

    //1.Get the data from the form

    $id=$_POST['id'];
    $current_password=md5($_POST['current_password']);
    $new_password =md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);

    //2. check whether the user with current ID and password exists or not
    $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password' ";

    //execute the query
    $res=mysqli_query($conn,$sql);
    If($res==TRUE)
    {
        //check whether data is available
        $count=mysqli_num_rows($res);

        if($count==1)
        {
            //User exists and password can be changed
            //echo "user found";\

            //check whether the new password and confirm password match or not
            if($new_password==$confirm_password)
            {
                //update the password
                $sql2="UPDATE tbl_admin SET 
                password='$new_password'
                WHERE id =$id";
                
                //execute the query
                $res2=mysqli_query($conn,$sql2);

                //check whether the query executed or not
                if($res2==TRUE)
                        {
                            //display success msg
                        //redirect to manage admin page with error msg

                        $_SESSION['change-pwd']="<div class='success'>password changed successfully</div>";
                        //redirected the user
                        header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                else
                        {
                            //display error msg
                            //redirect to manage admin page with error msg
                        $_SESSION['change-pwd']="<div class='error'>Failed to change password.</div>";
                        //redirected the user
                        header('location:'.SITEURL.'admin/manage-admin.php');
                        }
            }
            else
            {
                //redirect to manage admin page with error msg

                $_SESSION['pwd-not-match']="<div class='error'>password Did Not Match</div>";
                //redirected the user
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        else{
            //user does not exists set msg and redirect
            $_SESSION['user-not-found']="<div class='error'>User Not Found</div>";
            //redirected the user
            header('location:'.SITEURL.'admin/manage-admin.php');

        }
    }
    
    //3.check whether the new password and confirm password match or not
    //4. change password if all above is true
}
?>

<?php include('partials/footer.php'); ?>