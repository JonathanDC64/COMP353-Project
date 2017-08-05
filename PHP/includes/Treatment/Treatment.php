<?php
	include_once("../Equipment/Equipment.php");
	
    //Class to add treatment
    class Treatment{
				
        // Creates a treatment
        public static function create_treatment($Equipment, $Description, $Cost){
            global $connection;
            $stmt = $connection->prepare("INSERT INTO Treatment VALUES(0,:Equipment, :Description, :Cost)"); 
			$stmt->bindParam(':Equipment', $Equipment);
			$stmt->bindParam(':Description', $Description);
			$stmt->bindParam(':Cost', $Cost);
            $stmt->execute();
            return $connection->lastInsertId();
        }
	
        // Check  if treatment already exists
        public static function treatment_exists($Description){
            global $connection;
			$stmt = $connection->prepare("SELECT Description FROM Treatment WHERE Description = :Description"); 
            $stmt->bindParam(':Description', $Description);
            $stmt->execute();
            $row = $stmt->fetch();
            return $stmt->rowCount() > 0;
        }
	
    }
?>