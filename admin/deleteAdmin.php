
<?php

include ('../config/constant.php');
//get the admin Id to be deleted 
 echo $id= $_GET['id'];
 
 // create sql query to delete admin
	$sql ="DELETE FROM admin WHERE SN=$id"; 
// execute the query	
	$res= mysqli_query($conn, $sql);

// check weather the query executed successfully or not

	if($res==TRUE)
	{
		//echo "Admin deleted";
		// create session variable to display messages 
		$_SESSION['delete'] ="Admin Deleted succuessfully";
		// redirect messages to ManageAdmin Page 
		header("location:".SITEURL.'admin/ManageAdmin1.php');
		}
		else
	{
		//echo "fail to deleter";
		$_SESSION['delete'] ="Failed to Delete Admin, Try Later";
		header("location:".SITEURL.'admin/ManageAdmin1.php');
		
	}