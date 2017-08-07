<?php
//create function doctor,therapist function
//get,update insert appointment
	include_once("../includes/database/database_connect.php");
	
	
//	$FirstName = $_POST["FirstName"];

	class Appointment
	{	
		static function get_patient_appointment_doctor($PatientID)
		{
			global $connection;
			
			$sql = $connection->prepare('SELECT Appointment.AppointmentID,Appointment.Appointment_Date,userinformation.First_Name,userinformation.Last_Name 
			FROM Appointment INNER JOIN DoctorAppointment ON Appointment.AppointmentID = DoctorAppointment.AppointmentID 
			INNER JOIN Doctor ON DoctorAppointment.DoctorID = Doctor.DoctorID INNER JOIN userinformation ON Doctor.UserID = userinformation.UserID');
												
		
			/*$sql = $connection->prepare('SELECT AppointmentID,Date,Doctor.First_Name,Doctor.Last_Name 
												FROM Appointment, DoctorAppointment, Doctor
														WHERE Appointment.PatientID = :PatientID AND 
														Appointment.AppointmentID = DoctorAppointment.AppointmentID AND 
														DoctorAppointment.DoctorID = Doctor.DoctorID');*/
														//die(var_dump($PatientID));
			$sql->bindParam(':PatientID',$PatientID->UserID);
			$sql->execute();
			return $sql->fetchAll();
			//return $row;
		}
		
		static function get_patient_appointment_therapist($PatientID)
		{
			global $connection;
			
			$sql = $connection->prepare('SELECT Appointment.AppointmentID,Appointment.Appointment_Date,userinformation.First_Name,userinformation.Last_Name 
			FROM Appointment INNER JOIN TherapistAppointment ON Appointment.AppointmentID = TherapistAppointment.AppointmentID 
			INNER JOIN Therapist ON TherapistAppointment.TherapistID = Therapist.TherapistID INNER JOIN userinformation ON Therapist.UserID = userinformation.UserID');
			
			
			
			/*$sql = $connection->prepare('SELECT AppointmentID,Date,Therapist.First_Name,Therapist.Last_Name 
												FROM Appointment, TherapistAppointment, Therapist
														WHERE Appointment.PatientID = :PatientID AND 
														Appointment.AppointmentID = TherapistAppointment.AppointmentID AND 
														TherapistAppointment.TherapistID = Therapist.TherapistID');*/
			$sql->bindParam(':PatientID',$PatientID->UserID);
			$sql->execute();
			return $sql->fetchAll();
			//return $row;
		}
		
		static function retrieve_doctor_notes($PatientID)
		{
			global $connection;
			
			/*
			SELECT DoctorsNote,Description FROM Appointment INNER JOIN DoctorAppointment ON Appointment.AppointmentID = DoctorAppointment.AppointmentID 
			INNER JOIN Prescription ON Prescription.PrescriptionID = DoctorAppointment.PrescriptionID INNER JOIN Prescription_Diagnosis ON 
			Prescription.PrescriptionID = Prescription_Diagnosis.PrescriptionID INNER JOIN Diagnosis ON Diagnosis.DiagnosisID = Prescription_Diagnosis.DiagnosisID
			*/
			
			$sql = $connection->prepare('SELECT DoctorsNote,Description FROM Appointment INNER JOIN DoctorAppointment ON Appointment.AppointmentID = DoctorAppointment.AppointmentID 
												INNER JOIN Prescription ON Prescription.PrescriptionID = DoctorAppointment.PrescriptionID INNER JOIN Prescription_Diagnosis ON 
												Prescription.PrescriptionID = Prescription_Diagnosis.PrescriptionID INNER JOIN Diagnosis ON Diagnosis.DiagnosisID = Prescription_Diagnosis.DiagnosisID');
			
			/*$sql = $connection->prepare('SELECT DoctorNote,Description FROM Appointment, DoctorAppointment, Prescription, Diagnosis 
													WHERE Appointment.PatientID = :PatientID AND 
													Appointment.AppointmentID = DoctorAppointment.AppointmentID AND
													DoctorAppointment.PrescriptionID = Prescription.PrescriptionID AND 
													INNER JOIN Prescription ON Prescription_Diagnosis.PrescriptionID =  ');*/
								
		}
		 /* 
		 public static function username_exists($Username){
            global $connection;
            $stmt = $connection->prepare("SELECT Username FROM User WHERE Username = :Username"); 
            $stmt->bindParam(':Username', $Username);
            $stmt->execute();
            $row = $stmt->fetch();
            return $stmt->rowCount() > 0;
		 }
		 */
		
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