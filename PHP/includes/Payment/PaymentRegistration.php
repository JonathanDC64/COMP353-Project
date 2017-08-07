<?php 
    
    include_once("../database/database_connect.php");
    include_once("Payment.php");

    
    if(isset($_REQUEST["submitted"])){
        
        $errors = array();
		
		$Appointment_ID = "";
        if(isset($_POST["Appointment_ID"])){
            $Appointment_ID = $_POST["Appointment_ID"];
        }
		else
		{
			array_push($errors, "Appointment is required");
		}
		
		$Payment_Type = "";
        if(isset($_POST["Payment_Type"])){
            $Payment_Type = $_POST["Payment_Type"];
        }
		else
		{
			array_push($errors, "Payment type is required");
		}
		
		$Account_Number_for_card_or_cheque = "";
        if(isset($_POST["Account_Number_for_card_or_cheque"])){
            $Account_Number_for_card_or_cheque = $_POST["Account_Number_for_card_or_cheque"];
        }
		else
		{
			array_push($errors, "Account number for cards or cheque is required");
		}
		
		$Amount;
        if(isset($_POST["Amount"])){
            $Amount = $_POST["Amount"];
        }
		else
		{
			array_push($errors, "Amount is required");
			echo "WTF";
		}
		//If there are validation errors, display error message and stop page
        if(count($errors) > 0){
            echo "Enter required fields!";
            die();
        }
		
        $connection->beginTransaction();
		
		if(Payment::payment_exists($Appointment_ID))
		{
			echo "Thank you for wanting to give us more money, but no thanks!";
		}
		else
		{
			if($Payment_Type == "Cash"){
				$Payment_Type=1;
				Payment::create_Payment($Payment_Type,$Appointment_ID,$Amount, null);
			}
			elseif($Payment_Type == "Cheque"){
				$Payment_Type=2;
				Payment::create_Payment($Payment_Type,$Appointment_ID,$Amount, $Account_Number_for_card_or_cheque);
			}
			elseif($Payment_Type == "Debit"){
				$Payment_Type=3;
				Payment::create_DailyPayment($Payment_Type,$Appointment_ID,$Amount, $Account_Number_for_card_or_cheque);
			}
			else{
				$Payment_Type=4;
				Payment::create_DailyPayment($Payment_Type,$Appointment_ID,$Amount, $Account_Number_for_card_or_cheque);
			}
        }

        
        $connection->commit();
        
    }




?>