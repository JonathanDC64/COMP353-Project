<?php

    //Class to add Diagnosis
    class Diagnosis{
		
        // Creates an Diagnosis
        public static function create_Diagnosis($Description){
            global $connection;
            $stmt = $connection->prepare("INSERT INTO Diagnosis VALUES(0,:Description)"); 
            $stmt->bindParam(':Description', $Description);
            $stmt->execute();
            return $connection->lastInsertId();
        }
	
		public static function retrieve_Diagnosis()
		{
			global $connection;
			$stmt=$connection->prepare("SELECT DiagnosisID,Description FROM Diagnosis");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		
        // Check  if Diagnosis already exists
        public static function Diagnosis_exists($Description){
            global $connection;
			$stmt = $connection->prepare("SELECT Description FROM Diagnosis WHERE Description = :Description"); 
            $stmt->bindParam(':Description', $Description);
            $stmt->execute();
            $row = $stmt->fetch();
            return $stmt->rowCount() > 0;
        }
	
    }
?>