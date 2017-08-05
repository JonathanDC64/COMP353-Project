<?php
	if(isset($_POST["TherapistID"])) //|| $_REQUEST["DoctorID"])
	{
		Appointment::book_appointment($_POST["Patient_ID"],$_POST["Appointment_Date"]);
		Appointment::book_therapist_appointment($_POST["Appointment_ID"],$_POST["Therapist_ID"],null,null);
	}
	else
	{
		
	}
?>