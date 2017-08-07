<?php 
      
class Payment{
        
    static function create_Payment($PaymentTypeID, $AppointmentID, $Amount, $AccountNumber){
        global $connection;
		$stmt = $connection->prepare("INSERT INTO Payment VALUES(0, :PaymentTypeID, :AppointmentID, :Amount, :AccountNumber)"); 
		$stmt->bindParam(':PaymentTypeID', $PaymentTypeID);
        $stmt->bindParam(':AppointmentID', $AppointmentID);
        $stmt->bindParam(':Amount', $Amount);
		$stmt->bindParam(':AccountNumber', $AccountNumber);
        $stmt->execute();
        return $connection->lastInsertId();
	}
        
    static function create_DailyPayment($PaymentTypeID, $AppointmentID, $Amount, $AccountNumber){
		global $connection;
		$stmt = $connection -> prepare("INSERT INTO DailyPayment VALUES(0, :PaymentTypeID, :AppointmentID, :Amount, :AccountNumber)"); 
		$stmt->bindParam(':PaymentTypeID', $PaymentTypeID);
        $stmt->bindParam(':AppointmentID', $AppointmentID);
        $stmt->bindParam(':Amount', $Amount);
		$stmt->bindParam(':AccountNumber', $AccountNumber);
        $stmt->execute();
        return $connection->lastInsertId();
	}
    
    static function payment_exists($AppointmentID){
        global $connection;
        $stmt = $connection->prepare("SELECT Payment.AppointmentID 
									  FROM Payment 
									  WHERE Payment.AppointmentID = :AppointmentID
									  UNION
									  SELECT DailyPayment.AppointmentID 
									  FROM DailyPayment 
									  WHERE DailyPayment.AppointmentID = :AppointmentID
									  "); 
		$stmt->bindParam(':AppointmentID', $AppointmentID);
		$stmt->execute();
		$row = $stmt->fetch();
		return $stmt->rowCount() > 0;
    }

}
?>