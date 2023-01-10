<?php
include('partials/menu.php');
?>

<div class="main-content">
		<div class="wrapper">
			<h1> Add Admin </h1>
			</div>
			<form action="" method="POST">
			<table class="tbl-45">
				<tr>
					<td> Full Name: </td>
					<td> <input type="text" name="UserFullName" placeholder="Add your full name boss">
				</tr>	
				
				<tr>
					<td> User Name: </td>
					<td> <input type="text" name="UserName" placeholder="Type a suitble Username">
				</tr>	
				
				<tr>
					<td> Password: </td>
					<td> <input type="Password" name="password" placeholder="Type a suitble Password">
				</tr>
				<tr colspan="2">
					<td> <input type="submit" name="submit" value="Add Admin" class="btn-secondary"> </td>
				</tr>
			</table>		
			</form>
	</div>		
			<br> <br>
			
			
<?php
include('partials/footer.php');
?>

<?php
	//process in the value of form and save it in the data base64_decode
	//check weather that AddAdmin button is worked or not 
	
if(isset($_POST['submit'])){
	//butt is clicked
//1.get data from the form
	$UserFullName = $_POST['UserFullName'];
	$UserName = $_POST['UserName'];
	$Password = md5($_POST['password']); //password encription with md5

//2.sql query to save data in to database
	//$sql = "INSERT INTO admin SET 
		//FullName ='$Fullname',
		//UserName ='$UserName',
		//Password = '$Password'
	//";
	$sql = "INSERT INTO admin(`FullName`, `UserName`, `Password`) VALUES ('$UserFullName','$UserName','$Password')";
	echo $sql;
//3.Execute Query and save data in database 
	
	 $res= mysqli_query($conn,$sql);
	
//4.chcek weather query is excuted and data is updated or not and display appropriate message

		if($res ==TRUE) {
			//echo nl2br("data is inserted");
			//create session variable to display message 
			$_SESSION['add']="Admin Added Successfully";
			//redirect page admin to AddAdmin
			header("location:".SITEURL.'admin/ManageAdmin1.php');
			
		}
		else{
			//echo nl2br("fail to insert data");
			//create session variable to display message 
			$_SESSION['add']="Fail to Add Admin";
			//redirect page admin to AddAdmin
			header("location:".SITEURL.'admin/ManageAdmin1.php');
		}
	
}
echo "location:".SITEURL.'admin/AddAdmin.php';
?>