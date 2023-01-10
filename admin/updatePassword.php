<?php
include('partials/menu.php');
?>

<?php
if (isset($_GET['id']))
{
	$id = $_GET['id'];
}
?>

<div class="main-content">
		<div class="wrapper">
			<h1> Change Password  </h1>
			<form action="" method="post">
			<table class="tbl-45">
				
				<tr>
					<td> Current Password </td>
					<td> <input type="text" name="current_password" placeholder="type your current password"> </td>
				</tr>	
				
				<tr>
					<td> new Password  </td>
					<td> <input type="text" name="new_password" placeholder="type your new password"> </td>
				</tr>	
				<tr>
					<td> Confirm Password  </td>
					<td> <input type="text" name="confirm_password" placeholder="type your new password again"> </td>
				</tr>
				
				<tr colspan="2">
					 <input type="hidden" name="id" value="<?php echo $id; ?>"> 
					<td> <input type="submit" name="submit" value="Change Password" class="btn-secondary"> </td>
				</tr>
			</table>		
			</form>
		</div>
</div>


<?php
//check weather submit button is clicked or not
	if (isset($_POST['submit']))
	{
		
		echo "clicked";
		//1.get the data from Form
		
	$id= $_POST['id'];
	$current_password =md5($_POST['current_password']);
	$new_password =md5($_POST['new_password']);
	$confirm_password =md5($_POST['confirm_password']);
	
	//2.check weather the user with current ID and current password exist or not
	$sql ="SELECT * FROM admin WHERE SN='$id' AND Password='$current_password' " ;
	
	//execute the query
	$res = mysqli_query($conn ,$sql);
	
	if($res==true) 
	{
		//check weather data is available or not 
			$count =mysqli_num_rows($res);
		if($count==1)
		{
			//user exist and password can be changed 
			//echo "user found";
			//check weather new_password and confirm_password is matched or not 
			if($new_password == $confirm_password) 
			{
				//echo "update the password";
				$sql2 = "UPDATE admin SET 
							Password = '$new_password'
							WHERE SN ='$id'";
							
				//execute the query 
				$res2 =mysqli_query($conn , $sql2);
				
				// check weather query is executed or not 
				if($res2 == TRUE)
				{
					// display update is sucess 	
					//redirect the manageAdmin1 with errro message 
					$_SESSION['changed_pwd']="<div class='success'> Password Changed successfully </div>";
					//Redirect the user 
					header("location:".SITEURL.'admin/ManageAdmin1.php');
				}
				else
				{
					// display error message
					//redirect the manageAdmin1 with errro message 
						$_SESSION['changed_pwd']="<div class='error'> Failed to changed Password </div>";
					//Redirect the user 
					header("location:".SITEURL.'admin/ManageAdmin1.php');					
				}
			}
			else
			{
				//redirect the manageAdmin1 with errro message 
				$_SESSION['pwrd_not_match']="<div class='error'> Password Did not Match </div>";
				//Redirect the user 
				header("location:".SITEURL.'admin/ManageAdmin1.php');
			}
		}
		else 
			{
			//user does not exist and set the message and reload 
				$_SESSION['user_not_found']="<div class='error'> User Not Found </div>";
				header("location:".SITEURL.'admin/ManageAdmin1.php');
			}
		
		}
	}
	


?>


<?php
include('partials/footer.php');
?>