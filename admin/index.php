<?php

include('partials/menu.php');

?>


		<!-- menu section Start-->
	
		<!-- menu section End-->
		
		<!-- main content section Start-->
	<div class="main-content">
		<div class="wrapper">
			<div class="text-center"><strong> DASH BOARD </strong></div>
			<?php
			if(isset($_SESSION['login']))
				{
					echo $_SESSION['login']; //display session message
					unset($_SESSION['login']);//removing session message 
				}

			?>
			<div class="col-4 text-center">
			<h1>5</h1>
			Catogary
			</div>
			<div class="col-4 text-center">
			<h1>4</h1>
			Catogary
			</div>
			<div class="col-4 text-center">
			<h1>3</h1>
			Catogary
			</div>
			<div class="col-4 text-center">
			<h1>2</h1>
			Catogary
			</div>
			<div class="col-4 text-center">
			<h1>1</h1>
			Catogary
			</div>
			<div class="clearfix"> </div>
		</div>
		
	</div>
		<!-- main content section end-->
	<br>	
		<br>	
	<br>	
		<!-- footer section Start-->
	<?php
		include ('partials/footer.php');
		
	?>	