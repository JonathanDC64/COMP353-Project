<?php
//create function doctor,therapist function
//get,update insert appointment
	include_once("../includes/database/database_connect.php");
	
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
		
		public static function retrive_patientID($UserID)
		{
            global $connection;
			$stmt = $connection->prepare("SELECT PatientID FROM User,Patient WHERE Patient.UserID = :UserID"); 
            $stmt->bindParam(':UserID', $UserID);
            $stmt->execute();
            $row = $stmt->fetch();	
			return $row["PatientID"];
        }
		
		public static function retrive_therapistID($UserID)
		{
            global $connection;
			$stmt = $connection->prepare("SELECT TherapistID FROM User,Therapist WHERE Therapist.UserID = :UserID"); 
            $stmt->bindParam(':UserID', $UserID);
            $stmt->execute();
            $row = $stmt->fetch();	
			return $row["TherapistID"];
        }
		
		public static function retrive_doctorID($UserID)
		{
            global $connection;
			$stmt = $connection->prepare("SELECT DoctorID FROM User,Doctor WHERE Doctor.UserID = :UserID"); 
            $stmt->bindParam(':UserID', $UserID);
            $stmt->execute();
            $row = $stmt->fetch();	
			return $row["DoctorID"];
        }
		
		static function retrive_patient_appointment($PatientID)
		{
			global $connection;
			$stmt= $connection->prepare("(SELECT UserInformation.First_Name, UserInformation.Last_Name, Appointment.Appointment_Date, Appointment.AppointmentID, Patient.PatientID
										 FROM DoctorAppointment, Doctor, Appointment, Patient, User, UserInformation
										 WHERE Patient.PatientID = Appointment.PatientID AND
											   Appointment.AppointmentID = DoctorAppointment.AppointmentID AND
											   DoctorAppointment.DoctorID = Doctor.DoctorID AND
											   Doctor.UserID = User.UserID AND
											   User.UserID = UserInformation. UserID AND
											   Patient.PatientID = :PatientID)
										 UNION
										 (SELECT UserInformation.First_Name, UserInformation.Last_Name, Appointment.Appointment_Date, Appointment.AppointmentID, Patient.PatientID
										 FROM TherapistAppointment, Therapist, Appointment, Patient, User, UserInformation
										 WHERE Patient.PatientID = Appointment.PatientID AND
											   Appointment.AppointmentID = TherapistAppointment.AppointmentID AND
											   TherapistAppointment.TherapistID = Therapist.TherapistID AND
											   Therapist.UserID = User.UserID AND
											   User.UserID = UserInformation. UserID AND
											   Patient.PatientID = :PatientID)
											");
			$stmt->bindParam(':PatientID', $PatientID);
			$stmt->execute();
			return $stmt->fetchAll();
		}
		
		/*
		static function a($AppointmentID)
		{
			global $connection;
			$stmt= $connection->prepare("SELECT DoctorAppointment.DoctorAppointmentID, TherapistAppointment.TherapistAppointmentID
										 FROM DoctorAppointmentID,TherapistAppointmentID
										 WHERE Appointment.AppointmentID = :AppointmentID
			
			
			(SELECT UserInformation.First_Name, UserInformation.Last_Name, Appointment.Appointment_Date
										 FROM DoctorAppointment, Doctor, Appointment, Patient, User, UserInformation
										 WHERE Patient.PatientID = Appointment.PatientID AND
											   Appointment.AppointmentID = DoctorAppointment.AppointmentID AND
											   DoctorAppointment.DoctorID = Doctor.DoctorID AND
											   Doctor.UserID = User.UserID AND
											   User.UserID = UserInformation. UserID)
										 UNION
										 (SELECT UserInformation.First_Name, UserInformation.Last_Name, Appointment.Appointment_Date
										 FROM TherapistAppointment, Therapist, Appointment, Patient, User, UserInformation
										 WHERE Patient.PatientID = Appointment.PatientID AND
											   Appointment.AppointmentID = TherapistAppointment.AppointmentID AND
											   TherapistAppointment.TherapistID = Therapist.TherapistID AND
											   Therapist.UserID = User.UserID AND
											   User.UserID = UserInformation. UserID)
											");
			$stmt->bindParam(':PatientID', $PatientID);
			$stmt->execute();
			return $stmt->fetchAll();
		}
		*/
		
		static function retrive_therapist_appointment($TherapistID)
		{
			global $connection;
			$stmt= $connection->prepare("SELECT UserInformation.First_Name, UserInformation.Last_Name, Appointment.Appointment_Date, TherapistAppointment.TherapistAppointmentID, TherapistAppointment.TherapistID
										 FROM TherapistAppointment, Appointment, Patient, User, UserInformation
										 WHERE TherapistAppointment.AppointmentID = Appointment.AppointmentID AND
											   Appointment.PatientID = Patient.PatientID AND
											   Patient.UserID = User.UserID AND
											   User.UserID = UserInformation.UserID AND
											   TherapistAppointment.TherapistID = :TherapistID
										 ORDER BY Appointment.Appointment_Date");
			$stmt->bindParam(':TherapistID', $TherapistID);
			$stmt->execute();
			return $stmt->fetchAll();
		}
		
		static function retrive_doctor_appointment($DoctorID)
		{
			global $connection;
			$stmt= $connection->prepare("SELECT UserInformation.First_Name, UserInformation.Last_Name, Appointment.Appointment_Date, DoctorAppointment.DoctorAppointmentID
										 FROM DoctorAppointment, Appointment, Patient, User, UserInformation
										 WHERE DoctorAppointment.AppointmentID = Appointment.AppointmentID AND
											   Appointment.PatientID = Patient.PatientID AND
											   Patient.UserID = User.UserID AND
											   User.UserID = UserInformation.UserID
										 ORDER BY Appointment.Appointment_Date");
			$stmt->bindParam(':DoctorID', $DoctorID);
			$stmt->execute();
			return $stmt->fetchAll();
		}
											   
	}
?>