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
        <h2>USER PAYMENTS HISTORY</h2>

          <?php
    $showTransactions = show_transactions();
    $countTransactions = count_transactions();
    if($countTransactions === 0){
        echo "<h4>No User Payments to display</h4>";
    } else {

        echo "
        <table style='display: inline;
    text-align: center;
    font-size: inherit; '>
                <tr style='background: red;
    color: white;'>
                    <td>
                    Fullname
                    </td>
                    <td>
                    Email
                    </td>
                    <td>
                    Date of trans.
                    </td>
                    <td>
                    Amount
                    </td>
                    <td>
                    Payment Reference
                    </td>
                    <td>
                    Type
                    </td>
                </tr>";
        foreach($showTransactions as $showTransaction){
            $transactionString = file_get_contents($showTransaction);
            $transactionObject = json_decode($transactionString);
            ?>
                <tr>
                    <td>
                    <?php
                    echo $transactionObject->fullname;
                    ?>
                    </td>
                    <td>
                    <?php
                    echo $transactionObject->email;
                    ?>
                    </td>
                    <td>
                    <?php echo  date('d/m/Y h:i A', $transactionObject->date_of_transaction); 
                    ?>
                    </td>
                    <td>
                    ₦<?php
                    echo $transactionObject->amount;
                    ?> 
                    </td>
                    <td>
                    <?php
                        echo $transactionObject->paymentReference;
                    ?>
                    </td>
                    <td>
                    <?php
                        echo $transactionObject->paymentType;
                    ?>
                    </td>
                </tr>
            <?php
        }
        echo "</table>";
    }
?>
        <br>
        <br>        
        <a href="index.php">Goto your Dashboard</a>
</div>
<?php 
include_once('lib/footer.php'); 
?>