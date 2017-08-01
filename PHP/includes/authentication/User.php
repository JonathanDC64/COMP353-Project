<?php
    class User{
        
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
    }
?>