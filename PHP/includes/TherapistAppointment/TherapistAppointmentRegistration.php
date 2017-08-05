<?php
    include_once("../database/database_connect.php");
    include_once("TherapistAppointment.php");
    //TODO check for access rights here, use die() function
    
    //Only execute this when form is submitted
    //Use <input type="hidden" name="submitted" value="true" />
    if(isset($_REQUEST["submitted"])){
        
        $errors = array();
		$EquipmentID;
		$DiagnosisID;
		$TreatmentID;
		
        // Get User data
		$Appointment = "";
        if(isset($_POST["Appointment"])){
            $Appointment = $_POST["Appointment"];
        }
        else{
            array_push($errors, "Appointment is required");
        }
		
        $Therapist = "";
        if(isset($_POST["Therapist"])){
            $Therapist = $_POST["Therapist"];
        }
        else{
            array_push($errors, "Therapist is required");
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
		
		$Treatment = "";
		if(isset($_POST["Treatment"])){
			$Treatment = $_POST["Treatment"];
		}
		else{
			array_push($errors, "Treatment description is required");
		}
		
		$TreatmentCost = "";
		if(isset($_POST["TreatmentCost"])){
			$TreatmentCost = $_POST["TreatmentCost"];
		}
		else{
			array_push($errors, "Treatment cost is required");
		}
		
		$Equipment = "";
		if(isset($_POST["Equipment"])){
			$Equipment = $_POST["Equipment"];
		}
		else{
			array_push($errors, "Equipment is is required for a treatment");
		}
		
		//If there are validation errors, display error message and stop page
        if(count($errors) > 0){
            echo implode("\n", $errors);
            die();
        }
		

		$connection->beginTransaction();
		
		
        // Create
	/*
		if(ThAp::equipment_exists($Equipment))
		{
			$EquipmentID=ThAp::retrieve_equipmentID($Equipment);
		}
		else
		{
			$EquipmentID=ThAp::create_equipment($Equipment);
		}
	*/	


			
		if(TherapistAppointment::treatment_exists($Treatment))
		{
			$TreatmentID=TherapistAppointment::retrieve_treatmentID($Treatment);
		}
		else
		{
			if(TherapistAppointment::equipment_exists($Equipment))
			{
				$EquipmentID=TherapistAppointment::retrieve_equipmentID($Equipment);
			}
			else
			{
				$EquipmentID=TherapistAppointment::create_equipment($Equipment);
			}
			
			$TreatmentID=TherapistAppointment::create_treatment($EquipmentID,$Treatment,$TreatmentCost);
		}
		
		if(TherapistAppointment::diagnosis_exists($Diagnosis))
		{
			$DiagnosisID=TherapistAppointment::retrieve_diagnosisID($Diagnosis);
		}
		else
		{
			$DiagnosisID=TherapistAppointment::create_diagnosis($Diagnosis);
		}

		$PrescriptionID=TherapistAppointment::create_prescription($DoctorNote);
		TherapistAppointment::create_prescription_diagnosis($PrescriptionID,$DiagnosisID);
		TherapistAppointment::create_therapist_appointment($Appointment,$Therapist,$PrescriptionID,$TreatmentID);
		
        $connection->commit();
    }
?>