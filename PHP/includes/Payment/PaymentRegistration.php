<?php 

    include_once("../database/database_connect.php");
    include_once("Payment.php");
    //include_once("Appointment.php");
    
    
    
    if(isset($_REQUEST["submitted"])){
        
        $errors = array();
        
        $Payment_Type= " ";
        
        if(isset($_POST["Payment_Type"])){
            $Payment_Type = $_POST["Payment_Type"];
            
        }else{
            array_push($errors, "Payment Type is required");
        }
        
        $Account_Number= " ";
        
        if($Payment_Type != "Cash"){
            
           if(isset($_POST["Account_Number"])){
               $Account_Number = $_POST["Account_Number"]; 
           }
            else{
                array_push($errors, "Payment Type is required");
            }
         
        }
            
            
        $Amount = " ";
        
        if(isset($_POST["Amount"])){
            $Amount = $_POST["Amount"];
            
        }else{
            array_push($errors, "Amount is required");
        }
        
        
    
        
        // Find Appointment ID from get_AppointmentID
        $AppointmentID = Appointment:: get_AppointmentID()
        
        
        //If there are validation errors, display error message and stop page
        if(count($errors) > 0){
            echo implode("\n", $errors);
            die();
        }
        /*
			foreach($PatientAppointments as $PatientAppointment){
				?>
				<tr>
					<td><?= $PatientAppointment["Date"]; ?></td>
					
					<td><a href='make_payment.php?AppointmentID=<?= $PatientAppointment["AppointmentID"]; ?>'>Make Payement</a></td>
				</tr>
				<?php
			}
		*/
        
        $connection->beginTransaction();
        
        // Create Payment_Type
        Payment::create_Payment_Type($Payment_Type);
        
        $connection->commit();
        
        
        //Find  Payment ID
        $Payment_TypeID = Payment::get_Payment_Type($Payment_Type);
        
         if(!isset($Payment_TypeID)){
            array_push($errors, "Payment does not exist");
        }
        

        
        
        $connection->beginTransaction();
        
        // Create Dailypaymeny and Payment
            if($Payment_Type == "Cash"){
                Payment::create_Payment($Payment_TypeID,$AppointmentID,$Amount, null);
            }
            elseif($Payment_Type == "Cheque"){
                Payment::create_Payment($Payment_TypeID,$AppointmentID,$Amount, $Account_Number);
            }
            else{
                Payment::create_DailyPayment($Payment_TypeID,$AppointmentID,$Amount, $Account_Number);
            }
                
            
         $connection->commit();
        
    }




?>