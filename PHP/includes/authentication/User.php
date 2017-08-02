<?php

    // User based functions
    class User{

        const Patient = "Patient";
        const Nurse = "Nurse";
        const Therapist = "Therapist";
        const Doctor = "Doctor";
        const Receptionist = "Receptionist";

        // Creates a user and returns their id
        public static function create_user($AccessRightsID, $Username, $Password){
            global $connection;
            $stmt = $connection->prepare("INSERT INTO User VALUES(0, :AccessRightsID, :Username, :Password)"); 
            $stmt->bindParam(':AccessRightsID', $AccessRightsID);
            $stmt->bindParam(':Username', $Username);
            $stmt->bindParam(':Password', $Password);
            $stmt->execute();
            return $connection->lastInsertId();
        }

        //Creates a user's user information
        public static function create_user_information($UserID, $First_Name, $Last_Name, $Phone_Number, $Age){
            global $connection;
            $stmt = $connection->prepare("INSERT INTO UserInformation VALUES(0, :UserID, :First_Name, :Last_Name, :Phone_Number, :Age)"); 
            $stmt->bindParam(':UserID', $UserID);
            $stmt->bindParam(':First_Name', $First_Name);
            $stmt->bindParam(':Last_Name', $Last_Name);
            $stmt->bindParam(':Phone_Number', $Phone_Number);
            $stmt->bindParam(':Age', $Age);
            $stmt->execute();
            return $connection->lastInsertId();
        }

        // Check  if username already exists
        public static function username_exists($Username){
            global $connection;
            $stmt = $connection->prepare("SELECT Username FROM User WHERE Username = :Username"); 
            $stmt->bindParam(':Username', $Username);
            $stmt->execute();
            $row = $stmt->fetch();
            return $stmt->rowCount() > 0;
        }

        // Gets access rights based on a role name
        public static function get_access_rights($Role){
            global $connection;
            $stmt = $connection->prepare("SELECT AccessRightsID FROM AccessRights WHERE Name = :Role"); 
            $stmt->bindParam(':Role', $Role);
            $stmt->execute();
            $row = $stmt->fetch();
            return $row["AccessRightsID"];
        }

        // Create user with Doctor role
        public static function create_doctor($UserID, $Experience){
            global $connection;
            $stmt = $connection->prepare("INSERT INTO Doctor VALUES(0, :UserID, :Experience)"); 
            $stmt->bindParam(':UserID', $UserID);
            $stmt->bindParam(':Experience', $Experience);
            $stmt->execute();
            return $connection->lastInsertId();
        }

        // Create user with Therapist role
        public static function create_therapist($UserID){
            global $connection;
            $stmt = $connection->prepare("INSERT INTO Therapist VALUES(0, :UserID, :Experience)"); 
            $stmt->bindParam(':UserID', $UserID);
            $stmt->bindParam(':Experience', $Experience);
            $stmt->execute();
            return $connection->lastInsertId();
        }

        // Create user with Nurse role
        public static function create_nurse($UserID){
            global $connection;
            $stmt = $connection->prepare("INSERT INTO Nurse VALUES(0, :UserID)"); 
            $stmt->bindParam(':UserID', $UserID);
            $stmt->execute();
            return $connection->lastInsertId();
        }

        // Create user with Receptionist role
        public static function create_receptionist($UserID){
            global $connection;
            $stmt = $connection->prepare("INSERT INTO Receptionist VALUES(0, :UserID)"); 
            $stmt->bindParam(':UserID', $UserID);
            $stmt->execute();
            return $connection->lastInsertId();
        }

        // Create user with Patient role
        public static function create_patient($UserID){
            global $connection;
            $stmt = $connection->prepare("INSERT INTO Patient VALUES(0, :UserID)"); 
            $stmt->bindParam(':UserID', $UserID);
            $stmt->execute();
            return $connection->lastInsertId();
        }
    }
?>