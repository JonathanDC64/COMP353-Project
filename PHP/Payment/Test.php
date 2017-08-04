<?php
    //include_once("../database/database_connect.php");
    include_once("DatabaseConnection.php");
    include_once('Payment.php');
   
	
 
        global $PaymentType;
        global $AppointmentID;
        global $Amount;
        global $AccountNumber;
        global $connection;
        
        if(isset($_POST['submit']))
        {
            $PaymentType = $_POST["optradio"];
            $Amount = $_POST["Price"];
            $AccountNumber =$_POST["AccountNum"];
        }
        
        
	
	function insert_DailyPayment($PaymentTypeID, $AppointmentID, $Amount, $AccountNumber){
		
		$stmt = $connection -> prepare("INSERT INTO DailyPayment VALUES(0, :PaymentTypeID, :AppointmentID, :Amount,
        : AccountNumber)"); 
		$stmt->bindParam(':PaymentTypeID', $PaymentTypeID);
        $stmt->bindParam(':AppointmentID', $AppointmentID);
        $stmt->bindParam(':Amount', $Amount);
		$stmt->bindParam(':AccountNumber', $AccountNumber);
        $stmt->execute();	
	}
	
     function insert_Payment($PaymentTypeID, $AppointmentID, $Amount, $AccountNumber){
         
		$stmt = $connection -> prepare("INSERT INTO Payment VALUES(0, :PaymentTypeID, :AppointmentID, :Amount, : AccountNumber)"); 
		$stmt->bindParam(':PaymentTypeID', $PaymentTypeID);
        $stmt->bindParam(':AppointmentID', $AppointmentID);
        $stmt->bindParam(':Amount', $Amount);
		$stmt->bindParam(':AccountNumber', $AccountNumber);
        $stmt->execute();	
	}
	
    
	create_Payment();
         
    function create_Payment( ){
        
	   if($PaymentType == "CreditCard" || $PaymentType == "DebitCard")
	   { 
		insert_DailyPayment($PaymentTypeID, $AppointmentID, $Amount, $AccountNumber);
	   }
	   elseif($PaymentType == "Cheque")
	   {
		insert_Payment($PaymentTypeID, $AppointmentID, $Amount, $AccountNumber);
	   }
	   else
	   {
		insert_Payment($PaymentTypeID, $AppointmentID, $Amount, $AccountNumber);
	   }
    }
 
   
 

?>