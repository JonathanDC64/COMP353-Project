<?php
//create function doctor,therapist function
//get,update insert appointment
	include_once("../includes/database/database_connect.php");
	
	global $connection;
//	$FirstName = $_POST["FirstName"];

	class Appointment
	{	
		static function retrieve_doctor()
		{
			 $sql = 'SELECT UserInformation.First_Name,UserInformation.Last_Name 
						FROM Doctor, UserInformation
							WHERE Doctor.UserID = UserInformation.UserID';
			$statement = $connection->prepare($sql);
			$statement->execute();
		}
		
		static function book_appointment($PatientID,$Appointment_Date)
		{
			$sql = $connection->prepare('INSERT INTO Appointment(PatientID,Appointment_Date)
											VALUES(:PatientID,:Appointment_Date)');
			
			$sql->bindParam(':Appointment_Date',$Appointment_Date);
			$sql->bindParam(':PatientID',$PatientID);
			$sql->execution();		
		}
		
		static function book_doctor_appointment($AppointmentID,$DoctorID,$PrescriptionID)
		{	
			$sql = 'INSERT INTO DoctorAppointment(AppointmentID, DoctorID, PrescriptionID)
						VALUES(:AppointmentID,:DoctorID,:PrescriptionID)';
			
			$sql->bindParam(':AppointmentID',$AppointmentID);			
			$sql->bindParam(':DoctorID',$DoctorID);			
			$sql->bindParam(':PrescriptionID',$PrescriptionID);			
			$sql->execution();	
		}
		
		static function book_therapist_appointment($AppointmentID,$TherapistID,$PrescriptionID,$TreatmentID)
		{
			$sql = 'INSERT INTO TherapistAppointment(AppointmentID, TherapistID, PrescriptionID, Treatment)
						VALUES(:AppointmentID,:TherapistID,:TreatmentID, :PrescriptionID)';
			
			$sql->bindParam(':AppointmentID',$AppointmentID);			
			$sql->bindParam(':TherapistID',$TherapistID);			
			$sql->bindParam(':PrescriptionID',$PrescriptionID);	
			$sql->bindParam(':TreatmentID',$TreatmentID);	
			$sql->execution();	
		}
	}
?>