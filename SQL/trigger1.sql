DELIMITER $$

CREATE

	EVENT Daily_Payment_Verification
    ON SCHEDULE EVERY 1 DAY STARTS '2017-08-5 19:00:00'
    DO BEGIN
    
		INSERT INTO PAYMENT(PaymentID, PaymentTypeID, AppointmentID, Amount, AccountNumber)
        SELECT DailyPaymentID, PaymentTypeID, AppointmentID, Amount, AccountNumber
        FROM DailyPayment;
        
	END $$
    
DELIMITER ;

DELIMITER $$

CREATE

	EVENT Delete_Daily_Payment
    ON SCHEDULE EVERY 1 DAY STARTS '2017-08-5 19:05:00'
    DO BEGIN
    
		TRUNCATE DAILYPAYMENT;
        
	END $$
    
DELIMITER ;
