<?php 
require_once('functions/user.php');
//Collecting the data

$new_first_name = $_POST['first_name'];
$new_last_name = $_POST['last_name'];
$new_email = $_POST['email'];
$new_password = $_POST['password'];
$new_gender = $_POST['gender'];
$new_designation = $_POST['designation'];
$new_department = $_POST['department'];

    //Check if the user already exists.
    $userExists = find_user($new_email);

        if($userExists){
            $_SESSION["message"] = "Adding User Failed, User already exits ";
            header("Location: adminAddUser.php");
        } else {
        
    $allUsers = scandir("db/users/");     
    $countAllUsers = count($allUsers);
    $newUserId = ($countAllUsers+1);

    $userObject = [
        'id'=>$newUserId,
        'first_name'=>$new_first_name,
        'last_name'=>$new_last_name,
        'email'=>$new_email,
        'password'=> password_hash($new_password, PASSWORD_DEFAULT), //password hashing
        'gender'=>$new_gender,
        'designation'=>$new_designation,
        'department'=>$new_department,
        'date_of_registration'=> time()
    ];

    //save user in the database;
    save_user($userObject);

    //redirect super admin
    $_SESSION["message"] = "User with First name: " . $new_first_name . " was a added succesfully";
    header("Location: adminAddUser.php");
}
?>