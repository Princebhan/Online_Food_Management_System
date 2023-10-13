<?php include('partials/menu.php'); ?>
<div class="menu-content">
    <div class="wrapper">
        <h1>Update Category</h1> <br><br>



        <?php 
        //check the whether the id
        if(isset($_GET['id']))
        {
            //Get The Id and all other details
            //echo "getting the data";
            $id=$_GET['id'];
            //create sql query to get all other details
            $sql="SELECT * FROM tbl_category WHERE id=$id";

            //execute the query
            $res=mysqli_query($conn,$sql);

            //count the rows to check whether the id is valid or not
            $count=mysqli_num_rows($res);

            if($count==1)
            {
                //get all the data
                $row=mysqli_fetch_assoc($res);

                $title=$row['title'];
                $current_image=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];
            }
            else{
                //redirect to manage category with session msg
                $_SESSION['no-category-found']="<div class='error'> Category not Found.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        }
        else{
            //redirected to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

          <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>

            <tr>
                <td>Current Image:</td>
                <td>
                   <?php 
                    if($current_image !="")
                    {
                        //Display the image
                        ?>
                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                        <?php
                    }
                    else{
                        /* Display msg*/
                        echo "<div class='error'> Image Not Added.</div>";
                    }
                   ?>
                </td>
            </tr>

            <tr>
                <td>New Image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Featured:</td>
                <td>
                    <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                    <input <?php if($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="No">No
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No">No
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                </td>
            </tr>

          </table>

        </form>
        <?php 
        if(isset($_POST['submit']))
        {
               // echo "clicked";
               //1. get all the values from our form
               $id=$_POST['id'];
               $title = $_POST['title'];
               $current_image=$_POST['current_image'];
               $featured=$_POST['featured'];
               $active=$_POST['active'];

               //2. updating new image if selected
               //check whether the image is selected or not
               if(isset($_FILES['image']['name']))
               {
                 //get the image details
                 $image_name=$_FILES['image']['name'];

                 //check whether the image is available or not
                 if($image_name !="")
                 {
                    //image Available
                    //A. Upload the new image 
                    //Auto Rename our image

                    //Get the extension of our image(jpg,png,gif,etc) eg."specialfood1.jpg"
                        $ext = end(explode('.', $image_name));

                        //Rename the image
                        $image_name="Food_Category_".rand(000,999).'.'.$ext; //e.g. Food_Category_123.jpg

                        $source_path=$_FILES['image']['tmp_name'];

                        $destination_path="../images/category/".$image_name;

                        //FInally upload the image
                        $upload=move_uploaded_file($source_path,$destination_path);

                        //check whether the image is uploaded or not
                        //And if the image is not uploaded then we will stop the process and redirected with error msg
                        if($upload==false)
                        {
                            $_SESSION['upload']="<div class='error'> Failed to Upload Image.</div>";

                            //redirected to Add category page
                            header('loaction:'.SITEURL.'admin/manage-category.php');
                            //stop the process
                            die();
                        }
                    
                    //B.remove the current image
                    if($current_image !="")
                    {

                    
                        $remove_path="../images/category/".$current_image;
                        $remove=unlink($remove_path);
                        //check whether the image is removed or not
                        //if failed tp=o remove then display msg and stop the process
                        if($remove=false)
                        {
                                //failed to remove immage
                                $_SESSION['failed-remove']="<div class='error'>Failed to remove current Image.</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die(); //stop the procces
                        }
                    }

                 }
                 else
                 {
                    $image_name=$current_image;
                 }
               }
               else{
                $image_name=$current_image;
               }

               //3.update the db
               $sql2="UPDATE tbl_category SET
               title='$title',
               image_name='$image_name',
               featured='$featured',
               active='$active'
               WHERE id=$id
               ";
               //execute the query
               $res=mysqli_query($conn,$sql2);


               //4. Redirected to manage category with msg
               //check whether executed or not
               if($res==TRUE)
               {
                    //category updated
                    $_SESSION['update']="<div class='success'>Category Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
               }
               else{
                    //Failed to update category
                    $_SESSION['update']="<div class='error'>Failed to updated Category.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
               }

        }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>