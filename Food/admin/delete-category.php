<?php 
//inlcude constsnts file
include('../config/constants.php');
//echo"Delete Page";
//check whether the id and image_name value is set or not
if(isset($_GET['id']) && isset($_GET['image_name'])) 
{
    //Gt the value and delete
    //echo "Get value and delete";
    $id=$_GET['id'];
    $image_name = $_GET['image_name'];

    //Remove the physical image file is avilabel
    if($image_name != "")
    {
        //image i sAvailable do remove it
        $path="../images/category/".$image_name;

        //Remove the image
        $remove = unlink ($path);
            //if failed to remove image then an error msg and stop the process

        if($remove==false)
        {
            //set the session msg
            $_SESSION['remove']="<div class='error'> Failed to Remove Category Image.</div>";
            //redirect to manage category page
            header('location:'.SITEURL.'admin/manage-category.php');
            //stop the proccess
            die();

        }
    }
    //delete  data form db
    //sql query to delete data from db
    $sql="DELETE FROM tbl_category WHERE id=$id";

    //excute a query
    $res=mysqli_query($conn,$sql);

    //check whether the data is delete from db or not
    if($res==TRUE)
    {
        //set success msg and redirect
        $_SESSION['delete']="<div class='success'> Category Deleted Successfully.</div>";
        //Redirected to manage category
        header('Location:'.SITEURL.'admin/manage-category.php');

    }
    else{
        //set fail msg and redirect
        $_SESSION['delete']="<div class='error'> Failed to Delete Category.</div>";
        //Redirected to manage category
        header('Location:'.SITEURL.'admin/manage-category.php');

    }

    //Redirect to manage caterory page with msg
    
}
else{
    //redirected to manage category page
    header('Location:'.SITEURL.'admin/manage-category.php');
}
?>