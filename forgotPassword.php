<?php 
include_once('lib/header.php');  
require_once('functions/alert.php'); 
?>
<form method="POST" action="processForgotPassword.php" class="form">
		<h2>FORGOT PASSWORD</h2>
        <p>Kindly enter the email address you used to regiter your account below</p>
		<?php  print_alert(); ?>
		<div>
			<input <?php              
                    if(isset($_SESSION['email'])){
                        echo "value=" . $_SESSION['email'];                                                             
                    }                
                ?> type="text" name="email" placeholder="Email Address" required />
		</div>
		<br>
		<button type="submit" class="button-submit">Send Reset Code</button>
	</form>

<?php include_once('lib/footer.php'); ?>