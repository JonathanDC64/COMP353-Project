<?php
    include_once("../database/database_connect.php");
    include_once("User.php");
    //TODO check for access rights here, use die() function
    
    //Only execute this when form is submitted
    //Use <input type="hidden" name="submited" value="true" />
    if(isset($_REQUEST["submitted"])){
        
        $errors = array();

        // Get User data
        $Username = "";
        if(isset($_POST["Username"])){
            $Username = $_POST["Username"];
        }
        else{
            array_push($errors, "Username is required");
        }

        if(User::username_exists($Username)){
            array_push($errors, "Username already exists");
        }

        $Password = "";
        if(isset($_POST["Password"])){
            $Password = password_hash($_POST["Password"], PASSWORD_DEFAULT);
        }
        else{
            array_push($errors, "Password is required");
        }

        $Role = "";
        if(isset($_POST["Role"])){
            $Role = $_POST["Role"]; # Access rights
        }
        else{
            array_push($errors, "Role is required");
        }

        $Experience = 0;
        if($Role == User::Doctor || $Role == User::Therapist){
            if(isset($_POST["Experience"])){
                $Experience = $_POST["Experience"];
            }
            else{
                array_push($errors, "Experience is required");
            }
        }

        // Get UserInformation data
        $First_Name = "";
        if(isset($_POST["First_Name"])){
            $First_Name = $_POST["First_Name"];
        }
        else{
            array_push($errors, "First Name is required");
        }

        $Last_Name = "";
        if(isset($_POST["Last_Name"])){
            $Last_Name = $_POST["Last_Name"];
        }
        else{
            array_push($errors, "Last Name is required");
        }

        $Phone_Number = "";
        if(isset($_POST["Phone_Number"])){
            $Phone_Number = $_POST["Phone_Number"];
        }
        else{
            array_push($errors, "Phone Number is required");
        }

        $Age = "";
        if(isset($_POST["Age"])){
            $Age = $_POST["Age"];
        }
        else{
            array_push($errors, "Age is required");
        }
        
        //If there are validation errors, display error message and stop page
        if(count($errors) > 0){
            echo implode("\n", $errors);
            die();
        }

        $connection->beginTransaction();
        // Find user access rights
        $AccessRightsID = User::get_access_rights($Role);

        if(!isset($AccessRightsID)){
            $connection->rollBack();
            die("Role does not exist");
        }

        // Create the user
        $UserID = User::create_user($AccessRightsID, $Username, $Password);

        // Create the user information
        User::create_user_information($UserID, $First_Name, $Last_Name, $Phone_Number, $Age);

        switch($Role){
            case User::Patient :
                User::create_patient($UserID);
                break;
            case User::Nurse :
                User::create_nurse($UserID);
                break;
            case User::Therapist : 
                User::create_therapist($UserID, $Experience);
                break;
            case User::Doctor :
                User::create_doctor($UserID, $Experience);
                break;
            case User::Receptionist :
                User::create_receptionist($UserID, $Experience);
                break;
        }

        $connection->commit();
    }
?>