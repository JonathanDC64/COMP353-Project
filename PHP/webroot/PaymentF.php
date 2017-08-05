<?php 
    $pageTitle = 'Payment';
    include('../includes/header.php'); 
	include_once('../includes/authentication/AccessRights.php'); 
    include_once('../includes/form/FormGenerator.php');
	include_once('../includes/database/database_connect.php');
	
?>

<div id="content">
    <?php
        FormGenerator::generate_form("Payment", "../includes/Payment/PaymentRegistration.php", "Registration Succeeded",
            [
				FormGenerator::generate_element("PaymentType", "select", ["Cash","Credit","Debit","Cheque"]),
				FormGenerator::generate_element("AccountNumber", "text", []),
				FormGenerator::generate_element("Ammount", "text", [])
            ]
        );
    ?>
</div>

<?php include('../includes/footer.php'); ?>