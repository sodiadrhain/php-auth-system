<?php include_once('lib/header.php');
 require_once('functions/alert.php');
 if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])){
    header("location: dashboard.php");
}

 ?>

	<form method="post" action="processLogin.php" class="form">
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
	</form>

<?php include_once('lib/footer.php'); ?>