<?php 
session_start();
require_once('functions/user.php'); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sodiadrhain Hospital</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
<body>

<header>
	<nav>

		<h1>Sodiadrhain Hospital</h1>
		<ul>           
			<li><a href="index.php">Home</a></li>
			|
			<?php if(!is_user_loggedIn()){ ?>
			<li><a href="login.php">Login</a></li>
			|
			<li><a href="register.php">Register</a></li>
            <?php } else{ if(isset($_SESSION["role"]) && $_SESSION["role"] == "Admin"){?>
			<li><a href="adminAddUser.php">Add a User</a></li>
			|
			<?php
            }?>
			<li><a href="resetPassword.php">Reset Password</a></li>
			|
			<li><a href="logout.php">Logout</a></li>
            <?php } ?>
		</ul>
	</nav>
</header>
