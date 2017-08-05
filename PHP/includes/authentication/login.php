<?php
	include_once("../database/database_connect.php");
	include_once("User.php");
	
	//NEW WAY(PDO)
	// include connection functions (houses the 'dbConnect()' function)
    //require_once(PATH_TO_INCLUDES_FOLDER . 'connection_inc.php');	
	if(isset($_POST["Username"], $_POST["Password"])){
		//$conn = dbConnect('read');
		User::login($_POST["Username"], $_POST["Password"]);
		
	}
?>