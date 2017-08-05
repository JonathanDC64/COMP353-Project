<?php

	include_once("../database/database_connect.php");
	include_once("Treatment.php");

    //Execute when form is sumbitted
	if(isset($_REQUEST["submitted"])){
		
		$errors = array();
		
		
		//Get equipment information
		$Equipment = "";
		if(isset($_POST["Equipment"])){
			$Equipment = $_POST["Equipment"];
		}
		else{
			array_push($errors, "Equipment is required");
		}
		
		$Description = "";
		if(isset($_POST["Description"])){
			$Description = $_POST["Description"];
		}
		else{
			array_push($errors, "Treatment description is required");
		}

		$Cost = "";
		if(isset($_POST["Cost"])){
			$Cost = $_POST["Cost"];
		}
		else{
			array_push($errors, "Treatment cost is required");
		}

		
		if(Treatment::treatment_exists($Description)){
			array_push($errors, "Treatment already exists");
		}
		
		//If there are validation errors, display error message and stop page
        if(count($errors) > 0){
            echo implode("\n", $errors);
            die();
        }

		
		$connection->beginTransaction();
		
		//create the equipment
		Treatment::create_treatment($Equipment, $Description, $Cost);
		

		$connection->commit();
		
	}
?>