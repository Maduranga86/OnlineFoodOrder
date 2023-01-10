<?php
// include constant file
include('partials/menu.php');

?>

<?php 
 echo "Page Deleted";

//check weather id and image_name value is set or not

if(isset($_GET['id']) AND isset($_GET['image_name']))
{
	// get the value and delete it
	//echo "get value and delete it";
	
	$id =$_GET['id'];
	$image_name=$GET['image_name'];
	
	//remove the physical image file is available
	
	if($image_name !="")
	{
		//image is available so remove it
		$path="../image/category/".$image_name;
		// remove the image
		$remove =unlink($path);
		//if failed to remove image then add an error message and stop the process
		if ($remove==false)
		{
			//set the session message
			$_SESSION['remove']="<div class='error'> failed to remove category image.</div>";
			//redirect the manage Category page
			header('location:'.SITEURL.'admin/ManageCategory.php');
			// Stop the process
			die();
		}
	}
	
	// delete data from database 
	//sql query delete datea from database
	$sql ="DELETE FROM tblcategory WHERE id=$id"; 
	//execute the query
	$res=mysqli_query($conn, $sql);
	//check weather the data sis delete from database or not
	if($res == true)
	{
		// see success message and redirect
		$_SESSION['delete']="<div class='success'> Category Deleted Successfully </div>";
		// redirect the message Category Page
		header('location:'.SITEURL.'admin/ManageCategory.php');
	}
	else
	{
		// see fail message and redirect 
		$_SESSION['delete']="<div class='error'> Failed to Delete Category </div>";
		// redirect the message Category Page
		header('location:'.SITEURL.'admin/ManageCategory.php');
	}
	// redirect to manage category page with message
}
else{
	// redirect the message Category Page
	header('location:'.SITEURL.'admin/ManageCategory.php');
	
	}

?>





