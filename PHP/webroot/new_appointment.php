<?php 

?>
<?php 
	$pageTitle = 'New Appointment';
	include('../includes/header.php'); 
	include_once('../includes/form/FormGenerator.php');
	include_once ("../includes/authentication/User.php");
	include_once ("../includes/database/database_connect.php");
	$Patients = User::retrieve_patients();
	$Patients_Select = array();
	foreach($Patients as $Patient){
		array_push($Patients_Select, [$Patient["PatientID"], $Patient["First_Name"] . $Patient["Last_Name"]]);
	}
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

