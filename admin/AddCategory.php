<?php
include('partials/menu.php');
?>

<div class="main-content">
		<div class="wrapper">
			<h1> Add Category </h1>
			</div>
			<br><br>
			<?php
			
			if(isset($_SESSION['add']))
			{
				echo $_SESSION['add'];
				unset($_SESSION['add']);
			}
			
			if(isset($_SESSION['upload']))
			{
				echo $_SESSION['upload'];
				unset($_SESSION['upload']);
			}
			
			
			?>
			<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-45">
				<tr>
					<td> Title: </td>
					<td> <input type="text" name="title" placeholder="Category Title"></td>
				</tr>	
				<tr>
						<td> Select Image:</td>
						<td> <input type="file" Name="image"> </td>
				</tr>
				<tr>
					<td> Featured: </td>
					<td> <input type="radio" name="featured" value="yes">YES
					<input type="radio" name="featured" value="no">NO</td>
				</tr>	
				
				<tr>
					<td> Active:</td>
					<td> <input type="radio" name="active" value="Yes">YES
					<input type="radio" name="active" value="No">NO </td>
				</tr>
				<tr>
				<td colspan="2">
					<input type="submit" name="AddCategory"  class="btn-secondary"> </td>
				</tr>
			</table>		
			</form>
			<?php 
			if(isset($_POST['AddCategory']))
			{
				//echo "Button clicked";
				// 1. get the value from Category Form
				$title =$_POST['title'];
				// for Radio input, we need to chek wether the button is selected or not
				if(isset($_POST['featured']))
					{
						// get the value from form
						$featured =$_POST['featured'];
					}
				else
				{
					//Set the default value
					$featured ="No";
				}
				if(isset($_POST['active']))
				{
					$active =$_POST['active'];
				}
				else
				{
					$active ="No";
				}
			// check weather the image is selected or not and set the value for image name accordingly
					//print_r($_FILES['image']);
					//die(); // break the code
					
			if(isset($_FILES['image']['name']))
			{
				// upload the image
					// to upload the image we need image name, source path and destination path
					$image_name=$_FILES['image']['name'];
					//upload the iae only if image is selected
				if($image_name !="")
				{
						
						//auto rename our Image
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
						header('location:'.SITEURL.'admin/AddCategory.php');
						// stop the process
						die();
					}
				}
			}
			else {
				//dont upload image and set the image name value as blank
				$image_name="";
			}
				//2.Create SQL QUERY to insert category in to database
				$sql = "INSERT INTO tblcategory (Title,image_Name,Featured,Active) VALUES ('$title','$image_name', '$featured', '$active')";
				echo $sql;
				//3.execute the query and save in data base;
				$res = mysqli_query($conn,$sql);
				//4.Checked weather the query executed or not and data added or not
				if($res == TRUE)
				{
					//Query executed and Category added 
					$_SESSION['add'] ="Category Added successfully";
					header('location:'.SITEURL.'admin/ManageCategory.php');
				}
				else
				{
					//Fail to Add Query
					$_SESSION['add'] ="Fail to Add Category";
					header('location:'.SITEURL.'admin/AddCategory.php');
				}
			}
			?>
	</div>		
			<br> <br>
			



<?php
		include ('partials/footer.php');
		
	?>	