<?php include('Partials-front/menu.php');?>
<
<!-- Food Search Section Start Here -->

<section class="food_search">
    <div class="container">
        <h2 class="text-center text-white"> fill this form for confirm your order </h2> 

    <form action="#" class="order">
        <fieldset>
                <legend> selected Food </legend>
                <div class="food_menu_img">
                        <img src="images/Food3.jpg" alt="order it now before too late" class="img-responsive img-curve">
                </div>   
                
                <div class="food_menu_desc">
                    <h3>Food Title </h3>
                    <p class="food_price"> $2.3</p>
                    <div class="order-lable"> Quantity </div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                </div>
</fieldset>

<fieldset>
    <legend> Delivery Details </legend>
    <div class="order-lable"> Full Name </div>
    <input type="text" name="FullName" placeholder="Eg- Sam nicolus" class="input-responsive" required>

    <div class="order-lable"> Phone Number </div>
    <input type="tel" name="Contact" placeholder="Eg- 07XXXXXXXX" class="input-responsive" required>

    <div class="order-lable"> E mail:</div>
    <input type="email" name="email" placeholder="Eg- yourmail@hot.com" class="input-responsive" required>

    <div class="order-lable"> Address: </div>
    <textarea Name="Address" rows="10" placeholder="Eg. Street, City, Postal Code" class="inpu- responsive" required></textarea>
    <input type="submit" name="submit" value="confirmOrder" class="btn1 btn1-primary">

</fieldset>
</form>
</div>
</section> 
<?php include('Partials-front/footer.php');?>