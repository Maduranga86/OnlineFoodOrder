<?php

include('partials/menu.php');

?>
<!DOCTYPE HTML>
		<!-- menu section Start-->
	
		<!-- menu section End-->
		
		<!-- main content section Start-->
	<div class="main-content">
		<div class="wrapper">
			<h1> Manage Food</h1>
			</div>
			<?php 
				if(isset($_SESSION['remove']))
				{
					echo $_SESSION['remove']; //display session message
					unset($_SESSION['remove']);//removing session message 
				}
			
			if(isset($_SESSION['delete']))
				{
					echo $_SESSION['delete']; //display session message
					unset($_SESSION['delete']);//removing session message 
				}
				
				if(isset($_SESSION['update']))
				{
					echo $_SESSION['update']; //display session message
					unset($_SESSION['update']);//removing session message 
				}
				
				if(isset($_SESSION['failedToRemove']))
				{
					echo $_SESSION['failedToRemove']; 
					unset($_SESSION['failedToRemove']);
				}
				
				if(isset($_SESSION['noFoodFound']))
				{
					echo $_SESSION['noFoodFound']; 
					unset($_SESSION['noFoodFound']); 
				}	
				if(isset($_SESSION['update2']))
				{
					echo $_SESSION['update2']; 
					unset($_SESSION['update2']); 
				}	
			?>
			<br> <br>
			<br> <br>
			<a href="<?php echo SITEURL; ?>admin/addFood.php" class="btn-primery"> Add Food </a>
			<br> <br>
			<table class="tbl-full">
				<tr> 
                    <th> SN </th>
					<th> Title </th>
					<th> Price </th>
					<th> Image</th>
					<th> Featured </th>
					<th> Active</th>
					<th> Action </th>
				</tr>
				
				<?php
				//Query to get all Admin
				$sql ="SELECT * FROM tblfood";
				//Execute the Query
				$res =mysqli_query($conn,$sql);
				//chech weather query is executed or not 
				if($res == TRUE)
				{
					//count rows tocheck weather we have data in data base or not 
					$count = mysqli_num_rows($res);  // function to get all the rows in data base 
				
					//check the number of rows 
					if($count>0)
					{
						//we have data in the database
						while($rows =mysqli_fetch_assoc($res))
						{
							//using while loop to get all the data from database 
							// and while loop will run aslong as we have data in the database 
							// get individual data
							$id = $rows['id'];
						    $title = $rows['Title'];
						    $price = $rows['Price'];
						    $image_name = $rows['imageName'];
						    $featured = $rows['Featurerd'];
						    $active = $rows['Active'];
							//Display the value in our table 
							?>
							<tr>
								<td><?php echo $id;?></td>
								<td> <?php echo $title; ?></td>
							    <td><?php echo $price; ?></td>	
							    <td>
                                    <?php 
                                    //check weather image is available or not
                                    if($image_name =="")
                                    {
                                        // we do not have image, Display error message
                                        echo "<div class='error'> Image not Added.</div>";
                                    }
                                    else
                                    {
                                        // image is available, then display it
                                        ?>
                                        <img src="<?php echo SITEURL;?>image/FoodItem/<?php echo $image_name; ?>" width="100px" height="50px">
                                        <?php
                                    }
                                     ?>
                                </td>
							    <td><?php echo $featured; ?></td>
							    <td><?php echo $active; ?></td>
								<td>								
									<a href="<?php echo SITEURL; ?>admin/updateFood.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food Item</a>
									<a href="<?php echo SITEURL; ?>admin/DeleteFood.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-delAdmin">Delete Food Item</a>
								</td>
							</tr>
							
				<?php
						}
					}
					else 
					{
						// we dont have data in the database 
					}
				}
				
				?>

			
			</table>
	
		</div>
	</div>
		<!-- main content section end-->
	<br>	
		<br>	
	<br>	
		<!-- footer section Start-->
	<?php
		include ('partials/footer.php');
		
	?>	