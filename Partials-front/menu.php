<?php include('config/constant.php'); ?>
<!DOCTYPE html>
<html lang="en">
    <head> 
        <meta charset ="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Restaurant Website</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <!--Navigation bar section start here-->
        <section class="navbar">
            <div class="container">
            <div class="logo"> 
               <img src="images/logo2.png" alt="Restaurent Logo"  class="img-responsive">
            </div>
            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>category.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Food</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Contact</a>
                    </li>
                </ul>
                <div class="clearfix">

                </div>
            </div>
            </div>
        </section>
        <!--Navigation bar section end here-->