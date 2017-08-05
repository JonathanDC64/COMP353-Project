<?php 
    $pageTitle = 'Prescription';
    include('../includes/header.php'); 
	include_once('../includes/authentication/AccessRights.php'); 
    include_once('../includes/form/FormGenerator.php');
	include_once('../includes/database/database_connect.php');
	include_once('../includes/Diagnosis/Diagnosis.php');
	
	$Diagnosis=Diagnosis::retrieve_diagnosis();
	$Diagnosis_list = array();
	
	foreach($Diagnosis as $Diagnosis)
	{
		array_push($Diagnosis_list, [$Diagnosis["DiagnosisID"], $Diagnosis["Description"]]);
	}
?>

<div id="content">
    <?php
        FormGenerator::generate_form("Prescription Registration", "../includes/Prescription/PrescriptionRegistration.php", "Registration Succeeded",
            [
                FormGenerator::generate_element("DoctorsNote", "text", []),
				FormGenerator::generate_element("Diagnosis", "select", $Diagnosis_list),
            ]
        );
    ?>
</div>

<?php include('../includes/footer.php'); ?>