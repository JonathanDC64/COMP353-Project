<?php 
    $pageTitle = 'Payment';
    include('../includes/header.php'); 
	include_once('../includes/authentication/AccessRights.php'); 
    include_once('../includes/form/FormGenerator.php');
	include_once('../includes/database/database_connect.php');
	include_once('../includes/Payment/Payment.php');

	if(isset($_GET["AppointmentID"]) && !empty($_GET["AppointmentID"])){
        $AppointmentID = $_GET["AppointmentID"];
?>

        <div id="content">
            <?php
                FormGenerator::generate_form("Payment for Appointment #$AppointmentID", "../includes/Payment/PaymentRegistration.php", "",
                    [
                        FormGenerator::generate_element("Payment_Type", "select", 
                        [
                            [Payment::Cash,     "Cash"],
                            [Payment::Cheque,   "Cheque"],
                            [Payment::Debit,    "Debit"], 
                            [Payment::Credit,   "Credit"]
                        ]),
                        FormGenerator::generate_element("Account_Number_for_card_or_cheque", "text", []),
                        FormGenerator::generate_element("Amount", "text", []),
                        FormGenerator::generate_element("AppointmentID", "hidden", [$AppointmentID]),

                    ]
                );
            ?>
        </div>

<?php 
    }
    else{
        echo "invalid appointment";
    }
    include('../includes/footer.php'); 
?>