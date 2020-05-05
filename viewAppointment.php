<?php 
include_once('lib/header.php'); 
require_once('functions/appointments.php');
require_once('functions/user.php');

if(!is_user_loggedIn()){
  
    header("Location: login.php");
}

?>
<div class="dashboard"><h2>ALL APPOINTMENTS</h2>
<?php
    $department = $_SESSION["department"];

    $countDept = count_appointment_dept($department);

    if($countDept == 0){
        echo "<h4>You Have no Pending Appointments</h4>";
    } else {
        $viewAppointments = view_appointment($department);
        echo " <table style='display: inline;
    text-align: center;
    font-size: inherit;'>
                <tr style='background: red;
    color: white;'>
                    <td>
                    Patient's Name
                    </td>
                    <td>
                    Nature of Appointment
                    </td>
                    <td>
                    Initial Complaint
                    </td>
                    <td>
                    Date of Appointment
                    </td>
                    <td>
                    Time of Appointment
                    </td>
                    <td>
                    Status
                    </td>
                    <td>
                    </td>
                </tr>";
        foreach($viewAppointments as $viewAppointment){
            $appointmentString = file_get_contents($viewAppointment);
            $appointmentObject = json_decode($appointmentString);
            $patientDept = $appointmentObject->department;
            $patientEmail = $appointmentObject->patient_email;
            $patientAppointDate = $appointmentObject->date_appointment;
            $patientAppointTime = $appointmentObject->time_appointment;
            $patientAppointComplaint = $appointmentObject->initial_complaint;
            $patientAppointNature = $appointmentObject->nature_appointment;
            $patientPay = $appointmentObject->payment;
            $userString = file_get_contents("db/users/".$patientEmail . ".json");
            $userObject = json_decode($userString);
            $patientName = $userObject->first_name." ".$userObject->last_name; 
            if($patientDept === $department){
            ?>
                <tr>
                    <td>
                    <?php
                    echo $patientName;
                    ?>
                    </td>
                    <td>
                    <?php
                    echo $patientAppointNature;
                    ?>
                    </td>
                    <td>
                    <?php
                    echo $patientAppointComplaint;
                    ?>
                    </td>
                    <td>
                    <?php
                    echo $patientAppointDate;
                    ?>
                    </td>
                    <td>
                    <?php
                    echo $patientAppointTime;
                    ?> hrs
                    </td>
                    <td>
                    <?php
                    if($patientPay === 1){
                        echo "<font color='green'>PAID</font>";
                    } else {
                        echo "<font color='red'>UNPAID</font>";
                    }
                    ?>
                    </td>
                    <td>
                    <?php
                    if($patientPay === 1){
                        echo "- Attend To -";
                    } else {
                        echo "";
                    }
                    ?>
                    </td>
                </tr>
            <?php
            }
        }
        echo "</table>";
    }

?>
        <br>
        <br>        
        <a href="index.php">Goto your Dashboard</a>
</div>

<?php include_once('lib/footer.php'); ?>