<?php include('partials/menu.php');?>

<div class="menu-content">
        <div class="wrapper">
            <h1>Add Category</h1> <br><br>

           <?php 

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset ($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset ($_SESSION['upload']);
            }

           ?>  <br><br>

   <!--- add Category start-->
            <form action="" method="POST" enctype="multipart/form-data">
            

                    Title: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                               <input type="text" name="title" placeholder ="Category title"> <br><br>

                    Select Image: <input type="file" name="image">  <br><br>

                    Featured:   <input type="radio" name="featured" value="Yes">Yes
                               <input type="radio" name="featured" value="No">No  <br><br>
                    
                    Active:  &nbsp;&nbsp;&nbsp;&nbsp;
                             <input type="radio" name="active" value="Yes">Yes
                             <input type="radio" name="active" value="No">No      <br> <br>

                    <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    
                    

                
            </form> 
    <!--- add Category End-->

    <?php 
     //check whether the submit button is clicked or not
     if(isset($_POST['submit']))
     {
        //echo "btn clicked";

        //1.Get the value from category form
        $title=$_POST['title'];
        
        //For radioninput type we need to check whether the btn is select or not
        if(isset($_POST['featured']))
        {
            //Get the value from the form
            $featured=$_POST['featured'];
        }
        else{
            //set the defualt the value
            $featured="No";
        }
        if(isset($_POST['active']))
        {
            $active=$_POST['active'];
        }
        else{
            $active="No";
        }

        //check whether the image is selected or not and set the value for image name category
       // print_r($_FILES['image']);

        //die(); //breake the code here

        if(isset($_FILES['image']['name']))
        {
            //iupload the image
            //to upload image we need image name,source path and destination path
            $image_name=$_FILES['image']['name'];

            //upload the image only if image is selected
            if($image_name!="")
            {    

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
                header('loaction:'.SITEURL.'admin/add-category.php');
                //stop the process
                die();
            }
         }
    }
        else
        {
            //DOn't upload the image and set the image_name value as blank
            $image_name="";
        }

        //2.cretae sql query to insert categotry into db
        $sql="INSERT INTO tbl_category SET
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'
        ";

        //#. Execute the query and save the db
        $res=mysqli_query($conn,$sql);
        //4. check whether the query execute or not and data added or not
        if($res==TRUE)
        {
            //Query executed and category added
            $_SESSION['add']="<div class='success'> Category Added Successfully.</div>";
            //Redirected to manage category page
            header('location:'.SITEURL.'./admin/manage-category.php');
        }
        else{
            //failed to add category
             //Query executed and category added
             $_SESSION['add']="<div class='error'> Failed to Add Category.</div>";
             //Redirected to manage category page
             header('location:'.SITEURL.'./admin/add-category.php');
        }
     }    
    ?>
        </div>
</div>

<?php include('./partials/footer.php');?>

