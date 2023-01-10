<?php
include('../config/constant.php');
?>
<html>
<head>
	<title> Login -Food Order System </title> 
	<link rel="stylesheet" href="../css/admin.css">
</head>
<body>
	<div class="login">
		<h1 class="text-center"> Login to the system </h1>
	<!-- login form start here -->
		<br>
		<?php
		
				if(isset($_SESSION['login']))
				{
					echo $_SESSION['login'];
					unset($_SESSION['login']);
					
				}
				
				if (isset($_SESSION['no-login-messege']))
				{
					echo $_SESSION['no-login-messege'];
					unset($_SESSION['no-login-messege']);
					
				}
		?>
		<form action="" method="POST" class="text-center">
		User Name:
		<input type ="text" name="username" placeholder="Insert User Name here">
		<br>
		<br>
		Password :
		<input type ="password" name="password" placeholder="Insert Password here">
		<br><br>
		<input type="submit"  name="btnLogin" value="login" class="btn-primery">
		</form> 
		<br> <br>
		<p class="text-center"> Product of Ranga Solutions </p>
	</div>
	
</head>
</html>

<?php

//check weather submit button is clicked or not 
if(isset($_POST['btnLogin']))
{
	//process of the login
	//1.get the data from login form
	$userName=$_POST['username'];
	$Password=md5($_POST['password']);

	//2.SQL to check weather username and password is exist 
	$sql="SELECT * FROM admin WHERE UserName='$userName' AND Password='$Password'";
	//3.execute the query
	$res=mysqli_query($conn,$sql);
		
//4.count rows to check weather user is exist or not		
	$count=mysqli_num_rows($res);
	
		if($count==1) 
		{
		//login is success and 
		$_SESSION['login']="<div class='success'> Successfully login to the page </div>";
		$_SESSION['user'] =$userName; //to check weather user is loggedin or logout will unset it
		//Redirect the user 
		header('location:'.SITEURL.'admin/');	
		}
		else
		{
		// fail to login 
		$_SESSION['login']="<div class='error'> User Name or password incorrect </div>";
		//Redirect the user 
		header('location:'.SITEURL.'admin/loginUI.php');	
		}
}
?>