<?php 
// include the constant.php for SITEURL
	include('../config/constant.php');
	//1.Destroy the session
	session_destroy();
	//2.redirect to login page
	header('location:'.SITEURL.'admin/loginUI.php');

?>