<?php
	include_once("../database/database_connect.php");
	include_once("Appointment.php");
	
	global $connection;
	$errors = array();
		
	if(isset($_POST["Patient_ID"]) && isset($_POST["Appointment_Date"]) && !empty($_POST["Appointment_Date"]))
	{	
		$previousID = Appointment::book_appointment($_POST["Patient_ID"],$_POST["Appointment_Date"]);
	 
		if(isset($_POST["Therapist_ID"])) //|| $_REQUEST["DoctorID"])
		{
			//Appointment::book_therapist_appointment($_POST["Appointment_ID"],$_POST["Therapist_ID"],null,null);
			Appointment::book_therapist_appointment($previousID,$_POST["Therapist_ID"],null,null);
			echo "Successfully added therapists appointment.";
		}
		elseif(isset($_POST["Doctor_ID"]))
		{
			//Appointment::book_doctor_appointment($_POST["Appointment_ID"],$_POST["Doctor_ID"],null);
			Appointment::book_doctor_appointment($previousID,$_POST["Doctor_ID"],null);
			
			echo "Successfully added doctors appointment.";
		}
		else
		{
			array_push($errors, "You must fill up all of the required fields");
		}
	}
	else
	{
		echo "Please check the required fields.";
	}
	
	if(count($errors) > 0)
	{
		echo implode("/n", $errors);
		die();
	}
?>