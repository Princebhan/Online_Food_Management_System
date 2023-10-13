<?php include('partials/menu.php');?>

<div class="menu-content">
    <div class="wrapper">
        <h1>Update Admin </h1> <br><br>

        <?php 
            //1.get id of selected admin 
            $id=$_GET['id'];
            //2.create sql query to get the details
            $sql="select * from tbl_admin WHERE id=$id";

            //execute the query
            $res=mysqli_query($conn,$sql);

            //check whether the query is executed or not
            if($res==TRUE)
            {
                    $count = mysqli_num_rows($res);
                    //check whether we have admin data or not
                    if($count==1)
                    {
                        //Get the Details
                        //echo "Admin Available";
                        $row=mysqli_fetch_assoc($res);
                        $full_name=$row['full_name'];
                        $username=$row['username'];
                    }
                    else{
                        //Redirected to manage admin page
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
            }
        ?>
        <form action="" method="POST">
                
                        Full Name: <input type="text" name="full_name" value="<?php echo $full_name;?>"> <br><br>
                        Username:  <input type="text" name="username" value="<?php echo $username;?>"> <br><br>

                        <input type="hidden" name="id" value="<?php echo $id; ?>"> <br>
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary"> 

        </form>
    </div>
</div>
<?php 

//check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
   // echo "Button clicked";
   //get all the values from form to update
   $id=$_POST['id'];
   $full_name=$_POST['full_name'];
   $username=$_POST['username'];

    //create a sql query to update Admin
    $sql="UPDATE tbl_admin SET
    full_name='$full_name',
    username='$username' 
    WHERE id='$id'";
    
    //execyte the query
    $res=mysqli_query($conn,$sql);

    //check whether the query executed successfully or no

    if($res==TRUE)
    {
        //Query executed and admin update
        $_SESSION['update'] = "<div class='success'>Admin Updated Successfully. </div>";
        //redirected to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        //Failed to update admin
         $_SESSION['update'] = "<div class='error'>Failed to Delete Admin. </div>";
        //redirected to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');

    }
}
?>

<?php include('partials/footer.php');?>