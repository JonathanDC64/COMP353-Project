<?php
	include_once("../includes/database/database_connect.php");
	
	global $connection;
	
	class AppointmentScheduling
	{
		static function appointment_check()
		{
			$previousID = $connection->lastInsertID();
			Appointment::book_appointment($_POST["Patient_ID"],$_POST["Appointment_Date"]);
			if(isset($_POST["TherapistID"])) //|| $_REQUEST["DoctorID"])
			{
				Appointment::book_therapist_appointment($_POST["Appointment_ID"],$_POST["Therapist_ID"],null,null);
			}
			elseif(isset($_POST["DoctorID"]))
			{
				Appointment::book_doctor_appointment($_POST["Appointment_ID"],$_POST["Doctor_ID"],null);
			}
			else
			{
				
			}
		}
	}
?>