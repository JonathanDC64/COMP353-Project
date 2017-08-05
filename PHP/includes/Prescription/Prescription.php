<?php

    //Class to add Prescription
    class Prescription{
		
        // Creates an Prescription
        public static function create_prescription($DoctorsNote){
            global $connection;
            $stmt = $connection->prepare("INSERT INTO Prescription VALUES(0,:DoctorsNote)"); 
            $stmt->bindParam(':DoctorsNote', $DoctorsNote);
            $stmt->execute();
            return $connection->lastInsertId();
        }
		
		public static function create_prescription_diagnosis($PrescriptionID,$Diagnosis){
            global $connection;
            $stmt = $connection->prepare("INSERT INTO Prescription_Diagnosis VALUES(:PrescriptionID,:Diagnosis)"); 
            $stmt->bindParam(':PrescriptionID', $PrescriptionID);
			$stmt->bindParam(':Diagnosis', $Diagnosis);
            $stmt->execute();
            return $connection->lastInsertId();
        }
		
		/*
		public static function retrieve_P()
		{
			global $connection;
			$stmt=$connection->prepare("SELECT Description FROM Diagnosis");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		*/
	
    }
?>