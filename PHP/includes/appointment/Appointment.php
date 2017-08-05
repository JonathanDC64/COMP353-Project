<?php
//create function doctor,therapist function
//get,update insert appointment
	include_once("../database/database_connect.php");
	
	
//	$FirstName = $_POST["FirstName"];

	class Appointment
	{	
		static function book_appointment($PatientID,$Appointment_Date)
		{
			global $connection;
			$sql = $connection->prepare('INSERT INTO Appointment(PatientID,Appointment_Date)
											VALUES(:PatientID,:Appointment_Date)');
			
			$sql->bindParam(':Appointment_Date', $Appointment_Date);
			$sql->bindParam(':PatientID',$PatientID);
			$sql->execute();	
			return $connection->lastInsertId();
		}
		
		static function book_doctor_appointment($AppointmentID,$DoctorID,$PrescriptionID)
		{	
			global $connection;
			$sql = $connection->prepare( 'INSERT INTO DoctorAppointment(AppointmentID, DoctorID, PrescriptionID)
												VALUES(:AppointmentID,:DoctorID,:PrescriptionID)');
			
			$sql->bindParam(':AppointmentID',$AppointmentID);			
			$sql->bindParam(':DoctorID',$DoctorID);			
			$sql->bindParam(':PrescriptionID',$PrescriptionID);			
			$sql->execute();	

			return $connection->lastInsertId();
		}
		
		static function book_therapist_appointment($AppointmentID,$TherapistID,$PrescriptionID,$TreatmentID)
		{
			global $connection;
			$sql = $connection->prepare( 'INSERT INTO TherapistAppointment(AppointmentID, TherapistID, PrescriptionID, TreatmentID)
						VALUES(:AppointmentID,:TherapistID,:TreatmentID, :PrescriptionID)');
			
			$sql->bindParam(':AppointmentID',$AppointmentID);			
			$sql->bindParam(':TherapistID',$TherapistID);			
			$sql->bindParam(':PrescriptionID',$PrescriptionID);	
			$sql->bindParam(':TreatmentID',$TreatmentID);	
			$sql->execute();	

			return $connection->lastInsertId();
		}
	}
?>