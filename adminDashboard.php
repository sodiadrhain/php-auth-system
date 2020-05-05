<?php include_once('lib/header.php'); 

if(!is_user_loggedIn()){
    // redirect to dashboard
    header("Location: login.php");
}

//checking user if its truly admin
if ($_SESSION['role'] != 'Admin') {
	if ($_SESSION['role'] == 'Medical Team (MT)') {
		header('Location: team.php');
		exit();
	} else {
		header('Location: patient.php');
		exit();	
	}
}
?>
<div class="dashboard"><h2>ADMIN DASHBOARD</h2>

Welcome, <?php echo $_SESSION['fullname'] ?>, You are logged in as (<?php echo $_SESSION['role'] ?>), and your ID is <?php echo $_SESSION['loggedIn'] ?>.

<?php
if ($_SESSION["role"] ==  "Admin") {
	$access_level = "Admin";
} elseif($_SESSION['role'] == "Medical Team (MT)"){
	$access_level = "Moderator";
}else {
	$access_level = "User";
}
?>
<br>
<br>
<a href="viewStaff.php">View all Staff</a> | <a href="viewPatients.php">View all Patients</a> | <a href="adminTransactions.php">View User Payments</a>
<br>
<br>
<b>User Access Level: </b> <?php echo $access_level; ?>
<br>
<b>Department: </b> <?php echo $_SESSION["department"]; ?>
<br>
<b>Date of Registration: </b> <?php echo $_SESSION["date_of_registration"]; ?>
<br>
<b>Date of Last Login: </b> <?php echo $_SESSION["login_time"]; ?>
</div>

<?php include_once('lib/footer.php'); ?>