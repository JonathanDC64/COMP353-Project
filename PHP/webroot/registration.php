<?php 
    $pageTitle = 'Registration';
    include('../includes/header.php'); 
    include_once('../includes/authentication/AccessRights.php'); 
    include_once('../includes/form/FormGenerator.php');
    AccessRights::verify_admin_receptionist();
?>

<div id="content">
    <?php
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
</div>

<?php include('../includes/footer.php'); ?>