<?php include_once('lib/header.php');
 require_once('functions/alert.php');
 if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])){
    header("location: dashboard.php");
}
 ?>

	<form method="post" action="processRegister.php" class="form">
		<h2>REGISTER</h2>
		<p>All fields are required!!!</p>
            <?php  print_alert(); ?>
		<div>
			<label for="first_name">First Name:</label>
			<br>
			<input <?php              
                    if(isset($_SESSION['first_name'])){
                        echo "value=" . $_SESSION['first_name'];                                                             
                    }                
                ?> type="text" name="first_name" placeholder="First Name" />
		</div>
		<br>
		<div>
			<label for="last_name">Last Name:</label>
			<br>
			<input <?php              
                    if(isset($_SESSION['last_name'])){
                        echo "value=" . $_SESSION['last_name'];                                                             
                    }                
                ?> type="text" name="last_name" placeholder="Last Name" />
		</div>
		<br>
		<div>
			<label for="email">Email Address:</label>
			<br>
			<input <?php              
                    if(isset($_SESSION['email'])){
                        echo "value=" . $_SESSION['email'];                                                             
                    }                
                ?> type="text" name="email" placeholder="Email Address" />
		</div>
		<br>
		<div>
			<label for="password">Password:</label>
			<br>
			<input type="password" name="password" placeholder="Password" />
		</div>
		<br>
		<div>
			<label for="gender">Gender:</label>
			<br>
			<select name="gender">
			 <?php              
                    if(isset($_SESSION['gender'])){
                        echo "value=" . $_SESSION['gender'];                                                             
                    }                
                ?>
				<option value="">
					Select
				</option>
				<option                     
				<?php              
                        if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Male'){
                            echo "selected";                                                           
                        }                
                    ?>>
					Male
				</option>
				<option
				 <?php              
                        if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Female'){
                            echo "selected";                                                           
                        }                
                    ?> >
					Female
				</option>
			</select>
		</div>
		<br>
		<div>
			<label for="designation">Designation:</label>
			<br>
			<select name="designation">
				<option value="">Select</option>
				<option                     
				<?php              
                        if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Medical Team (MT)'){
                            echo "selected";                                                           
                        }                
                    ?>>
					Medical Team (MT)
				</option>
				<option                     
				<?php              
                        if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'Patient'){
                            echo "selected";                                                           
                        }                
                    ?>>
					Patient
				</option>
			</select>
		</div>
		<br>
		<div>
			<label for="department">Department:</label>
			<br>
			<input <?php              
                    if(isset($_SESSION['department'])){
                        echo "value=" . $_SESSION['department'];                                                             
                    }                
                ?> type="text" name="department" placeholder="Department" />
		</div>
		<br>
		<button type="submit" class="button-submit">Register</button>
	</form>

<?php include_once('lib/footer.php'); ?>