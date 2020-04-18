<?php 
    include_once('lib/header.php'); 
    require_once('functions/alert.php');
    require_once('functions/user.php');

    //check if user can view page

if(!is_user_loggedIn() && !is_token_set()){
    set_alert('error',"You are not allowed to view that page");
    header("Location: login.php");
} 

else {

?>

	<form method="POST" action="processResetPassword.php" class="form">
		<h2>RESET PASSWORD</h2>
        <p>Enter your details below</p>
		<?php  print_alert(); ?>
		<div>
            <?php if(!is_user_loggedIn()) { ?>
    <input
            
            <?php              
                if(is_token_set_in_session()){
                    echo "value='" . $_SESSION['token'] . "'";                                                             
                }else{
                    echo "value='" . $_GET['token'] . "'";
                }             
            ?>

           type="hidden" name="token"  />
    <?php } ?>
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
			<label for="password">Enter Your New Password:</label>
			<br>
			<input type="password" name="password" placeholder="Password" required />
		</div>
		<br>
		<button type="submit" class="button-submit">Reset Password</button>
	</form>
    
<?php 
}

include_once('lib/footer.php'); 

?>