<?php include_once('lib/header.php');
 require_once('functions/alert.php');
 if(is_user_loggedIn()){
        		if (($_SESSION['role']) == 'Admin') {
              		header("Location: adminDashboard.php");
              	} elseif (($_SESSION['role']) == 'Medical Team (MT)') {
              		header("Location: teamDashboard.php");
              	} else {
              		header("Location: patientDashboard.php");
              	}
}


 ?>

	<form method="POST" action="processLogin.php" class="form">
		<h2>LOGIN</h2>
		<?php  print_alert(); ?>
		<div>
			<label for="email">Email Address:</label>
			<br>
			<input <?php              
                    if(isset($_SESSION['email'])){
                        echo "value=" . $_SESSION['email'];                                                             
                    }                
                ?> type="text" name="email" placeholder="Email Address" required />
		</div>
		<br>
		<div>
			<label for="password">Password:</label>
			<br>
			<input type="password" name="password" placeholder="Password" required />
		</div>
		<br>
		<button type="submit" class="button-submit">Login</button>
		<br>
		<br>
		Forgot Password? <a href="forgotPassword.php">Click here</a>
		<br>
		Don't have an account? <a href="register.php">Register</a>
	</form>

<?php include_once('lib/footer.php'); ?>