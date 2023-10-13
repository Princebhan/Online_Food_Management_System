<?php 
    //include constants page
    include('../config/constants.php');

    //echo "delete food page";
    if(isset($_GET['id']) && isset($_GET['image_name'])) //use AND or &&
    {
        //proceess to delete
        //echo "process to Delete";

        //1. Get id image name
        $id=$_GET['id'];
        $image_name=$_GET['image_name'] ;
        //2. remove the image if available
        //check the whether the imnage is avaialabe or not and delete only if available
        if($image_name !="")
        {
            //it has image and need to remove from folder
            //get the image path
            $path="../images/food/".$image_name;

            //remove image file from folder
            $remove=unlink($path);
            //check wherher the immage is removed or not
            if($remove==False){
                //failed to remove image
                $_SESSION['upload']="<div class='error'> Failed to Remove Image File.</div>";
                //Redirected to manage food
                header('location:'.SITEURL.'admin/manage-food.php');

                //stop the proceess of deleteing food
                die();
            }
        }
        //3. delete food from db
        $sql="DELETE FROM tbl_food WHERE id=$id";
        //execure the query
        $res=mysqli_query($conn,$sql);
        //check the query executed or not and set the session msg respsectively
        //4.redirect to manage food with session msg

        if($res==TRUE)
        {
                //food deleted
                $_SESSION['delete']="<div class='success'> Food Deleted Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
        }
        else{
            //Failed to delete
            $_SESSION['delete']="<div class='error'> Failed to Delete Food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');

        }
        
    }
    else{
        //redirected to manage foood page
        //echo "Redirected";
        $_SESSION['unauthorize']="<div class='error'> Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>
