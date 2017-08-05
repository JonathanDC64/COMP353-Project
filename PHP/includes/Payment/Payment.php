<?php 
    
    
    
    class Payment{
        
       public static function create_PaymentType($PaymentType){
            global $connection;
        
            $stmt = $connection->prepare("INSERT INTO PaymentType VALUES(0, :Type)"); 
            $stmt->bindParam(':Type', $PaymentType);
            $stmt->execute();
            return $connection->lastInsertId();
        }
        
        //Note:Misssing AppointmentID
        public static function create_Payment($PaymentTypeID, $AppointmentID, $Ammount, $AccountNumber){
         global $connection;
		$stmt = $connection->prepare("INSERT INTO Payment VALUES(0, :PaymentTypeID, :AppointmentID, :Amount, : AccountNumber)"); 
		$stmt->bindParam(':PaymentTypeID', $PaymentTypeID);
        $stmt->bindParam(':AppointmentID', $AppointmentID);
        $stmt->bindParam(':Amount', $Amount);
		$stmt->bindParam(':AccountNumber', $AccountNumber);
        $stmt->execute();	
	   }
        
        //Note:Misssing AppointmentID
        public static function create_DailyPayment($PaymentTypeID, $AppointmentID, $Amount, $AccountNumber){
		$global connection;
		$stmt = $connection -> prepare("INSERT INTO DailyPayment VALUES(0, :PaymentTypeID, :AppointmentID, :Amount,
        : AccountNumber)"); 
		$stmt->bindParam(':PaymentTypeID', $PaymentTypeID);
        $stmt->bindParam(':AppointmentID', $AppointmentID);
        $stmt->bindParam(':Amount', $Amount);
		$stmt->bindParam(':AccountNumber', $AccountNumber);
        $stmt->execute();	
	}
       
        public static function payment_exists($PaymentType){
            global $connection;
            $stmt = $connection->prepare("SELECT Type FROM PaymentType  WHERE Type = :Type"); 
            $stmt->bindParam(':Type', $PaymentType);
            $stmt->execute();
            $row = $stmt->fetch();
            return $stmt->rowCount() > 0;
        }
        
        // Get  PaymentID
        public static function get_PaymentType($PaymentType){
            global $connection;
            
            $stmt = $connection->prepare("SELECT PaymentTypeID FROM PaymentType WHERE Type = :Type");
            $stmt->bindParam (':Type',$PaymentType);
            $stmt->execute();
            $row = $stmt->fetch();
            return $row["PaymentTypeID"];
        }
        
        
      /*
        public static function retrieve_payment(){
        global $connection;
        $stmt = $connection->prepare("SELECT PaymentType.Type,Payment.AccountNumber,Payment.Account,
                                      FROM Payment,PaymentType
                                      WHERE Payment.PaymentID = PaymentType.PaymentTypeID);
                                        
        $stmt->execute();
        return $stmt->fetchAll();
        
        }
        
        public static function retrieve_Dailypayment(){
        global $connection;
        $stmt = $connection->prepare("SELECT PaymentType.Type,DailyPayment.AccountNumber,DailyPayment.Account,
                                      FROM DailyPayment,PaymentType
                                      WHERE DailyPayment.PaymentID = PaymentType.PaymentTypeID);
                                        
        $stmt->execute();
        return $stmt->fetchAll();
        
        }
        
        
        
      
      
      */
        
	
        
    }


?>