<?php
include('partials/menu.php');
 //echo "add food page";
?>
<div class="main-content">
		<div class="wrapper">
			<h1> Add Food </h1>
			
		<br>
		<br>
		<?php
		 if(isset($_SESSION['upload']))
			{
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);
			}
			
			 if(isset($_SESSION['add']))
			{
				echo $_SESSION['add'];
				unset($_SESSION['add']);
			}
			?>
		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-45">
				<tr>
				<td> Title </td>
				<td> 
					<input type="text" name="title" placeholder="Title of the Food">
				</td>
				</tr>
				
				<tr>
				<td> Description </td>
				<td> 
					<Textarea name="description" rows="10" cols="30" placeholder="description of Food"> </Textarea>
				</td>
				</tr>
				
				<tr>
				<td> Price </td>
				<td> 
					<input type="number" name="price">
				</td>
				</tr>
				
				<tr>
				<td> Select Image: </td>
				<td> 
					<input type="file" name="image">
				</td>
				</tr>
				
				<tr>
				<td> Category: </td>
				<td> 
					<select name="category">
						<?php 
						// create php code to display categories from database
						
					//1.Create SQL to get all active categories from the database 
					$sql ="SELECT * FROM tblcategory WHERE Active='yes'";
					$res = mysqli_query($conn, $sql);
					//count rows to check weather we have categories or not
					$count= mysqli_num_rows($res);
					
					// if count is greater than zero , we have categories else we dont have categories
					if($count>0)
					{
						// we  have categories to display
						while($row=mysqli_fetch_assoc($res))
						{
							//get the details of categories 
							$id=$row['id'];
							$title=$row['Title'];
							?>
								<option value="<?php echo $id; ?>"><?php echo $title; ?></option>
							<?php
							
						}
					}
					else
					{
						//we dont have categories to display
								
						?>
							<option value="0"> No Category Found </option>
						<?php
					}
						
						?>
						
					</select>
				</td>
				</tr>
				
				<tr>
					<td> Featured: </td>
					<td> 
					<input type="radio" name="featured" value="yes">YES
					<input type="radio" name="featured" value="no">NO
					</td>
				</tr>	
				
				<tr>
					<td> Active: </td>
					<td> 
					<input type="radio" name="Active" value="yes">YES
					<input type="radio" name="Active" value="no">NO
					</td>
				</tr>

				<tr>
				<td colspan="2">

						<input type="submit" name="submit" value="AddFood" class="btn-secondary">
				</td>
			
				</tr>	
			</table>
		
		</form>
				<?php
					// check weather button is clicked or not
					if(isset($_POST['submit']))
					{
						// Add food items in to database
						//echo "clicked";
						//1.Get the data from form
						$title =$_POST['title'];
						$description=$_POST['description'];
						$price =$_POST['price'];
						$category =$_POST['category'];
						//check weather radio buttons for fetured and active is checked or not
						if(['featured']==!null)
						{
							$featured =$_POST['featured'];
						}
						else
						{
							$featured ="No"; //setting the default value
						}
						
						if(['Active']==!null)
						{
							$active =$_POST['Active'];
						}
						else
						{
							$active ="No"; //setting the default value
						}
						//2.Upload the image
						//check weather selected image is clicked or not and upload the image only if the image is selected
						if(isset($_FILES['image']['name']))
						{
							//get the details of the selected image 
							$image_name=$_FILES['image']['name'];
							//check wheather the image is selected or not upload the image only if selected
							if($image_name!="")
							{
								//auto rename our Image
							// Get the extension of our image (jpg, png, gif, etc) e.g. food1.jpg
								$ext = end(explode('.',$image_name));
						
								// rename the image
									$image_name ="Food_Item_".rand(0000,9999).'.'.$ext; //e.g. Food_Item_00
						
									$src_path=$_FILES['image']['tmp_name'];
									$dst_path ="../image/FoodItem/".$image_name;
						
								// upload the image
									$upload =move_uploaded_file($src_path, $dst_path);
					
								// check whether the image is uploaded or not 
								// and if the image is not uploaded then we will stop the process and redial it with error message 
								if($upload==false )
								{
										// failed to upload the image
										$_SESSION['upload'] = "<div class='error'>Fail to upload the image</div>";
										// redirect to add category Page
										header('location:'.SITEURL.'admin/addFood.php');
										// stop the process
										die();
								}	
							}
							
						}
						else
						{
							$image_name=""; //setting default value as blank
						}
						
						//3.Insert data in to database
						//Create sql query to save or add food
					$sql2="INSERT INTO tblfood(Title,Description,Price,imageName,CategoryId,Featurerd,Active) VALUES('$title','$description',$price,'$image_name','$category','$featured','$active')";
						/*$sql2="INSERT INTO tbl_fooditem SET
						Title ='$title',
						Description='$description',
						Price=$price,
						imageName='$image_name',
						CategoryId='$category',
						Featured='$Featured',
						Active='$active'
						";
						*/
						//3.execute the query and save in data base;
						$res2 = mysqli_query($conn,$sql2);
						//4.Redirect with message to Manage Food page
						
						if($res2==true)
						{
						//Query executed and Food Item added 
							$_SESSION['add'] ="<div class='success'>Food Item Added successfully</div>";
							header('location:'.SITEURL.'admin/ManageFood1.php');
						}
						else
						{
							//Fail to Add Query
							$_SESSION['add'] ="<div class='error'>Fail to Add Food Item</div>";
							header('location:'.SITEURL.'admin/addFood.php');
						}
					}
				
				?>
		
		</div>
</div>
<?php
include ('partials/footer.php');
?>