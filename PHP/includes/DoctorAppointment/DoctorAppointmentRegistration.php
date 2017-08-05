<?php
    include_once("../database/database_connect.php");
    include_once("DoctorAppointment.php");
    //TODO check for access rights here, use die() function
    
    //Only execute this when form is submitted
    //Use <input type="hidden" name="submitted" value="true" />
    if(isset($_REQUEST["submitted"])){
        
        $errors = array();
		$DiagnosisID;
		
		
        // Get User data
		$Appointment = "";
        if(isset($_POST["Appointment"])){
            $Appointment = $_POST["Appointment"];
        }
        else{
            array_push($errors, "Appointment is required");
        }
		
        $Doctor = "";
        if(isset($_POST["Doctor"])){
            $Doctor = $_POST["Doctor"];
        }
        else{
            array_push($errors, "Doctor is required");
        }
		
		$DoctorNote = "";
		if(isset($_POST["DoctorNote"])){
			$DoctorNote = $_POST["DoctorNote"];
		}
		else{
			array_push($errors, "Prescription Notes is required");
		}

		$Diagnosis = "";
		if(isset($_POST["Diagnosis"])){
			$Diagnosis = $_POST["Diagnosis"];
		}
		else{
			array_push($errors, "Diagnosis description is required");
		}
		
		
		//If there are validation errors, display error message and stop page
        if(count($errors) > 0){
            echo implode("\n", $errors);
            die();
        }
		

		$connection->beginTransaction();

		
		if(DoctorAppointment::diagnosis_exists($Diagnosis))
		{
			$DiagnosisID=DoctorAppointment::retrieve_diagnosisID($Diagnosis);
		}
		else
		{
			$DiagnosisID=DoctorAppointment::create_diagnosis($Diagnosis);
		}

		$PrescriptionID=DoctorAppointment::create_prescription($DoctorNote);
		DoctorAppointment::create_prescription_diagnosis($PrescriptionID,$DiagnosisID);
		DoctorAppointment::create_doctor_appointment($Appointment,$Doctor,$PrescriptionID);
		
        $connection->commit();
    }
?>