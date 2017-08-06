<?php

    //Class to add doctor appointment
    class DoctorAppointment{
		
		//Create diagnosis
		public static function create_diagnosis($Description)
		{
			global $connection;
			$stmt = $connection->prepare("INSERT INTO Diagnosis VALUES(0, :Description)");
			$stmt->bindParam(':Description', $Description);
			$stmt->execute();
			return $connection->lastInsertId();
		}
		
		//Create Prescription
		public static function create_prescription($DoctorNote)
		{
			global $connection;
			$stmt = $connection->prepare("INSERT INTO Prescription VALUES(0, :DoctorNote)");
			$stmt->bindParam(':DoctorNote', $DoctorNote);
			$stmt->execute();
			return $connection->lastInsertId();
		}
		
		//Create Prescription_Diagnosis
		public static function create_prescription_diagnosis($PrescriptionID,$DiagnosisID)
		{
			global $connection;
			$stmt = $connection->prepare("INSERT INTO Prescription_Diagnosis VALUES(:PrescriptionID, :DiagnosisID)");
			$stmt->bindParam(':PrescriptionID', $PrescriptionID);
			$stmt->bindParam(':DiagnosisID', $DiagnosisID);
			$stmt->execute();
			return $connection->lastInsertId();
		}	
		
		//Create Doctor Appointment
		public static function create_doctor_appointment($AppointmentID,$DoctorID,$PrescriptionID)
		{
			global $connection;
			$stmt = $connection->prepare("INSERT INTO DoctorAppointment VALUES(0,:AppointmentID, :DoctorID, :PrescriptionID)");
			$stmt->bindParam(':AppointmentID', $AppointmentID);
			$stmt->bindParam(':DoctorID', $DoctorID);
			$stmt->bindParam(':PrescriptionID', $PrescriptionID);
			$stmt->execute();
			return $connection->lastInsertId();
		}
		
		// Check  if diagnosis already exists
        public static function diagnosis_exists($Description)
		{
            global $connection;
			$stmt = $connection->prepare("SELECT Description FROM Diagnosis WHERE Description = :Description"); 
            $stmt->bindParam(':Description', $Description);
            $stmt->execute();
            $row = $stmt->fetch();
            return $stmt->rowCount() > 0;

        }
		
		public static function retrieve_diagnosisID($Description){
            global $connection;
			$stmt = $connection->prepare("SELECT DiagnosisID FROM Diagnosis WHERE Description = :Description"); 
            $stmt->bindParam(':Description', $Description);
            $stmt->execute();
            $row = $stmt->fetch();	
			return $row["DiagnosisID"];
	
        }
		
    }
?>