<?php 
 include_once('lib/header.php'); 
 require_once('functions/alert.php');

if(!is_user_loggedIn()){

    header("Location: login.php");
}

?>
<div class="dashboard">
		<h2>BOOK APPOINTMENT FORM</h2>
            
            <?php   
                print_alert();
            ?>
            <br>

        <a href="patientDashboard.php">Goto your Dashboard</a>
</div>
<?php 
include_once('lib/footer.php'); 
?>