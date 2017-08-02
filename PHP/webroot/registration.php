<?php 
    $pageTitle = 'Registration';
    include('../includes/header.php'); 
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
        <div class="col-md-8 col-md-offset-2"> 
            <form class="form-horizontal" method="POST" id="registration_form" action="../includes/authentication/registration.php">
                
                <div class="form-group">
                    <label class="control-label col-sm-3" for="Username">Username:</label>

                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="Username" name="Username" placeholder="Username">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="Password">Password:</label>

                    <div class="col-lg-8">
                        <input type="password" class="form-control" id="Password" name="Password" placeholder="Password">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="Role">Role:</label>
                    <div class="col-lg-8">
                        <select class="form-control" id="Role" name="Role">
                            <option value="Patient">Patient</option>
                            <option value="Nurse">Nurse</option>
                            <option value="Therapist">Therapist</option>
                            <option value="Doctor">Doctor</option>
                            <option value="Receptionist">Receptionist</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="Experience">Experience:</label>

                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="Experience" name="Experience" placeholder="Experience">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="First_Name">First Name:</label>

                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="First_Name" name="First_Name" placeholder="First Name">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="Last_Name">Last Name:</label>

                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="Last_Name" name="Last_Name" placeholder="Last Name">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="Health_Number">Health Number:</label>

                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="Health_Number" name="Health_Number" placeholder="Health Number">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="Phone_Number">Phone Number:</label>

                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="Phone_Number" name="Phone_Number" placeholder="Phone Number">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="Age">Age:</label>

                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="Age" name="Age" placeholder="Age">
                    </div>
                </div>
                <input type="hidden" name="submitted" value="true" />
                <div class="form-group">
                    <label class="control-label col-sm-3" for="Register"></label>
                    
                    <div class="col-lg-8">
                        <input type="button" class="btn btn-success btn-block" role="button" id="Register" value="Register">
                        <div id="errors"></div>
                    </div>
                    
                </div>
            </form>
            
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>