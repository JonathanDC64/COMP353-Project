<?php 
    $pageTitle = 'Registration';
    include('../includes/header.php'); 
    include_once('../includes/authentication/AccessRights.php'); 
    AccessRights::verify_admin_receptionist();
?>
<script>
    $(function(){
        $("#Register").on("click", function(){
            $.ajax({
                type: "POST",
                url: '../includes/authentication/registration.php',
                data: $("#registration_form").serialize(),
                success: function(response) {
                    if(response != "")
                        $("#errors").html(response);
                    else
                        $("#errors").html("Registration Succeeded");
                }
            });
        });
    });
</script>
<div id="content">
    <div class="page-header text-center">
        <h2>Registration</h2>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="jumbotron"> 
                <form class="form-horizontal" method="POST" id="registration_form" action="../includes/authentication/registration.php">
                    
                    <div class="form-group">
                        <label class="control-label" for="Username">Username:</label>
                        <input type="text" class="form-control" id="Username" name="Username" placeholder="Username">
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="Password">Password:</label>
                        <input type="password" class="form-control" id="Password" name="Password" placeholder="Password">
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="Role">Role:</label>
                        <select class="form-control" id="Role" name="Role">
                            <option value="Patient">Patient</option>
                            <option value="Nurse">Nurse</option>
                            <option value="Therapist">Therapist</option>
                            <option value="Doctor">Doctor</option>
                            <option value="Receptionist">Receptionist</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="Experience">Experience:</label>
                        <input type="text" class="form-control" id="Experience" name="Experience" placeholder="Experience">
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="First_Name">First Name:</label>
                        <input type="text" class="form-control" id="First_Name" name="First_Name" placeholder="First Name">
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="Last_Name">Last Name:</label>
                        <input type="text" class="form-control" id="Last_Name" name="Last_Name" placeholder="Last Name">                
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="Phone_Number">Phone Number:</label>
                        <input type="text" class="form-control" id="Phone_Number" name="Phone_Number" placeholder="Phone Number">
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="Age">Age:</label>
                        <input type="text" class="form-control" id="Age" name="Age" placeholder="Age">
                    </div>
                    <input type="hidden" name="submitted" value="true" />
                    <div class="form-group">
                        <label class="control-label" for="Register"></label>
                        <input type="button" class="btn btn-success btn-block" role="button" id="Register" value="Register">
                        <div id="errors"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>