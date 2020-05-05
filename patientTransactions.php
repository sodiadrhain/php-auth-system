<?php 
 include_once('lib/header.php'); 
 require_once('functions/alert.php');
 require_once('functions/appointments.php');
 require_once('functions/transaction.php');

if(!is_user_loggedIn()){

    header("Location: login.php");
}

?>
<div class="dashboard">
        <h2>TRANSACTION HISTORY</h2>

          <?php
        $viewAppointments = view_appointment();
    $countAllTransactions = check_user_transactions($_SESSION["email"]);
   if($countAllTransactions != true){
        echo "<h4>You Currently Have No Transactions</h4>";
   
 } 
    
   
    else {
        echo "
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

            if($patientEmail === $_SESSION["email"] && $patientPay == 1){
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
                        echo "<font color='green'>PAID</font>";

                    ?>
                    </td>
                    <td>
                    <?php
                        echo "- <a href='viewReceipt.php?appointment_num=$appointmentId'>View Receipt</a> -";
                    ?>
                    </td>
                </tr>
            <?php
            } 
        }
        echo "</table>";
   } 
?>         <br>
        <br>        
        <a href="payBill.php">Goto your Bills</a>
</div>
<?php 
include_once('lib/footer.php'); 
?>