<?php
	include_once("../database/database_connect.php");
	
	class UserInfo{
		public $userId;
		public $accessLevel;
		
		function __construct($_userId, $_accessLevel)
		{
			$this->userId = $_userId;
			$this->accessLevel = $_accessLevel;
		}
	}

	//NEW WAY(PDO)
	// include connection functions (houses the 'dbConnect()' function)
    //require_once(PATH_TO_INCLUDES_FOLDER . 'connection_inc.php');	
	if(isset($_POST["Username"], $_POST["Password"])){
		//$conn = dbConnect('read');
		
		$sql = 'SELECT UserID, Password, AccessLevel FROM User
				INNER JOIN AccessRights ON User.AccessRightsID = AccessRights.AccessRightsID
				WHERE Username = :Username';
		
		$statement = $connection->prepare($sql);
		
		$statement->bindParam(':Username', $_POST['Username']);
		
		$statement->execute();
		$row=$statement->fetch();
		
		// Make sure username is found
		if($statement->rowCount() && password_verify($_POST["Password"], $row["Password"])){
			//Success
			$userID = $row["UserID"];
			$accessLevel = $row["AccessLevel"];
			
			$userInfo = new UserInfo($userID, $accessLevel);
			
			session_start();

			$_SESSION["User"] = serialize($userInfo);
		}
		else{
			//Failure
			die('The provided credentials are not correct');
		}
	}
?>