<?php
    include_once('AccessRights.php'); 
    include_once('../includes/form/FormGenerator.php');
    FormGenerator::generate_form("Register", "../includes/authentication/registration.php", "Registration Succeeded",
            [
                FormGenerator::generate_element("Username", "text", []),
                FormGenerator::generate_element("Password", "password", []),
                FormGenerator::generate_element("Role", "select", ["Patient", "Nurse", "Therapist", "Doctor", "Receptionist"]),
                FormGenerator::generate_element("Experience", "text", []),
                FormGenerator::generate_element("First_Name", "text", []),
                FormGenerator::generate_element("Last_Name", "text", []),
                FormGenerator::generate_element("Phone_Number", "text", []),
                FormGenerator::generate_element("Age", "text", [])
            ]
        );
?>