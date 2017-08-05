<?php 
    $pageTitle = 'Diagnosis';
    include('../includes/header.php'); 
	include_once('../includes/authentication/AccessRights.php'); 
    include_once('../includes/form/FormGenerator.php');
?>

<div id="content">
    <?php
        FormGenerator::generate_form("Diagnosis Registration", "../includes/Diagnosis/DiagnosisRegistration.php", "Registration Succeeded",
            [
                FormGenerator::generate_element("Description", "text", [])
            ]
        );
    ?>
</div>

<?php include('../includes/footer.php'); ?>