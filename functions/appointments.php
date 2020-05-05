<?php

function save_appointment($appointmentObject, $department){
    file_put_contents("db/appointments/appointment-". $appointmentObject['id'] . ".json", json_encode($appointmentObject));
}

function count_appointment_dept($department=""){
    $department_name = "db/appointments/";
    $allAppointments = glob($department_name . "*.json");
    $countAppointments =  count($allAppointments);
        return $countAppointments;
}

function view_appointment(){
    $department_name = "db/appointments/";
    $allAppointments = glob($department_name . "*.json");
        return $allAppointments;
}

function count_appointment_user($email){
    $appointment_name = "db/appointments/";
    $allAppointments = glob($appointment_name . "*.json");
    foreach($allAppointments as $allAppointment){
    $appointmentString = file_get_contents($allAppointment);
    $appointmentObject = json_decode($appointmentString);
    $patientEmail = $appointmentObject->patient_email;
        if($patientEmail == $email) {
        return true;
    } 
    }
}

function verify_appointment_id($appointment_id){
    $appointment_name = "db/appointments/";
    $allAppointments = glob($appointment_name . "*.json");
    foreach($allAppointments as $allAppointment){
    $appointmentString = file_get_contents($allAppointment);
    $appointmentObject = json_decode($appointmentString);
    $appointmentId = $appointmentObject->id;
        if($appointmentId !== $appointment_id) {
        $countAppointments = false;
        return $countAppointments;
    } else {
        $countAppointments = true;
        return $countAppointments;
    }
    } 
}



?>
