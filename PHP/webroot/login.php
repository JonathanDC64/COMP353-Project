<?php 
    $pageTitle = 'Login';
    include('../includes/header.php'); 
    include_once('../includes/form/FormGenerator.php');
?>

<script>
    function callback(){
        window.location.replace("index.php");
    }
</script>

<div id="content">
    <?php
        FormGenerator::generate_form("Login", "../includes/authentication/login.php", "Login Succeeded",
            [
                FormGenerator::generate_element("Username", "text", []),
                FormGenerator::generate_element("Password", "password", [])
            ]
        );
    ?>
</div>

<?php include('../includes/footer.php'); ?>