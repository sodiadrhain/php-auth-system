<?php 
 include_once('lib/header.php'); 
 require_once('functions/alert.php');
 require_once('functions/appointments.php');

if(!is_user_loggedIn()){

    header("Location: login.php");
}

?>
<div class="dashboard">

        <h2>MAKE PAYMENT</h2>
            <?php  print_alert(); ?>

        <?php
        $viewAppointments = view_appointment();

        $countAllAppointments = $_GET["appointment_num"];
        if($countAllAppointments == ""){
            echo "<h4>Sorry, Cannot Fetch Appointment Details, Try again!!!</h4>";
        } else {    

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
                    Amount
                    </td>
                    <td>
                    Status
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
            $appointmentPrice = "20000";
            $userString = file_get_contents("db/users/".$patientEmail . ".json");
            $userObject = json_decode($userString);
            $patientFirstName = $userObject->first_name;
            $patientLastName = $userObject->last_name;

            if($appointmentId == $_GET["appointment_num"]){
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
                    echo "₦".$appointmentPrice;
                    ?>
                    <td>
                    <?php
                    $patientPayCheck = $patientPay;
                    if($patientPay === 1){
                        echo "<font color='green'>PAID</font>";
                    } else {
                        echo "<font color='red'>UNPAID</font>";
                    }
                    ?>
                    </td>
                </tr>
            <?php
            } 
        }
        echo "</table>";
        
        if($patientPayCheck === 0){
                ?>
        
                
           <br>
            <br>
            <form>
                <script src="https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
                <button type="button" onClick="payWithRave()" class="button-submit">Pay Now</button>
            </form>
            <?php
        } 
        
            }
                ?>
        </div>
<?php 
include_once('lib/footer.php');

?>


<!-- Flutterwave JavaScript Starts -->

<script>
    const API_publicKey = "FLWPUBK-676417a64e495aff7f3e3c37571605e9-X";
    

    function payWithRave() {
        var x = getpaidSetup({
            PBFPubKey: API_publicKey,
            customer_email: "<?php echo $patientEmail; ?>",
            amount: "<?php echo $appointmentPrice; ?>",
            customer_phone: "",
            currency: "NGN",
            payment_options: "card,account",
            customer_firstname: "<?php echo $patientFirstName; ?>",
            customer_lastname: "<?php echo $patientLastName; ?>",
            txref: "rave-123456",
            meta: [{
                metaname: "flightID",
                metavalue: "AP1234"
            }],
            onclose: function() {},
            callback: function(response) {
            var txref = response.tx.txRef; // collect flwRef returned and pass to a                     server page to complete status check
            var countAllAppointments = <?php echo $countAllAppointments ?>;
            var status = response.data.status;
            console.log(response);

            var paymentReference = response.tx.flwRef;
            var transactionId = response.tx.txRef;
            var paymentType = response.tx.paymentType;
            var amount = response.tx.amount;
            var email = "<?php echo $patientEmail ?>";
            var fullname = "<?php echo $patientFirstName." ".$patientLastName ?>";

            
        if(response.data.status == "success" || response.tx.status == "successful") {

            window.location = "confirmPayment.php?paymentReference="+paymentReference+"&transactionId="+transactionId+"&paymentType="+paymentType+"&amount="+amount+"&email="+email+"&fullname="+fullname+"&appointment_num="+countAllAppointments;

          } else {
             window.location = "confirmPayment.php";
          }

                x.close(); // use this to close the modal immediately after payment.
            }
        });
    }
</script>

<!-- Flutterwave JavaScript Ends -->