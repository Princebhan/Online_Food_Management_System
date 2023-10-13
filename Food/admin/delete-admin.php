<?php 

    //include constatns.php file here
    include('../config/constants.php');
//1.get id of adminn to be deleted
    $id=$_GET['id'];

//2.create sql query to delete admin
$sql="DELETE FROM tbl_admin WHERE id=$id";

//execute the query
$res=mysqli_query($conn,$sql);

//check whether the query executed suucessfullly or not
if($res==TRUE)
{
    //query Executed successfully and admin deleted
    //echo "Admin deleted";
    //create session variable to display msg
    $_SESSION['delete']="<div class='success'>Admin Deleted Successfully.</div>";
    //Redirected to manage admin page
    header('location:'.SITEURL.'admin/manage-admin.php');

}
else{
    //echo "Failed to Deleted Admin";

    $_SESSION['delete']="<div class='error'>Failed to deleted Admin. Try Again Later.</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');

}
//3.Redirect to manage admin page with msg (success/error)
?>