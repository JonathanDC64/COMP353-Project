<?php 
$pageTitle = 'Home';
include('../includes/header.php'); 
include_once('../includes/table/TableGenerator.php');
include_once('../includes/authentication/AccessRights.php');
?>
<div id="content">
<h1>My Page</h1>
<p>This is the content</p>
<?php
    TableGenerator::generate_table("Test", ["Test1", "Test2", "Test3"],
        [
            ["1","2","3"],
            ["4","5","6"],
            ["7","8","9"]
        ],
        "","",TableGenerator::generate_permission(AccessRights::AdminReceptionist, AccessRights::AdminReceptionist),
        "../includes/authentication/registration_form.php"
    );
?>
</div>
<?php include('../includes/footer.php'); ?>