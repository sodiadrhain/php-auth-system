<?php include_once('lib/header.php');
 require_once('functions/alert.php');
 if ($_SESSION["role"] == "Admin") {
 ?>
 	<form method="post" action="processAddUser.php" class="form">
		<h2>ADD A USER</h2>
		<p>All fields are required!!!</p>
            <?php   
            if (isset($_SESSION["message"])) {
            	echo "<div class='alert alert-info' role='alert'>" . $_SESSION["message"] .
                    "</div>"; 
            }
            ?>
		<div>
			<label for="first_name">User First Name:</label>
			<br>
			<input type="text" name="first_name" placeholder="First Name" />
		</div>
		<br>
		<div>
			<label for="last_name">User Last Name:</label>
			<br>
			<input type="text" name="last_name" placeholder="Last Name" />
		</div>
		<br>
		<div>
			<label for="email">User Email Address:</label>
			<br>
			<input type="text" name="email" placeholder="Email Address" />
		</div>
		<br>
		<div>
			<label for="password">User Password:</label>
			<br>
			<input type="password" name="password" placeholder="Password" />
		</div>
		<br>
		<div>
			<label for="gender">User Gender:</label>
			<br>
			<select name="gender">
				<option value="">
					Select
				</option>
				<option>
					Male
				</option>
				<option>
					Female
				</option>
			</select>
		</div>
		<br>
		<div>
			<label for="designation">User Designation:</label>
			<br>
			<select name="designation">
				<option value="">Select</option>
				<option>
					Medical Team (MT)
				</option>
				<option>
					Patient
				</option>
			</select>
		</div>
		<br>
		<div>
			<label for="department">User Department:</label>
			<br>
			<input type="text" name="department" placeholder="Department" />
		</div>
		<br>
		<button type="submit" class="button-submit">Add User</button>
	</form>
<?php 
 } else {
 ?>
 	<h2 style='text-align: center;'>You Do not have permission to use this page</h2>
	
<?php 
}
include_once('lib/footer.php'); ?>