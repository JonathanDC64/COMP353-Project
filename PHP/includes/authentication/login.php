<?php

	//OLD WAY(DEPRECATED)
	/*if(isset($_POST["Username"], $_POST["Password"]))
	{
		$Username = $_POST["Username"];
		$Password = $_POST["Password"];
		
		$result = mysql_query("SELECT Username, Password FROM User WHERE Username = '" .$name. "' AND Password = '" .$Password. "'");
		
		if(mysql_num_rows($result > 0) )
		{
			$_SESSION["logged_in"] = true;
			$_SESSION["name"]= $Username;
		}
		else
		{
			echo 'The provided credentials are not correct';
		}
	}*/
	
	
	 //NEW WAY(PDO)
	 // include connection functions (houses the 'dbConnect()' function)
     //require_once(PATH_TO_INCLUDES_FOLDER . 'connection_inc.php');	
	 
	 if(isset($_POST["Username"], $_POST["Password"]))
	 {
		 $conn = dbConnect('read');
		 
		 $sql = 'SELECT Username, Password FROM User WHERE Username = :Username AND Password = :Password';
		 $statement = $conn->prepare($sql);
		 $encrypted_pwd = password_hash($Password,PASSWORD_BCRYPT);
		 
		 $statement->bindParam(':Username', $_POST['Username'], PDO::PARAM_STR);
		 $statement->bindParam(':Password', $encrypted_pwd, PDO::PARAM_STR);
		 
		 $statement->execute();
		 
		 if($statment->rowCount())
		 {
			 //Success
		 }
		 elseif(!$statement->rowCount())
		 {
			echo 'The provided credentials are not correct';
		 }
	 }
?>