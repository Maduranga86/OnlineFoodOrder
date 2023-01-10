<?php

	include('partials/menu.php');
?>

		<div class="main-content">
			<div class="wrapper">
		
			<div class="text-center">
				<strong>Manage Category </strong>
			</div>
			 </div>
			<br> <br>
			<?php
			
			if(isset($_SESSION['add']))
			{
				echo $_SESSION['add'];
				unset($_SESSION['add']);
			}
			
			if(isset($_SESSION['remove']))
			{
				echo $_SESSION['remove'];
				unset($_SESSION['remove']);
			}
			
				if(isset($_SESSION['delete']))
			{
				echo $_SESSION['delete'];
				unset($_SESSION['delete']);
			}
			
			if(isset($_SESSION['noCategoryFound']))
			{
					echo $_SESSION['noCategoryFound'];
				unset($_SESSION['noCategoryFound']);
				
			}
			if(isset($_SESSION['update']))
			{
				echo $_SESSION['update'];
				unset ($_SESSION['update']);
			}
			
			if(isset($_SESSION['upload']))
			{
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);
			}
			if(isset($_SESSION['failedToRemove']))
			{
				echo $_SESSION['failedToRemove'];
				unset($_SESSION['failedToRemove']);
			}
			?>
			<br> <br>
			<a href="AddCategory.php" class="btn-primery"> Add Category </a>
			<br> <br>
			
				<table class="tbl-full">
				<tr> 
					<th> S.N </th>
					<th> Title </th>
					<th> Image </th>
					<th>Featured </th>
					<th> Active</th>
					<th>Action</th>
				</tr>
				
				 <?php
					//Query to get all Categories from Database
					$sql ="Select * FROM tblcategory";
					//Execute Query
					$res = mysqli_query($conn,$sql);
					//Count Rows
					$count = mysqli_num_rows($res);
					
					//create Serial Number Variable and assign value as 1
					$sn=1;
					//Check weather we have data in tblcategory or not
					if($count>0)
					{
						// we have data in data base
						// get the data and Display on the page 
						while($row = mysqli_fetch_assoc($res))
						{
							$id =$row['id'];
							$Title =$row['Title'];
							$image_name =$row['image_Name'];
							$featured = $row['Featured'];
							$active =$row['Active'];
							?>
							<tr>
								<td><?php echo $sn++?></</td>
								<td> <?php echo $Title ?></td>
								<td>
								<?php 
										//check weather image name is available or not 
										if($image_name!="")
										{
											//display the image 
											?>
											<img src="<?php echo SITEURL;?>image/category/<?php echo $image_name; ?>" width="100px" height="
											50px">
											
											<?php 
										}
										else 
										{
											// display the message
											echo "<div class='error'> image is not added. </div> ";
										}
								?>
								</td>	
								<td><?php echo $featured ?></td>
								<td> <?php echo $active ?></td>
								<td>
																	
									<a href="<?php echo SITEURL; ?>admin/updateCategory.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
									<a href="<?php echo SITEURL; ?>admin/deleteCategory.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"  class ="btn-delAdmin">Delete Category</a>
								</td>
							</tr>
							<?php 
						}
					}
					else 
					{
						// we dont have data in database
						// display the message inside the table
						?>
						<tr> 
						<td colspan="6"> <div class="error">No Categories Added </div> </td>
						</tr>
						<?php 
						
					}
						
				 
				 ?>
				
				</table>
				
		</div>
<?php		
	include('partials/footer.php');
?>