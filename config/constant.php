<?php

	session_start();
	define('SITEURL','http://localhost/MyFood/');
	define('LOCALHOST','localhost');
	define('DB_USERNAME' ,'root');
	define('DB_PASSWORD' ,'');
	define('DB_NAME','foodorder');
	
	

	//$res= mysqli_query($conn,$sql);
	$conn =mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error()); //data base connection 
	$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //select the conection 

?>