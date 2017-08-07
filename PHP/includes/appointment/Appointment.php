<?php
	//create function doctor,therapist function
	//get,update insert appointment
	include_once("../includes/database/database_connect.php");

	class Appointment
	{	
		public static function get_patient_appointment_doctor()
		{
			global $connection;
			
			$sql = $connection->prepare(
			'SELECT Appointment.AppointmentID,Appointment.Appointment_Date,userinformation.First_Name,userinformation.Last_Name
				FROM Appointment 
				INNER JOIN DoctorAppointment ON Appointment.AppointmentID = DoctorAppointment.AppointmentID 
				INNER JOIN Doctor ON DoctorAppointment.DoctorID = Doctor.DoctorID 
				INNER JOIN userinformation ON Doctor.UserID = userinformation.UserID'
			);
			
			$sql->execute();
			return $sql->fetchAll();
		}

		public static function get_doctor_appointment($AppointmentID)
		{
			global $connection;
			
			$sql = $connection->prepare(
			'SELECT Appointment.AppointmentID,Appointment.Appointment_Date,userinformation.First_Name,userinformation.Last_Name
				FROM Appointment 
				INNER JOIN DoctorAppointment ON Appointment.AppointmentID = DoctorAppointment.AppointmentID 
				INNER JOIN Doctor ON DoctorAppointment.DoctorID = Doctor.DoctorID 
				INNER JOIN userinformation ON Doctor.UserID = userinformation.UserID
				WHERE Appointment.AppointmentID = :AppointmentID'
			);
			$sql->bindParam(':AppointmentID', intval($AppointmentID));
			$sql->execute();
			return $sql->fetchAll();
		}

		public static function get_doctor_prescription($AppointmentID){
			global $connection;
			
			$sql = $connection->prepare(
			'SELECT DoctorsNote, Diagnosis 
				FROM DoctorAppointment 
				INNER JOIN Prescription ON DoctorAppointment.PrescriptionID = Prescription.PrescriptionID
				WHERE AppointmentID = :AppointmentID'
			);
			$sql->bindParam(':AppointmentID', intval($AppointmentID));
			$sql->execute();
			return $sql->fetchAll();
		}

		public static function get_therapist_appointment($AppointmentID)
		{
			global $connection;
			
			$sql = $connection->prepare(
			'SELECT Appointment.AppointmentID,Appointment.Appointment_Date,userinformation.First_Name,userinformation.Last_Name
				FROM Appointment 
				INNER JOIN TherapistAppointment ON Appointment.AppointmentID = TherapistAppointment.AppointmentID 
				INNER JOIN Therapist ON TherapistAppointment.TherapistID = Therapist.TherapistID 
				INNER JOIN userinformation ON Therapist.UserID = userinformation.UserID
				WHERE Appointment.AppointmentID = :AppointmentID'
			);
			$sql->bindParam(':AppointmentID', intval($AppointmentID));
			$sql->execute();
			return $sql->fetchAll();
		}

		public static function get_therapist_prescription($AppointmentID){
			global $connection;
			
			$sql = $connection->prepare(
			'SELECT DoctorsNote, Diagnosis 
				FROM TherapistAppointment 
				INNER JOIN Prescription ON TherapistAppointment.PrescriptionID = Prescription.PrescriptionID
				WHERE AppointmentID = :AppointmentID'
			);
			$sql->bindParam(':AppointmentID', intval($AppointmentID));
			$sql->execute();
			return $sql->fetchAll();
		}
		
		public static function get_patient_appointment_therapist(){
			global $connection;
			
			$sql = $connection->prepare(
			'SELECT Appointment.AppointmentID,Appointment.Appointment_Date,userinformation.First_Name,userinformation.Last_Name 
				FROM Appointment 
				INNER JOIN TherapistAppointment ON Appointment.AppointmentID = TherapistAppointment.AppointmentID 
				INNER JOIN Therapist ON TherapistAppointment.TherapistID = Therapist.TherapistID 
				INNER JOIN userinformation ON Therapist.UserID = userinformation.UserID');
			
			$sql->execute();
			return $sql->fetchAll(PDO::FETCH_ASSOC);
		}
		
		public static function retrieve_doctor_notes()
		{
			global $connection;
			
			$sql = $connection->prepare(
			'SELECT DoctorsNote,Description 
			FROM Appointment 
			INNER JOIN DoctorAppointment ON Appointment.AppointmentID = DoctorAppointment.AppointmentID 
			INNER JOIN Prescription ON Prescription.PrescriptionID = DoctorAppointment.PrescriptionID 
			INNER JOIN Prescription_Diagnosis ON Prescription.PrescriptionID = Prescription_Diagnosis.PrescriptionID 
			INNER JOIN Diagnosis ON Diagnosis.DiagnosisID = Prescription_Diagnosis.DiagnosisID');

			return $sql->fetchAll();
		}
		
		public static function book_appointment($PatientID,$Appointment_Date)
		{
			global $connection;
			$sql = $connection->prepare('INSERT INTO Appointment(PatientID,Appointment_Date)
											VALUES(:PatientID,:Appointment_Date)');
			
			$sql->bindParam(':Appointment_Date', $Appointment_Date);
			$sql->bindParam(':PatientID',$PatientID);
			$sql->execute();	
			return $connection->lastInsertId();
		}
		
		public static function book_doctor_appointment($AppointmentID,$DoctorID,$PrescriptionID)
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
		
		public static function book_therapist_appointment($AppointmentID,$TherapistID,$PrescriptionID,$TreatmentID)
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

		public static function validate_patient_appointment($AppointmentID, $PatientID){
			global $connection;
			$stmt = $connection->prepare("SELECT AppointmentID 
											FROM Appointment 
                                            WHERE AppointmentID = :AppointmentID
											AND PatientID = :PatientID");
			
            $stmt->bindParam(':AppointmentID', intval($AppointmentID), PDO::PARAM_INT);		
			$stmt->bindParam(':PatientID', intval($PatientID), PDO::PARAM_INT);	
			$stmt->execute();
			$row = $stmt->fetch();
            return isset($row["AppointmentID"]);
		}
	}
?>