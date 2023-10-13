<?php include('partials/menu.php');?>

<div class="menu-content">
        <div class="wrapper">
            <h1>Add Admin</h1> <br><br> 
            <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add']; //Display the Session msg if set
                unset ($_SESSION['add']); //remove session msg
            }
            ?>

            <form action="" method="POST">
                <!-- <table class="tbl-30">

                    <tr>
                        <td>Full Name: </td> 
                        <td><input type="text" name="full_name" placeholder="Enter Your Name"></td> 
                    </tr>

                    <tr>
                        <td>Username: </td> 
                        <td>
                            <input type="text" name="username" placeholder="Your Username"> 
                        </td>
                    </tr>

                    <tr>
                        <td>Password: </td>
                        <td>
                            <input type="password" name="password" placeholder="Your Password">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </tr> -->

                     Full Name: <input type="text" name="full_name" placeholder="Enter Your Name"> <br><br>
                    Username:  <input type="text" name="username" placeholder="Your Username"> <br><br>
                    Password:  <input type="password" name="password" placeholder="Your Password"> <br> <br>
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary"> 


                </table>
            </form>

        </div>
</div>

<?php include('./partials/footer.php');?>

<?php 
//process the value from form and save it in Databse
//check whether the button is clicked or not 

if(isset($_POST['submit']))
{
    //btn clicked
    //echo "btn clicked";

    //1. Get Form Form
   $full_name = $_POST["full_name"];
   $username = $_POST["username"];
   $password = md5($_POST["password"]); //password encrption with MD5

   //2.SQl Query to save the data into db

   $sql = "INSERT INTO tbl_admin SET
    full_name='$full_name',
    username='$username',
    password='$password'
   ";
  
 //3. executing query and saving data into database
  $res=mysqli_query($conn,$sql) or die(mysqli_error());

  //4. check whether the (query is excuted) data is inseretd or not and display apporiate msg
  if($res==TRUE)
  {
    //Data inserted
   // echo "Data inserted";
   //create a session display to variable msg
   $_SESSION['add']='<div class="success">Admin Added Successfully </div>';
   //Redirected page TO Manage admin page
   header("location:".SITEURL.'admin/manage-admin.php');
  }
  else{
    //failed to insert data
    //  echo "fail to insert data";
    $_SESSION['add']='Failed to add Admin';
    //Redirected page TO Manage admin page
    header("location:".SITEURL.'admin/manage-admin.php');
  }

}

?>
