<?php 
 require_once('functions/alert.php');
 require_once('functions/redirect.php');
 require_once('functions/transaction.php');
 require_once('functions/sendEmail.php');

    if(isset($_GET["appointment_num"]) && $_GET["transactionId"] == "rave-123456"){

            $paymentReference = $_GET["paymentReference"];
            $transactionId = $_GET["transactionId"];
            $paymentType = $_GET["paymentType"];
            $amount = $_GET["amount"];
            $email = $_GET["email"];
            $fullname = $_GET["fullname"];
            $date_transaction = time();
            $appointment_num = $_GET["appointment_num"];

            $totalTransactions = count_transactions();

            $totalTransactions = $totalTransactions+1;

            $saveTransaction = [
                "id" => $totalTransactions,
                "appointment_id" => $appointment_num,
                "email" => $email,
                "fullname" => $fullname,
                "amount" => $amount,
                "paymentType" => $paymentType,
                "transactionId" => $transactionId,
                "paymentReference" => $paymentReference,
                "date_of_transaction" => $date_transaction
            ];

            store_transaction($saveTransaction);
                
            $currentAppointment = "appointment-".$appointment_num.".json";
            $appointmentString = file_get_contents("db/appointments/".$currentAppointment);
            $appointmentObject = json_decode($appointmentString);
            $appointmentObject->payment = 1;
            
            file_put_contents("db/appointments/appointment-". $appointment_num. ".json", json_encode($appointmentObject));

            $subject = "Appointment Payment Successful";
            $message = "This is to inform you that your recent transcation was done successful, Payment details can be seen from your Dashboard. Thankyou";

            send_success_trans_mail($subject,$message,$email);
            
            set_alert("message", "Payment Successful");

            redirect_to("viewReceipt.php?appointment_num=".$appointment_num);

    } else {

           set_alert("error", "Payment Failed, Please try again");

           redirect_to("makePayment.php?appointment_num=".$appointment_num);
    }


?>