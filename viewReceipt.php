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

        <h2>PAYMENT RECEIPT</h2>
            <?php  print_alert(); ?>

        <?php
        
        $countAllAppointments = $_GET["appointment_num"];
        if($countAllAppointments == ""){
            echo "<h4>Sorry, Cannot Fetch Appointment Details, Try again!!!</h4>";
        } else {  
            
            $getTransactionDetails = view_transaction($countAllAppointments);
            if($getTransactionDetails == false){
                echo "<h4>Sorry, Cannot Fetch Transaction Details, Try again!!!</h4>";
            } else {

             ?>
                <b>Patient Email: </b> <?php echo $getTransactionDetails->email; ?>
                <br>
                <b>Patient Fullname: </b> <?php echo $getTransactionDetails->fullname; ?>
                <br>
                <b>Transaction Amount: </b> <?php echo "₦".$getTransactionDetails->amount; ?>
                <br>
                <b>Transaction Type: </b> <?php echo $getTransactionDetails->paymentType; ?>
                <br>
                <b>Transaction ID: </b> <?php echo $getTransactionDetails->transactionId; ?>
                <br>
                <b>Payment Reference: </b> <?php echo $getTransactionDetails->paymentReference; ?>
                <br>
                <b>Transaction Date: </b> <?php echo  date('d/m/Y h:i A', $getTransactionDetails->date_of_transaction); ?>
             
             
             <?php 
            }
            
?>
        <br>
        <br>        
        <a href="patientTransactions.php">Goto your Transactions</a>
</div>
<?php 
        }
include_once('lib/footer.php');

?>