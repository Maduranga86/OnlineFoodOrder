<!DOCTYPE HTML>
<html>
<body>
<?php
include('partials/menu.php');
?>
		<!-- menu section Start-->
	
		<!-- menu section End-->
		
		<!-- main content section Start-->
	<div class="main-content">
		<div class="wrapper">
			<h1> Manage Food </h1>
			<?php 
				if(isset($_SESSION['add']))
				{
					echo $_SESSION['add']; //display session message
					unset($_SESSION['add']);//removing session message 
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
				if(isset($_SESSION['user_not_found']))
				{
					echo $_SESSION['user_not_found'];
					unset($_SESSION['user_not_found']);
					
				}
				
					if(isset($_SESSION['pwrd_not_match']))
				{
					echo $_SESSION['pwrd_not_match'];
					unset($_SESSION['pwrd_not_match']);
					
				}
				
				if(isset($_SESSION['changed_pwd']))
				{
					echo $_SESSION['changed_pwd'];
					unset($_SESSION['changed_pwd']);	
				}	
			?>
			<br> <br>
			<br> <br>
			<a href="<?php echo SITEURL; ?>admin/addFood.php" class="btn-primery"> Add Food </a>
			<br> <br>
			<table class="tbl-full">
				<tr height="40px"> 
					<th> SN </th>
					<th> Title </th>
					<th> Price </th>
					<th> Image</th>
					<th> Featured </th>
					<th> Active</th>
					<th> Action </th>
				</tr>
			<?php 
					// create sql query to get all the food item
					$sql =  "SELECT * FROM tbl_fooditem";
					//Execute the Query
					$res =mysqli_query($conn,$sql);
					
					//check weather query is executed or not 
					if($res == TRUE)
					{
					//count rows tocheck weather we have data in data base or not 
					$count = mysqli_num_rows($res);  // function to get all the rows in data base 
					}
					//check the number of rows 
					//create serial number variable and set default value as 1
					$sn =1;
					if($count>0)
					{
						//we have data in the database
						$rows=mysqli_fetch_assoc($res);
						while($rows == TRUE)
						{
						// and while loop will run aslong as we have data in the database 
						// get individual data	
						$id = $row['id'];
						$title = $row['Title'];
						$price = $row['Price'];
						$image_name = $row['imageName'];
						$featured = $row['Featurerd'];
						$active = $row['Active'];			
						?>
						<tr>
							<td><?php echo $sn++; ?></td>
							<td> <?php echo $title; ?></td>
							<td><?php echo $price; ?></td>	
							<td><?php echo $image_name; ?></td>
							<td><?php echo $featured; ?></td>
							<td><?php echo $active; ?></td>
							<td>
						<a href="" class="btn-secondary">Change Password</a>								
						<a href="" class="btn-secondary">Update Admin</a>
						<a href="" class="btn-delAdmin">Delete Admin</a>
							</td>
						</tr>
						<?php
		
						}
				
					 }
					else
					{
						//foods not added in to the database
						echo "<tr><td colspan='7' class='error'> Food Not added Yet.</td></tr>";
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
	</body>
	</html>