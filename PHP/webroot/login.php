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
                    else{
                        $("#errors").html("Login Succeeded");
                        window.location.replace("index.php");
                    }
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
        <div class="col-md-6 col-md-offset-3" >
            <div class = "jumbotron">
                <form class="form-horizontal" method="POST" id="login_form" action="../includes/authentication/login.php">                   
                    <div class="form-group">
                        <label class="control-label" for="Username">Username:</label>
                        <input type="text" class="form-control" id="Username" placeholder="Username" name="Username">
                    </div>
                
                    <div class="form-group">
                        <label class="control-label" for="Password">Password:</label>  
                        <input type="password" class="form-control" id="Password" placeholder="Password" name="Password">
                    </div>
                
                    <div class="form-group">                        
                        
                        <input type="button" class="btn btn-primary btn-block" id="Login" value="Login">
                        <div id="errors"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>