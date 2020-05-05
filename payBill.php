<?php 
 include_once('lib/header.php'); 
 require_once('functions/alert.php');
 require_once('functions/appointments.php');

if(!is_user_loggedIn()){

    header("Location: login.php");
}

?>
<div class="dashboard">
        <h2>PAY BILLS</h2>

          <?php
        $viewAppointments = view_appointment();
    $countAllAppointment = count_appointment_user($_SESSION["email"]);
    if(!$countAllAppointment){
        echo "<h4>You Have no Pending Bills</h4>";
    } else {

        echo "
            |
                <a href='patientTransactions.php'>View Transaction History</a>
			|
            <br>
        <br>
        <table style='display: inline;
    text-align: center;
    font-size: inherit;'>
                <tr style='background: red;
    color: white;'>
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
            $appointmentId = $appointmentObject->id;

            if($patientEmail === $_SESSION["email"]){
            ?>
                <tr>
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
                        echo "- <a href='viewReceipt.php?appointment_num=$appointmentId'>View Receipt</a> -";
                    } else {
                        echo "- <a href='makePayment.php?appointment_num=$appointmentId'>Make Payment</a> -";
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
<?php 
include_once('lib/footer.php'); 
?>