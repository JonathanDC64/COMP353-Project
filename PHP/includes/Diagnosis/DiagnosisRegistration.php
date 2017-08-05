<?php

	include_once("../database/database_connect.php");
	include_once("Diagnosis.php");

    //Execute when form is sumbitted
	if(isset($_REQUEST["submitted"])){
		
		$errors = array();
		
		
		//Get Diagnosis information
		$Description = "";
		if(isset($_POST["Description"])){
			$Description = $_POST["Description"];
		}
		else{
			array_push($errors, "Diagnosis Description is required");
		}
		
		if(Diagnosis::diagnosis_exists($Description)){
			array_push($errors, "Diagnosis already exists");
		}
		
		//If there are validation errors, display error message and stop page
        if(count($errors) > 0){
            echo implode("\n", $errors);
            die();
        }

		
		$connection->beginTransaction();
		
		//create the Diagnosis
		Diagnosis::create_diagnosis($Description);
		

		$connection->commit();
		
	}
?>