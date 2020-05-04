<?php

function count_transactions(){
    $transaction_name = "db/transactions/";
    $allTransactions = glob($transaction_name . "*.json");
    $countTransactions =  count($allTransactions);
        return $countTransactions;
}

function store_transaction($saveTransaction){
    file_put_contents("db/transactions/transaction-". $saveTransaction['id'] . ".json", json_encode($saveTransaction));
}

function view_transaction($appointmentId){
    $transaction_loc = "db/transactions/";
    $getTransaction = glob($transaction_loc . "*.json");
    foreach($getTransaction as $getTrans){
        $transactionString = file_get_contents($getTrans);
        $transactionObject = json_decode($transactionString);
        $appointment_id = $transactionObject->appointment_id;
        if($appointmentId == $appointment_id){
            return $transactionObject;
        } else {
            return false;
        }
    }
    
}


?>