<?php

include('partials/menu.php');

?>
<!DOCTYPE HTML>
		<!-- menu section Start-->
	
		<!-- menu section End-->
		
		<!-- main content section Start-->
	<div class="main-content">
		<div class="wrapper">
			<h1> Manage Admin </h1>
			</div>
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
			<a href="AddAdmin.php" class="btn-primery"> Add Admin </a>
			<br> <br>
			<table class="tbl-full">
				<tr> 
					<th> Serial Number </th>
					<th> Full Name </th>
					<th> User Name </th>
					<th> Action </th>
					
				</tr>
				
				<?php
				//Query to get all Admin
				$sql ="SELECT * FROM admin";
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
							$id =$rows['SN'];
							$Full_Name =$rows['FullName'];
							$username =$rows['UserName'];
							//Display the value in our table 
							?>
							<tr>
								<td><?php echo $id;?></td>
								<td> <?php echo $Full_Name; ?></td>
								<td><?php  echo $username ; ?></td>	
								<td>
									<a href="<?php echo SITEURL; ?>admin/updatePassword.php?id=<?php echo $id; ?>" class="btn-secondary">Change Password</a>								
									<a href="<?php echo SITEURL; ?>admin/updateAdmin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
									<a href="<?php echo SITEURL; ?>admin/deleteAdmin.php?id=<?php echo $id; ?>" class="btn-delAdmin">Delete Admin</a>
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