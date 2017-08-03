<?php 
    $pageTitle = 'Login';
    include('../includes/header.php'); 
?>
<script>
    $(function(){
        $("#Login").on("click", function(){
            $.ajax({
                type: "POST",
                url: '../includes/authentication/login.php',
                data: $("#login_form").serialize(),
                success: function(response) {
                    if(response != "")
                        $("#errors").html(response);
                    else
                        $("#errors").html("Login Succeeded");
                }
            });
        });
    });
</script>
<div id="content">
    <div class="page-header text-center">
        <h2>Login</h2>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2" >
            <div class = "jumbotron">
                <form class="form-horizontal" method="POST" id="login_form" action="../includes/authentication/login.php">                   
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="Username">Username:</label>
                        
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="Username" placeholder="Username" name="Username">
                        </div>
                        
                    </div>
                
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="Password">Password:</label>
                        
                        <div class="col-lg-8">          
                            <input type="password" class="form-control" id="Password" placeholder="Password" name="Password">
                        </div> 
                    </div>
                
                    <div class="form-group">                        
                        <div class="col-sm-offset-2 col-lg-8">
                            <input type="button" class="btn btn-primary btn-block" id="Login" value="Login">
                            <div id="errors"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>