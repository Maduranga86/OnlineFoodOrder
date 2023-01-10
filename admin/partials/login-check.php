
<?php 
	//authorization-access control
	// checked weather user is logged in or not 
	if(!isset($_SESSION['user']))
	{
		$_SESSION['no-login-messege']="<div class='error text-center'>Please Login to access to Admin Panel</div>";
		//Redirect to loginUI.php  page
		header('location:'.SITEURL.'admin/loginUI.php');
	}


?>