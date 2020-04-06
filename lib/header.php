<?php session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>PHP Authentication System</title>
</head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<body>

<header>
	<nav>

		<h1>Sodiadrhain Hospital</h1>
		<ul>           
			<li><a href="index.php">Home</a></li>
			|
			<?php if(!isset($_SESSION['loggedIn'])){ ?>
			<li><a href="login.php">Login</a></li>
			|
			<li><a href="register.php">Register</a></li>
            <?php } else{ if(isset($_SESSION["role"]) && $_SESSION["role"] == "Admin"){?>
			<li><a href="addUser.php">Add a User</a></li>
			|
			<?php
            }?>
			<li><a href="logout.php">Logout</a></li>
            <?php } ?>
		</ul>
	</nav>
</header>
