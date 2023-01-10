<?php
// include constant file
include('partials/menu.php');
?>

<?php
//echo "Delete Food page";

if(isset($_GET['id']) && isset($_GET['image_name']))
{
    // process to delete
   // echo "Process to Delete";
    $id =$_GET['id'];
    $image_name=$GET['image_name'];
	
	//remove the physical image file is available
	
	if($image_name !="")
	{
		//image is available so remove it
		$path="../image/FoodItem/".$image_name;
		// remove the image
		$remove =unlink($path);
		//if failed to remove image then add an error message and stop the process
		if ($remove==false)
		{
			//set the session message
			$_SESSION['upload']="<div class='error'> failed to remove category image.</div>";
			//redirect the manage Category page
			header('location:'.SITEURL.'admin/ManageFood1.php');
			// Stop the process
			die();
		}
	}
	
	// delete data from database 
	//sql query delete datea from database
	$sql ="DELETE FROM tblfood WHERE id=$id"; 
	//execute the query
	$res=mysqli_query($conn, $sql);
	//check weather the data sis delete from database or not
	if($res == true)
	{
		// see success message and redirect
		$_SESSION['delete']="<div class='success'> Food Item Deleted Successfully </div>";
		// redirect the message Category Page
		header('location:'.SITEURL.'admin/ManageFood1.php');
	}
	else
	{
		// see fail message and redirect 
		$_SESSION['delete']="<div class='error'> Failed to Delete Category </div>";
		// redirect the message Category Page
		header('location:'.SITEURL.'admin/ManageFood1.php');
	}
	// redirect to manage category page with message
}
else
{
    // redirect to ManageFood1 page
    //echo "redirect ";
    $_SESSION['delete']="<div class='error'> UnAuthorized access </div>";
    header('location:'.SITEURL.'admin/ManageFood1.php');
}

?>