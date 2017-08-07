<?php 
    $pageTitle = 'TherapistAppointment';
    include('../includes/header.php'); 
	include_once('../includes/authentication/AccessRights.php'); 
    include_once('../includes/form/FormGenerator.php');
	include_once('../includes/database/database_connect.php');
	include_once('../includes/TherapistAppointment/TherapistAppointment.php');
	
	$AppointmentID=$_GET['AppointmentID'];
?>

<div id="content">
    <?php
        FormGenerator::generate_form("Therapist Appointment Registration", "../includes/TherapistAppointment/TherapistAppointmentRegistration.php", "Registration Succeeded",
            [
				FormGenerator::generate_element("Therapist_Appointment", "select", [$AppointmentID]),
				FormGenerator::generate_element("Note", "text", []),
				FormGenerator::generate_element("Diagnosis", "text", []),
				FormGenerator::generate_element("Treatment", "text", []),
				FormGenerator::generate_element("Treatment_Cost", "text", []),
				FormGenerator::generate_element("Equipment", "text", [])
            ]
        );
    ?>
</div>

<?php include('../includes/footer.php'); ?>