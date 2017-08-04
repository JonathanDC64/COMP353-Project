<?php 

?>
<?php 
	$pageTitle = 'New Appointment';
	include('../includes/header.php'); 
	include_once('../includes/form/FormGenerator.php');
	include_once ("../includes/appointment/Appointment.php");
	include_once ("../includes/database/database_connect.php");
?>
<div id="content">
<?php
        FormGenerator::generate_form("Add Doctor Appointment", "../includes/.php", "Doctor Appointment added Succeeded",
            [
                FormGenerator::generate_element("Appointment_Date", "date", []),
                FormGenerator::generate_element("Patient_ID", "select", []),
				FormGenerator::generate_element("Doctor_ID", "select", [])

            ]
        );
?>
</div>
<?php include('../includes/footer.php'); ?>

