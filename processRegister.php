<?php 
session_start();
require_once('functions/user.php');
//Collecting the data

$errorCount = 0;

//Verifying the data, validation

$first_name = $_POST['first_name'] != "" ? $_POST['first_name'] :  $errorCount++;
$last_name = $_POST['last_name'] != "" ? $_POST['last_name'] :  $errorCount++;
$email = $_POST['email'] != "" ? $_POST['email'] :  $errorCount++;
$password = $_POST['password'] != "" ? $_POST['password'] :  $errorCount++;
$gender = $_POST['gender'] != "" ? $_POST['gender'] :  $errorCount++;
$designation = $_POST['designation'] != "" ? $_POST['designation'] :  $errorCount++;
$department = $_POST['department'] != "" ? $_POST['department'] :  $errorCount++;

$_SESSION['first_name'] = $first_name;
$_SESSION['last_name'] = $last_name;
$_SESSION['email'] = $email;
$_SESSION['gender'] = $gender;
$_SESSION['designation'] = $designation;
$_SESSION['department'] = $department;

if($errorCount > 0){

    //checking for blank name
    if ($first_name == "") {
            $_SESSION["error"] = "First Name should not be blank";
            header("Location: register.php");
            die(); 
        } 
    if ($last_name == "") {
            $_SESSION["error"] = "Last Name should not be blank";
            header("Location: register.php");
            die(); 
        } 
    //checking for blank email
    if ($email == "") {
            $_SESSION["error"] = "Email must not be empty";
            header("Location: register.php");
            die(); 
        } 

     $session_error = "You have " . $errorCount . " error";
    
    if($errorCount > 1) {        
        $session_error .= "s";
    }

    $session_error .=   " in your form submission";
    $_SESSION["error"] = $session_error ;


    header("Location: register.php");

} else{

    //checking for correct name
    if(!ctype_alpha($first_name)){
            $_SESSION["error"] = "First Name should not have numbers";
        header("Location: register.php");
        die();
        }
    if(!ctype_alpha($last_name)){
            $_SESSION["error"] = "Last Name should not have numbers";
        header("Location: register.php");
        die();
        }
    if(strlen($first_name)<2){
            $_SESSION["error"] = "First Name should not be less than 2";  
        header("Location: register.php");
        die();
        }
    if(strlen($last_name)<2){
            $_SESSION["error"] = "Last Name should not be less than 2";  
        header("Location: register.php");
        die();
        }

    //checking email length
    if(strlen($email)<5){
            $_SESSION["error"] = "Email must not be less than 5";  
        header("Location: register.php");
        die();
        }

    //checking for @ and . in email
    if((strpos($email, '@') == false) || (strpos($email, '.') == false)){
            $_SESSION["error"] = "Email must have @ and . in it";  
        header("Location: register.php");
        die();
        }    

    //checking for valid email address
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION["error"] = "Email must be valid email";
        header("Location: register.php");
        die();
        }

    //Check if the user already exists.
    $userExists = find_user($email);

        if($userExists){
            $_SESSION["error"] = "Registration Failed, User already exits ";
            header("Location: register.php");
            die();
        }
        
    $allUsers = scandir("db/users/");     
    $countAllUsers = count($allUsers);
    $newUserId = ($countAllUsers+1);

    $userObject = [
        'id'=>$newUserId,
        'first_name'=>$first_name,
        'last_name'=>$last_name,
        'email'=>$email,
        'password'=> password_hash($password, PASSWORD_DEFAULT), //password hashing
        'gender'=>$gender,
        'designation'=>$designation,
        'department'=>$department,
        'date_of_registration'=> time()
    ];

    //save in the database;
    save_user($userObject);

    $_SESSION["message"] = "Registration Successful, you can now login " . $first_name;
    header("Location: login.php");
}

?>