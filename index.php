<?php include_once('lib/header.php'); 
if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])){
    header("location: dashboard.php");
}

?>
<p class="index-text-bg">
	Welcome to Sodiadrhain Hospital
</p>
	<br>
	<p class="index-text-sm">
		This hospital is built based on Start.NG PHP second task.
	</p>
	<p class="index-text-sm">
		Be sure to get the best of whatever you ask for here.
	</p>
<div class="index-button">
	<a href="login.php"><button class="button-black">Login</button></a>
	<a href="register.php"><button class="button-blue">Register</button></a>
</div>
<?php include_once('lib/footer.php'); ?>