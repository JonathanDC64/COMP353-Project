<?php 
    $pageTitle = 'DoctorAppointment';
    include('../includes/header.php'); 
	include_once('../includes/authentication/AccessRights.php'); 
    include_once('../includes/form/FormGenerator.php');
	include_once('../includes/database/database_connect.php');
	include_once('../includes/DoctorAppointment/DoctorAppointment.php');
	
	$AppointmentID=$_GET['AppointmentID'];
?>

<div id="content">
    <?php
        FormGenerator::generate_form("Doctor Appointment Registration", "../includes/DoctorAppointment/DoctorAppointmentRegistration.php", "Registration Succeeded",
            [
				FormGenerator::generate_element("Doctor", "select", [$AppointmentID]),
				FormGenerator::generate_element("Note", "text", []),
				FormGenerator::generate_element("Diagnosis", "text", [])
			]
        );
    ?>
</div>

<?php include('../includes/footer.php'); ?>