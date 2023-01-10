<?php
include('partials/menu.php');
?>

<?php 
		// get the id of selected Admin
	$id = $_GET['id'];
	//create the sql query to get the details 
		$sql= "SELECT * FROM admin WHERE SN=$id";
		//execute the query 
		$res= mysqli_query($conn, $sql);
		
	//check weather query is executed or not 
		if($res == TRUE)
		{
			//check weather data is available or not 
			$count = mysqli_num_rows($res);
			// check weather we have admin data or not 
			if ($count ==1){
			  //get the details
			  $row=mysqli_fetch_assoc($res);
			  $full_Name  = $row['FullName'];
			  $username =$row['UserName'];
			  
		}
		else
		{
			//Redirect to ManageAdmin1 page
			header("location:".SITEURL.'admin/ManageAdmin1.php');
		}
		}
	if (isset($_POST['submit'])) 
	{
		//echo "button clicked";
		//get all the value from form to update
		echo $id =$_POST['id'];
		echo $full_Name =$_POST['UserFullName'];
		echo $username =$_POST['UserName'];
		//create sql query for update admin
		
		$sql = "UPDATE admin SET 
						FullName ='$full_Name',
						UserName ='$username'
				WHERE SN='$id'";
				
				//execute the query 
				$res =mysqli_query($conn , $sql );
				
			//check weather the query executed successfully or not 
				if($res ==TRUE )
				{
					//echo "query executed and upadate admin" ;
				// create session variable to display messages 
		$_SESSION['update'] ="Admin Updated succuessfully";
		// redirect messages to ManageAdmin Page 
		header("location:".SITEURL.'admin/ManageAdmin1.php');
				}
				else 
				{
					//echo "failed to update Admin";
			$_SESSION['update'] ="Failed to Delete Admin, Try Later";
			header("location:".SITEURL.'admin/ManageAdmin1.php');
				}
	}		
?> 
		
<div class="main-content">
		<div class="wrapper">
			<h1> Update Admin </h1>
			<form action="" method="post">
			<table class="tbl-45">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<tr>
					<td> Full Name: </td>
					<td> <input type="text" name="UserFullName" value ="<?php echo $full_Name; ?>">
				</tr>	
				
				<tr>
					<td> User Name: </td>
					<td> <input type="text" name="UserName" value="<?php echo $username; ?>">
				</tr>	
				
				
				<tr colspan="2">
					<td> <input type="submit" name="submit" value="UpdateAdmin" class="btn-secondary"> </td>
				</tr>
			</table>		
			</form>
		</div>
</div>



<?php
include('partials/footer.php');
?>