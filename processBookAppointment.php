<?php 
session_start();
require_once('functions/user.php');
require_once('functions/appointments.php');

//Checking inputed data and Verifying the data, validation

$nature_appointment = $_POST['nature_appointment']; 
$initial_complaint = $_POST['initial_complaint'];
$date_appointment= $_POST['date_appointment'];
$time_appointment = $_POST['time_appointment'];
$department = $_POST['department_appointment'];

//creating sessions for data
$_SESSION['nature_appointment'] = $nature_appointment;
$_SESSION['initial_complaint'] = $initial_complaint;
$_SESSION['date_appointment'] = $date_appointment;
$_SESSION['time_appointment'] = $time_appointment;
$_SESSION['department_appointment'] = $department;


if($nature_appointment == "" || strlen($nature_appointment) < 5){
    set_alert('error', 'Nature of appointment must not be empty or less than five letters');
        header("Location: bookAppointment.php");
} elseif($initial_complaint == "" || strlen($initial_complaint) < 10){
     set_alert('error', 'Complaint must not be empty or less than 10 letters');
        header("Location: bookAppointment.php");   
} elseif($date_appointment == ""){
     set_alert('error', 'Date of appointment must be fixed');
        header("Location: bookAppointment.php");       
} elseif($time_appointment == ""){
     set_alert('error', 'Time of appointment must be fixed');
        header("Location: bookAppointment.php");       
} elseif($department == ""){
     set_alert('error', 'You must choose a Department');
        header("Location: bookAppointment.php");       
} else{
    $allAppointments = scandir("db/appointments/");     
    $countAllAppointments = count($allAppointments);
    $newAppointmentId = ($countAllAppointments+1);

    $appointmentObject = [
        'id'=>$newAppointmentId,
        'nature_appointment'=>$nature_appointment,
        'initial_complaint'=>$initial_complaint,
        'date_appointment'=>$date_appointment,
        'time_appointment'=>$time_appointment,
        'patient_email'=>$_SESSION["email"],
        'department'=>$department,
        'payment' => 0
    ];

    //save in the database;
    save_appointment($appointmentObject, $department);
    set_alert('success', 'Booking was made Successfully, A Medical Team member would reach out to you in a moment.');
        unset($_SESSION['nature_appointment']);
        unset($_SESSION['initial_complaint']);
        unset($_SESSION['date_appointment']);
        unset($_SESSION['time_appointment']);
        unset($_SESSION['department_appointment']);
        header("Location: bookSuccessful.php");  
}

