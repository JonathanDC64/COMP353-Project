<?php 

    include_once("../database/database_connect.php");
    include_once("Payment.php");
    
    
    if(isset($_REQUEST["submitted"])){
        
        $errors = array();
        
        $PaymentType= " ";
        
        if(isset($_POST["PaymentType"])){
            $PaymentType = $_POST["PaymentType"];
            
        }else{
            array_push($errors, "PaymentType is required");
        }
        
        $AccountNumber= " ";
        
        if($PaymentType != "Cash"){
            
           if(isset($_POST["AccountNumber"])){
               $AccountNumber = $_POST["AccountNumber"]; 
           }
            else{
                array_push($errors, "PaymentType is required");
            }
         
        }
            
            
        $Amount = " ";
        
        if(isset($_POST["Amount"])){
            $Price = $_POST["Amount"];
            
        }else{
            array_push($errors, "Amount is required");
        }
        
        
    
        //TODO
        // Find Appointment ID
        //$AppointmentID = :: get_AppointmentID()
        
        
        //If there are validation errors, display error message and stop page
        if(count($errors) > 0){
            echo implode("\n", $errors);
            die();
        }
        
        
        
        // Create PaymentType
        Payment::create_PaymentType($PaymentType);
        
        //Find  Payment ID
        $PaymentTypeID = Payment::get_PaymentType($PaymentType);
        
         if(!isset($PaymentTypeID)){
            array_push($errors, "Payment does not exist");
        }
        
        
         $connection->beginTransaction();
        
        // Create Dailypaymeny and Payment
            if($PaymentType == "Cash"){
                Payment::create_Payment($PaymentTypeID,$AppointmentID,$Amount, null);
            }
            esleif($PaymentType == "Cheque"){
                Payment::create_Payment($PaymentTypeID,$AppointmentID,$Amount, $AccountNumber);
            }
            else{
                Payment::create_DailyPayment($PaymentTypeID,$AppointmentID,$Amount, $AccountNumber);
            }
                
            
         $connection->commit();
        
    }




?>