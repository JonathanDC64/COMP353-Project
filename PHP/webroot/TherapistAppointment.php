<?php 
    $pageTitle = 'TherapistAppointment';
    include('../includes/header.php'); 
	include_once('../includes/authentication/AccessRights.php'); 
    include_once('../includes/form/FormGenerator.php');
	include_once('../includes/database/database_connect.php');
	include_once('../includes/TherapistAppointment/TherapistAppointment.php');
?>

<div id="content">
    <?php
        FormGenerator::generate_form("Therapist Appointment Registration", "../includes/TherapistAppointment/TherapistAppointmentRegistration.php", "Registration Succeeded",
            [
                FormGenerator::generate_element("Appointment", "select", ["1","2","3"]),
				FormGenerator::generate_element("Therapist", "select", ["1","2","3"]),
				FormGenerator::generate_element("DoctorNote", "text", []),
				FormGenerator::generate_element("Diagnosis", "text", []),
				FormGenerator::generate_element("Treatment", "text", []),
				FormGenerator::generate_element("TreatmentCost", "text", []),
				FormGenerator::generate_element("Equipment", "text", [])
            ]
        );
    ?>
</div>

<?php include('../includes/footer.php'); ?>