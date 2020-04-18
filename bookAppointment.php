<?php 
 include_once('lib/header.php'); 
 require_once('functions/alert.php');

if(!is_user_loggedIn()){

    header("Location: login.php");
}

?>

	<form method="POST" action="processBookAppointment.php" class="form">
		<h2>BOOK APPOINTMENT FORM</h2>
		<p>NOTE: All fields are required!!!</p>
            <?php   
                print_alert();
            ?>
        <div>
			<label for="nature_appointment">Nature of Appointment:</label>
			<br>
			<input <?php              
                    if(isset($_SESSION['nature_appointment'])){
                        echo "value=" . $_SESSION['nature_appointment'];                                                             
                    }                
                ?> type="text" name="nature_appointment" placeholder="e.g Urgent" required />
		</div>
		<br>
		<div>
			<label for="initial_complaint">Initial Complaint:</label>
			<br>
			<textarea name="initial_complaint" rows="9" placeholder="e.g Stomach ache, Pains, Fever" required><?php              
                    if(isset($_SESSION['initial_complaint'])){
                        echo  $_SESSION['initial_complaint'];                                                             
                    }                
                ?></textarea>
		</div>
		<br>            
		<div>
			<label for="date_appointment">Date of Appointment(Mon/Day/Year):</label>
			<br>
			<input <?php              
                    if(isset($_SESSION['date_appointment'])){
                        echo "value=" . $_SESSION['date_appointment'];                                                             
                    }                
                ?> type="date" name="date_appointment" required />
		</div>
        <br>
        <div>
			<label for="time_appointment">Time of Appointment(Hours:Mins):</label>
			<br>
			<input <?php              
                    if(isset($_SESSION['time_appointment'])){
                        echo "value=" . $_SESSION['time_appointment'];                                                             
                    }                
                ?> type="time" name="time_appointment" required />
		</div>
		<br>
		<div>
			<label for="department_appointment">Department:</label>
			<br>
			<select name="department_appointment">
				<?php              
                    if(isset($_SESSION['department'])){
                        echo "value=" . $_SESSION['department'];                                                             
                    }                
                ?>
				<option value="">Select</option>
				<option <?php              
                        if(isset($_SESSION['department_appointment']) && $_SESSION['department_appointment'] == 'Clinical Services'){
                            echo "selected";                                                           
                        }                
                    ?>>
					Clinical Services
				</option>
				<option <?php              
                        if(isset($_SESSION['department_appointment']) && $_SESSION['department_appointment'] == 'Operational Services'){
                            echo "selected";                                                           
                        }                
                    ?>>
					Operational Services
				</option>
			</select>
		</div>
		<br>
		<button type="submit" class="button-submit">Book</button>
	</form>

<?php 
include_once('lib/footer.php'); ?>
