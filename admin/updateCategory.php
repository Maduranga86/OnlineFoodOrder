<?php 
include('partials/menu.php');
//echo "list updated";


?>
<div class="main-content">
		<div class="wrapper">
			<h1> Update Category </h1>
			</div>
			<br><br>
			
			<?php 
			// check weather the ID is set or not
			if(isset($_GET['id']))
			{
				// get the id and all other details
				//echo "getting the data";
				$id=$_GET['id'];
				// Create the squl query to get all other details
				$sql ="SELECT * FROM tblcategory WHERE id=$id";
				//execute the query
				$res =mysqli_query($conn,$sql);
				
				//count the rows and check weather the id is valid or not
				$count =  mysqli_num_rows($res);
				
				if($count==1)
				{
					// get all the data
					$row = mysqli_fetch_assoc($res);
					$title=$row['Title'];
					$current_image=$row['image_Name'];
					$featured=$row['Featured'];
					$active=$row['Active'];
				}
				else
				{
					//redirect to manage Category with session message 
					$_SESSION['noCategoryFound']= "<div class='error'>Category not Found.</div>";
					header('Location:'.SITEURL.'admin/ManageCategory.php');
				}
			}
			else 
			{
				// Redirect the Manage Category
				header('location:'.SITEURL.'admin/ManageCategory.php');
			}
			?>
			<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-45">
				<tr>
					<td> Title: </td>
					<td> <input type="text" name="title" placeholder="Category Title" value="<?php echo $title; ?>"></td>
				</tr>	
				<tr>
						<td>current Image:</td>
						<td> 
						<?php 
							if($current_image!="")
							{
								?>
								<img src="<?php echo SITEURL; ?>image/category/<?php echo $current_image; ?>" width="150px" height="100px"> 
								<?php
								//display the image
							}
							else 
							{
								echo "<div class='error'> image not added . </div>";
							}
						?>
						</td>
				</tr>
				<tr>
						<td>New Image:</td>
						<td> <input type="file" name="image"></td>
				</tr>
				<tr>
					<td> Featured: </td>
					<td> 
					<input <?php if($featured=="yes"){echo "checked";} ?> type="radio" name="featured" value="yes">YES
					<input <?php if($featured=="no") {echo "checked";} ?> type="radio" name="featured" value="no">NO
					</td>
				</tr>	
				
				<tr>
					<td> Active:</td>
					<td> 
					<input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes">YES
					<input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No">NO </td>
				</tr>
				<tr>
				<td colspan="2">
					<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<input type="submit" name="submit" value="Update Category"  class="btn-secondary"> </td>
				</tr>
			</table>
				</form>
				
				<?php 
					if(isset($_POST['submit']))
					{
						//echo "clicked";
						//1.get all the values from our form
						$id= $_POST['id'];
						$current_image=$_POST['current_image'];
						//$image_name=$_POST['image'];
						$title =$_POST['title'];
						$featured=$_POST['featured'];
						$active =$_POST['active'];
						
						//2. Updating new image is selsected 
						// check weather image is selected or not
						if(isset($_FILES['image']['name']))
						{
							//get the image details
							$image_name=$_FILES['image']['name'];
							//Check weather image is available or not
							if($image_name!="")
							{
						//image available
						//A.upload the new image
								
						// Get the extension of our image (jpg, png, gif, etc) e.g. food1.jpg
						$ext = end(explode('.',$image_name));
						
						// rename the image
						$image_name ="Food_Category_".rand(0000,9999).'.'.$ext; //e.g. Food_Category_00
						
						$source_path=$_FILES['image']['tmp_name'];
						$destination_path ="../image/category/".$image_name;
						
					// upload the image
					$upload =move_uploaded_file($source_path, $destination_path);
					
					// check whether the image is uploaded or not 
					// and if the image is not uploaded then we will stop the process and redial it with error message 
					if($upload == false )
					{
						// set message
						$_SESSION['upload'] = "Fail to upload the image";
						// redirect to add category Page
						header('location:'.SITEURL.'admin/ManageCategory.php');
						// stop the process
						die();
					}
				
								// B.remove the current image
								if($current_image!="")
								{
									$remove_path="../image/category/".$current_image;
								
								$remove=unlink($remove_path);
								
									// check weather the image is removed or not
									// if failed to remove then diesplay message and stop the processes 
									if($remove==false)
									{
										// failed to remove the image
										$_SESSION['failedToRemove'] ="<div class='error'> failed to remove the current image .</div>";
										header('location:'.SITEURL.'admin/ManageCategory.php');
										die();
									}
								}
								
							}
							else
							{
								$image_name =$current_image;
							}
		
						}
						else
						{
							$image_name =$current_image;
						}
						//3. Upadate the database
						$sql2="UPDATE tblcategory SET
						Title='$title',
						image_Name='$image_name',
						Featured ='$featured',
						Active='$active' 
						WHERE id=$id
						";
						//execute the query
						$res2=mysqli_query($conn,$sql2);  
						//4.Redirect ManageCategory with message 
						// check weather executed or not
						if($res2==ture)
						{
							//category updated
							$_SESSION['update'] ="<div class='success'> Category Updated successfully</div>";
							header('location:'.SITEURL.'admin/ManageCategory.php');
						}
						else
						{
							//fail to update category
							$_SESSION['update'] ="<div class='error'>Failed to update Category</div>";
							header('location:'.SITEURL.'admin/ManageCategory.php');
						}
						
					
					}
				?>
</div>

<?php
		include ('partials/footer.php');
		
	?>	