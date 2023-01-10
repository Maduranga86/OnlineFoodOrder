<?php 
include('partials/menu.php');
//echo "list updated";
?>
<?php
// check weather id is set or not
?>
<div class="main-content">
		<div class="wrapper">
			<h1> Update Food Item</h1>
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
				$sql1 ="SELECT * FROM tblfood WHERE id=$id";
				//execute the query
				$res1 =mysqli_query($conn,$sql1);
				
				//count the rows and check weather the id is valid or not
				$count =  mysqli_num_rows($res1);
				
				if($count==1)
				{
					// get all the data
					$row = mysqli_fetch_assoc($res1);
					$title=$row['Title'];
                    $description = $row['Description'];
                    $price =$row['Price'];
					$current_image=$row['imageName'];
					$current_category=$row['CategoryId'];
					$featured=$row['Featurerd'];
					$active=$row['Active'];
				}
				else
				{
					//redirect to manage Category with session message 
					$_SESSION['noFoodFound']= "<div class='error'>Food Item is not Found.</div>";
					header('Location:'.SITEURL.'admin/ManageFood1.php');
				}
			}
			else 
			{
				// Redirect the Manage Category
				header('location:'.SITEURL.'admin/ManageFood1.php');
			}
			?>
			<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-45">
				<tr>
					<td> Title: </td>
					<td> <input type="text" name="title" placeholder="Food Name" value="<?php echo $title; ?>"></td>
				</tr>	
				<tr>
                <tr>
					<td> Description : </td>
					<td> <textarea name="description" cols="30" rows="5" value=""> <?php echo $description; ?></textarea> </td>
				</tr>	
                <tr>
					<td> Price: </td>
					<td> <input type="number" name="price" value="<?php echo $price; ?>"> </td>
				</tr>	
				<tr>
						<td>current Image:</td>
						<td> 
						<?php 
							if($current_image!="")
							{
								?>
								<img src="<?php echo SITEURL; ?>image/foodItem/<?php echo $current_image; ?>" width="150px" height="100px"> 
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
					<td> Category: </td>
					<td> 
                        <select name="category">
                            <?php
                            //Query to get Active Cateogories
                            $sql="SELECT * FROM tblcategory WHERE Active='Yes'";
                            //Execute the query
                            $res=mysqli_query($conn,$sql);
                            //count rows
                            $count=mysqli_num_rows($res);
                            //Check weather category is available or not
                            if($count>0)
                            {
                                //category Available
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $category_title=$row['Title'];
                                    $category_id=$row['id'];
                                   // echo "<option value='$category_id'> $category_title</option> ";
                                   ?>
                                   <option <?php if($current_category==$category_id){echo "Selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?><option>
                                   <?php
                                }
                            }
                            else
                            {
                                //category does not available
                                echo "<option> Category is Not Available </option>";
                            }
                            ?>
                           
                        </select>
                    </td>
				</tr>	
				<tr>
						<td>New Image:</td>
						<td> <input type="file" name="image1"></td>
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
					<input <?php if($active=="yes"){echo "checked";} ?> type="radio" name="active" value="yes"> Yes
					<input <?php if($active=="no"){echo "checked";} ?> type="radio" name="active" value="no"> No
				</td>
				</tr>
				<tr>
				<td colspan="2">
					<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<input type="submit" name="submit" value="Update Food"  class="btn-secondary"> </td>
				</tr>
			</table>
				</form>
				
				<?php 
					if(isset($_POST['submit']))
					{
						//echo "clicked";
						//1.get all the values from our form
						$id= $_POST['id'];
						$current_image = $_POST['current_image'];
						$description = $_POST['description'];
						$price = $_POST['price'];
						$title =$_POST['title'];
						$category=$_POST['category'];
						$featured=$_POST['featured'];
						$active =$_POST['active'];

						//2. Updating new image is selsected 
						// check weather image is selected or not
						if(isset($_FILES['image1']['name']))
						{
							//upload button is clicked
							$image_name = $_FILES['image1']['name'];
							//Check weather image is available or not
							if($image_name != "")
							{
								//image available
								// rename the image
								$ext = end(explode($image_name));
								$image_name ="FoodItem_".rand(0000,9999).'.'.$ext; //e.g. FoodItem_00
									
								//get the source path and Destination path
								$source_path=$_FILES['image1']['tmp_name'];// Source Path
								$destination_path ="../image/FoodItem/".$image_name; 
								//upload the image
								$upload =move_uploaded_file($source_path, $destination_path);
								//check weather the image is uploaded or not
								if($upload == false )
								{
									//failed to upload
									$_SESSION['upload'] = "<div class='error'>Fail to upload the image</div>";
									// redirect to add category Page
									header('location:'.SITEURL.'admin/ManageFood1.php');
									// stop the process
									die();
								}
									//3.remove the image if new image is uploaded and current image exsists
									// B.remove the current image
								if($current_image!="")
								{
									//current image is available
									//remove the image
									$remove_path="../image/FoodItem/".$current_image;
									$remove=unlink($remove_path);
									// check weather the image is removed or not
									if($remove==false)
									{
										// failed to remove the image
										$_SESSION['failedToRemove'] ="<div class='error'> failed to remove the current image .</div>";
										header('location:'.SITEURL.'admin/ManageFood1.php');
										die();
									}

								}
							}
							else{
								$image_name =$current_image;
							}
						}
						else
						{
							$image_name =$current_image;
						}
						//4. Upadate the food in  database
						$sql2 ="UPDATE tblfood SET
						Title ='$title',
						Description ='$description',
						Price =$price,
						imageName ='$image_name',
						CategoryId ='$category',
						Featurerd ='$featured',
						Active ='$active' 
						WHERE id=$id
						";
						//execute the query
						$res2=mysqli_query($conn,$sql2);
						// check weather executed or not
						if($res2==ture)
						{
							//category updated
							$_SESSION['update2'] ="<div class='success'> Food Item Updated successfully</div>";
							header('location:'.SITEURL.'admin/ManageFood1.php');
						}
						else
						{
							//fail to update category
							$_SESSION['update2'] ="<div class='error'>Failed to update Food Item</div>";
							header('location:'.SITEURL.'admin/ManageFood1.php');
						}

					}	
						
					
				?>
</div>
				</div>

<?php
		include ('partials/footer.php');
		
	?>	