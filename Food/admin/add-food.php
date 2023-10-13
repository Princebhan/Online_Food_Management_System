<?php include('partials/menu.php'); ?>
<div class="menu-content">
    <div class="wrapper">
        <h1>Add Food</h1> <br><br>

        <?php
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset ($_SESSION['upload']);
        }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                                //create Php code to display categories from db
                                //1. Create sql to get all active categoriesfrom db
                                $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                                //execute query
                                $res=mysqli_query($conn,$sql);

                                //count rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                //if count is greater than zero, we have categories esle we do not have categories
                                if($count>0)
                                {
                                    //we have categories
                                    while ($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of categories
                                        $id=$row['id'];
                                        $title=$row['title'];
                                        ?>

                                         <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else{
                                    //we do not have categories
                                    ?>
                                     <option value="0">No category Found</option>
                                    <?php 

                                }

                                //display on dropdown
                            
                            ?>
                          
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                    <input type="radio" name="active" value="Yes"> Yes
                    <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
        <?php 
            //check whether the buuton is clicked or not
            if(isset($_POST['submit']))
            {
                //add the food in db 
                //echo "clicked ";

                //1.Get the data from form
                $title=$_POST['title'];
                $description=$_POST['description'];
                $price=$_POST['price'];
                $category=$_POST['category'];

                //check whether radion buuton for featured and active are checked or not
                if(isset($_Post['featured']))
                {
                    $featured=$_POST['featured'];

                }
                else{
                    $featured="No"; //setting the default value
                }
                if(isset($_POST['active']))
                {
                    $active= $_POST['active'];

                }
                else{
                    $active = 'No';// setting the defualt value
                }
                //2.upload the image if selected
                //check whether the select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name']))
                {
                    //get the details of selected image
                    $image_name=$_FILES['image']['name'];
                    //check whether the image is selected or not and upload image only if selected
                    if($image_name !="")
                    {
                        //image is selected
                        //A. rename a image
                        //get the extension of selected image (jpg,png,gif,etc.)"prince.jpg"
                        $ext = end(explode('.',$image_name));

                        //create new name for image
                        $image_name="Food-Name-".rand(0000,9999).'.'.$ext; //new image name may be "Food-Name-657.jpg"
                        //B. upload a image
                        //get the src path and destination path

                        // source path is the current loaction of the image
                        $srd=$_FILES['image']['tmp_name'];

                        //Destination path for the image to be uploaded
                        $dst="../images/food/".$image_name;

                        //finally upload the food image

                        $upload = move_uploaded_file($srd,$dst);

                        //check whether image uploaded or not
                        if($upload==False)
                        {
                            //failed to upload  the image
                            //redirected to add page with error 
                            
                            $_SESSION['upload']="<div class='error'>Failed to upload Image.</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            //stop the process
                            die();
                        }
                    }


                }
                else{
                    $image_name=""; //setting default value as blank
                }
                //3.Insert into db

                //create a sql query to save or add food
                //for numerical value not need to pass value inside the quetes'' but for string it is complusry add ''quotes
                $sql2="INSERT INTO tbl_food SET
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                category_id=$category,
                featured='$featured',
                active='$active'
                ";

                //execute query
                $res=mysqli_query($conn,$sql2);
                //check whether data inseerted or not
                 //4. redirected with msg to manage food page
                if ($res == True)
                {
                    //data inserted successfyully
                    $_SESSION['add']="<div class='success'> Food Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else{
                    //Failed to inserrt data
                    $_SESSION['add']="<div class='error'> Failed to Add Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
               
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>