<?php
	
	include_once("../database/database_connect.php");
	
	 //NEW WAY(PDO)
	 // include connection functions (houses the 'dbConnect()' function)
     //require_once(PATH_TO_INCLUDES_FOLDER . 'connection_inc.php');	
	 
	 
	global $connection;
	 if(isset($_POST["Username"], $_POST["Password"]))
	 {
		 //$conn = dbConnect('read');
		 
		 $sql = 'SELECT UserID, AccessLevel FROM User, AccessRights
					INNER JOIN AccessRights ON User.AccessRightsID = AccessRights.AccessRightsID
						WHERE Username = :Username AND Password = :Password';
		 
		 $statement = $connection->prepare($sql);
		 $encrypted_pwd = password_hash($Password,PASSWORD_BCRYPT);
		 
		 $statement->bindParam(':Username', $_POST['Username'], PDO::PARAM_STR);
		 $statement->bindParam(':Password', $encrypted_pwd, PDO::PARAM_STR);
		 
		 $statement->execute();
		 $row=$statement->fetch();
		 
		 
		 if($statment->rowCount())
		 {
			 //Success
			 $userID = $row["UserID"];
			 $accessLevel = $row["AccessLevel"];
			 
			 $userDetail = new userInfo($userID,$accessLevel);
			 
			 $_SESSION["userInfo"] = $userDetail;
			 
		 }
		 elseif(!$statement->rowCount())
		 {
			//Failure
			echo 'The provided credentials are not correct';
		 }
	 }
	 
	 class userInfo
	 {
		var $userId;
		var $accessLevel;
		
		function __construct($userId,$accessLevel)
		{
			$this->userId=$userID;
			$this->accessLevel=$accessLevel;
		}
	 }
?>