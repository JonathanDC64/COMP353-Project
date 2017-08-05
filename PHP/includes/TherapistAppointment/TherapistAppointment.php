<?php

    //Class to add Therapist appointment
    class TherapistAppointment{
		
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
		
		//Create Equipment
		public static function create_equipment($Name)
		{
			global $connection;
			$stmt = $connection->prepare("INSERT INTO Equipment VALUES(0, :Name)");
			$stmt->bindParam(':Name', $Name);
			$stmt->execute();
			return $connection->lastInsertId();
		}
		
		//Create Treatment
		public static function create_treatment($EquipmentID,$Description,$Cost)
		{
			global $connection;
			$stmt = $connection->prepare("INSERT INTO Treatment VALUES(0, :EquipmentID, :Description, :Cost)");
			$stmt->bindParam(':EquipmentID', $EquipmentID);
			$stmt->bindParam(':Description', $Description);
			$stmt->bindParam(':Cost', $Cost);
			$stmt->execute();
			return $connection->lastInsertId();
		}
		
		//Create Therapist Appointment
		public static function create_therapist_appointment($AppointmentID,$TherapistID,$PrescriptionID,$TreatmentID)
		{
			global $connection;
			$stmt = $connection->prepare("INSERT INTO TherapistAppointment VALUES(0,:AppointmentID, :TherapistID, :PrescriptionID, :TreatmentID)");
			$stmt->bindParam(':AppointmentID', $AppointmentID);
			$stmt->bindParam(':TherapistID', $TherapistID);
			$stmt->bindParam(':PrescriptionID', $PrescriptionID);
			$stmt->bindParam(':TreatmentID', $TreatmentID);
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
		
		// Check  if equipment already exists
        public static function equipment_exists($Name)
		{
            global $connection;
			$stmt = $connection->prepare("SELECT Name FROM Equipment WHERE Name = :Name"); 
            $stmt->bindParam(':Name', $Name);
            $stmt->execute();
            $row = $stmt->fetch();
            return $stmt->rowCount() > 0;
        }
		
		// Check  if treatment already exists
        public static function treatment_exists($Description)
		{
            global $connection;
			$stmt = $connection->prepare("SELECT Description FROM Treatment WHERE Description = :Description"); 
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
		
        public static function retrieve_equipmentID($Name){
            global $connection;
			$stmt = $connection->prepare("SELECT EquipmentID FROM Equipment WHERE Name = :Name"); 
            $stmt->bindParam(':Name', $Name);
            $stmt->execute();
            $row = $stmt->fetch();
			return $row["EquipmentID"];

        }
		
		public static function retrieve_treatmentID($Description){
            global $connection;
			$stmt = $connection->prepare("SELECT TreatmentID FROM Treatment WHERE Description = :Description"); 
            $stmt->bindParam(':Description', $Description);
            $stmt->execute();
            $row = $stmt->fetch();
			return $row["TreatmentID"];
        }	
		
    }
?>