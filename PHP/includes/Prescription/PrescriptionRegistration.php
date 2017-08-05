<?php

	include_once("../database/database_connect.php");
	include_once("Prescription.php");

    //Execute when form is sumbitted
	if(isset($_REQUEST["submitted"])){
		
		$errors = array();
		
		
		//Get Prescription information
		$DoctorsNote = "";
		if(isset($_POST["DoctorsNote"])){
			$DoctorsNote = $_POST["DoctorsNote"];
		}
		else{
			array_push($errors, "Prescription Notes is required");
		}

		$Diagnosis = "";
		if(isset($_POST["Diagnosis"])){
			$Diagnosis = $_POST["Diagnosis"];
		}
		else{
			array_push($errors, "Prescription Notes is required");
		}
		
		//If there are validation errors, display error message and stop page
        if(count($errors) > 0){
            echo implode("\n", $errors);
            die();
        }

		
		$connection->beginTransaction();
		
		//create the Prescription
		$PrescriptionID=Prescription::create_prescription($DoctorsNote);
		Prescription::create_prescription_diagnosis($PrescriptionID, $Diagnosis);
		

		$connection->commit();
		
	}
?>