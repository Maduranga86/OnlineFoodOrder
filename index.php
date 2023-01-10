<?php include('Partials-front/menu.php');?>

         <!--Food Search section start here-->
         <section class="food_search text-center" >
            <div class="container">
            <h2>Food Search</h2>

                <form action="">
                    <input type ="search" name="search" placeholder="search for foods...." class="searchbar">
                    <input type="submit" name="submit" value="search" class="btn1 btn1-primary">
                </form>
                  
            </div>
        </section>
        <!--Food Search section end here-->

         <!--Category section start here-->
         <?php 
            // create sql Query to Display categories fromdata base
            $sql = "SELECT * FROM tblcategory";
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
         <!--Food Menu section start here-->
         <section class="food_menu">
            <div class="container">
          
            <h2 class="text-center"> Explore Foods</h2>
            <?php 
                // Getting Foods from data base that are active and featured 
                $sql2 = "SELECT * FROM tblfood WHERE Active='Yes' AND Featurerd='Yes' LIMIT 6";
                $res2 = mysqli_query($conn, $sql2);
                // count rows to check weather the category is availale or not
                 $count2 = mysqli_num_rows($res2);
                 if($count2>0)
                 {
                        //Foods are Available
                        while($row=mysqli_fetch_assoc($res2))
                        {
                            // Get All the Value 
                            $id = $row['id'];
                            $title = $row['Title'];
                            $price = $row['Price'];
                            $description = $row['Description'];
                            $image_name =$row['imageName'];
                            ?>
                        <div class="food_menu_box">
                            <div class="food_menu_img"> 
                                <?php 
                                    // check weather image available or not
                                    if($image_name=="")
                                    {
                                        // Image is not Available
                                        echo "<div class='error'> Image is Not Available </div>";
                                    }
                                    else
                                    {
                                            // Image Avaiable 
                                            ?>
                                                 <img src="<?php echo SITEURL; ?>image/FoodItem/<?php echo $image_name; ?>" alt="i dont know about this food" class="img-responsive img-curve" >
                                            <?php  
                                    }
                              
                                ?>
                                  </div>
                                    
                                    <div class="food_menu_desc">
                                        <h4><?php echo $title; ?></h4>
                                        <p class="food_price"> <?php echo $price; ?></p>
                                        <p class="food_details"> <?php echo $description;  ?></p>
                                        <br>
                                        <a href="#" class="btn1 btn1-primary"> Order Now</a>
                                    </div>
                                  
                                
                                </div>
                               

                            <?php 
                        }

                 }
                 else
                 {
                        //Food is not Available 
                        echo "<div class='error'> Food is Not Available </div>";
                 }
            
            ?>
            </div>
                <div class="clearfix"> </div>                 
        </section>
        <!--Food Menu section end here-->
        <?php include('Partials-front/footer.php');?>