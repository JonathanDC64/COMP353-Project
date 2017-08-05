<?php 
    $pageTitle = 'Treatment';
    include('../includes/header.php'); 
	include_once('../includes/authentication/AccessRights.php'); 
    include_once('../includes/form/FormGenerator.php');
	include_once('../includes/database/database_connect.php');
	include_once('../includes/Equipment/Equipment.php');
	
	$Equipment=Equipment::retrieve_equipment();
	$Equipment_list = array();
	
	foreach($Equipment as $Equipment)
	{
		array_push($Equipment_list, [$Equipment["EquipmentID"], $Equipment["Name"]]);
	}

?>

<div id="content">
    <?php
        FormGenerator::generate_form("Treatment Registration", "../includes/Treatment/TreatmentRegistration.php", "Registration Succeeded",
            [
				FormGenerator::generate_element("Equipment", "select", $Equipment_list),
				FormGenerator::generate_element("Description", "text", []),
				FormGenerator::generate_element("Cost", "text", [])
            ]
        );
    ?>
</div>

<?php include('../includes/footer.php'); ?>