<?php

function save_appointment($appointmentObject, $department){
    file_put_contents("db/appointments/" .$department . "/appointment-". $appointmentObject['id'] . ".json", json_encode($appointmentObject));
}

function count_appointment_dept($department=""){
    $department_name = "db/appointments/".$department."/";
    $allAppointments = glob($department_name . "*.json");
    $countAppointments =  count($allAppointments);
        return $countAppointments;
}

function view_appointment($department=""){
    $department_name = "db/appointments/".$department."/";
    $allAppointments = glob($department_name . "*.json");
    return $allAppointments;
}


?>