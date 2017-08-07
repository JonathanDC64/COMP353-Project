<?php 
    $pageTitle = 'Payment';
    include('../includes/header.php'); 
	include_once('../includes/authentication/AccessRights.php'); 
    include_once('../includes/form/FormGenerator.php');
	include_once('../includes/database/database_connect.php');
	include_once('../includes/Payment/Payment.php');

	//$AppointmentID=$_GET["AppointmentID"];
	
	
?>

<div id="content">
    <?php
        FormGenerator::generate_form("Payment", "../includes/Payment/PaymentRegistration.php", "Registration Succeeded",
            [
				FormGenerator::generate_element("Appointment_ID", "select", ["1","2"]),
				FormGenerator::generate_element("Payment_Type", "select", ["Cash","Credit","Debit","Cheque"]),
				FormGenerator::generate_element("Account_Number_for_card_or_cheque", "text", []),
				FormGenerator::generate_element("Amount", "text", [])
            ]
        );
    ?>
</div>

<?php include('../includes/footer.php'); ?>