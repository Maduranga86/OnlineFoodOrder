<?php include('Partials-front/menu.php');?>
  <!--Category section start here-->
  <section class="categories">
            <div class="container">
            <h2 class="text-center">Categories</h2>

            <?php 
            // create sql Query to Display categories fromdata base
            $sql = "SELECT * FROM tblcategory WHERE Active='Yes' AND Featured='Yes' LIMIT 3";
            $res = mysqli_query($conn, $sql);
            // count rows to check weather the category is availale or not
            $count = mysqli_num_rows($res);

            if ($count>0)
            {
                // category is available
                while($row=mysqli_fetch_assoc($res))
                {
                        $id =$row['id'];
                        $title =$row['Title'];
                        $image_name=$row['image_Name'];
                        ?>
                        <a href="#">
                        <div class="box-3 float-container">
                            <?php 
                                // cheack whether Image is available or not
                                    if($image_name=="")
                                    {
                                        //Display Message
                                        echo "<div calss='error'Image is not Available </div>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>image/category/<?php echo $image_name; ?>" alt="this one is delisious" class="img-responsive img-curve">
                                        <?php
                                    }
                            
                            
                            ?>
                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                        </a>

                        <?php
                }
            }
            else
            {
                // category is not available
                echo "<div class='error'> Category Not Added </div>";
            }
            
            ?>
            <div class="clearfix"> </div>
            </div>
        </section>
        <!--Category section end here-->
        <?php include('Partials-front/footer.php');?>