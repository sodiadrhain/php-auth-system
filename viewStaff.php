<?php 
include_once('lib/header.php'); 
require_once('functions/user.php');

if(!is_user_loggedIn()){
  
    header("Location: login.php");
}

?>
<div class="dashboard"><h2>ALL STAFF</h2>
<?php

        $viewUsers = show_users();
        echo " <table style='display: inline;
    text-align: center;
    font-size: inherit;'>
                <tr style='background: red;
    color: white;'>
                    <td>
                    Staff's Name
                    </td>
                    <td>
                    Email address
                    </td>
                    <td>
                    Gender
                    </td>
                    <td>
                    Department
                    </td>
                    <td>
                    Date of Registration
                    </td>
                </tr>";
        foreach($viewUsers as $viewUser){
            $userString = file_get_contents($viewUser);
            $userObject = json_decode($userString);
            $userDesignation = $userObject->designation;
            if($userDesignation == "Medical Team (MT)"){
                $userName = $userObject->first_name." ".$userObject->last_name;
                $userEmail = $userObject->email;
                $userGender = $userObject->gender;
                $userReg = $userObject->date_of_registration;
                $userReg =  date('d/m/Y h:i A', $userReg);
                $userDepartment = $userObject->department;

            ?>
                <tr>
                    <td>
                    <?php
                    echo $userName;
                    ?>
                    </td>
                    <td>
                    <?php
                    echo $userEmail;
                    ?>
                    </td>
                    <td>
                    <?php
                    echo $userGender;
                    ?>
                    </td>
                    <td>
                    <?php
                    echo $userDepartment;
                    ?>
                    </td> 
                    <td>
                    <?php
                    echo $userReg;
                    ?>
                    </td>
                    <td>
                    </td>
                </tr>
            <?php
           }
        }
        echo "</table>";

?>
        <br>
        <br>        
        <a href="index.php">Goto your Dashboard</a>
</div>

<?php include_once('lib/footer.php'); ?>