
<!DOCTYPE html>
<html lang="en">
<head>
  <title>BSPC</title>
    <meta charset="utf-8">
    <!-- JavaScript -->
    <script src="js/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
</head>
    
<body>
    
<div class="container">
        <div class="page-header;">
            <h1 style = "margin-left: 300px; margin-right: 250px; margin-top: 50px ;color : #E32934; font-size: 35px">
            Bahamas Sports Physio Center
            </h1>      
        </div>
</div>

<!--Navbar-->
<nav class="navbar navbar-inverse">
      <div class="container-fluid">
          
        <ul class="nav navbar-nav">
            <li class="active"><a href="SearchPatient.html">Home</a></li>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Administration <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="PatientRegistration.html">Registration</a></li>
            </ul>
            </li>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Information <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="ListDoctor.html">Doctor</a></li>
                <li><a href="ListTherapist.html">Therapist</a></li>
                <li><a href="ListNurse.html">Nurse</a></li>
				<li><a href="ListAppointment.html">Appointment</a></li>
            </ul>
            </li>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Report <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="#">Number of Patient During A Time Period</a></li>
				<li><a href="#">Equipment Never Used</a></li>
				<li><a href="#">List of All Patients</a></li>
				<li><a href="#">List of All Therapist</a></li>
				<li><a href="ListTherapist.html">List of Current Therapist</a></li>
				<li><a href="SearchPatient.html">Patient Reservation</a></li>
				<li><a href="#">HCP Availability</a></li>
				<li><a href="#">query 8</a></li>
				<li><a href="#">query 9</a></li>
				<li><a href="#">query 10</a></li>
				<li><a href="#">query 11</a></li>
            </ul>
         </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="Loging.html"><span class="glyphicon glyphicon-log-in"></span>Logout</a></li>
          </ul>
      </div>
 </nav>

<div class="container">
    <div class="col-sm-6">
        <h2>Payment</h2>
        <form class="form-horizontal" action="Test.php" method="post">
            
			
				<label class="radio-inline">
				<input type="radio" name="optradio" value = "CreditCard">CreditCard
				</label>
				<label class="radio-inline">
				<input type="radio" name="optradio" value = "DebitCard">DebitCard
				</label>
				<label class="radio-inline">
				<input type="radio" name="optradio" value = "Cheque">Cheque
				</label>
				<label class="radio-inline">
				<input type="radio" name="optradio" value= "Cash">Cash
				</label>
			
			<br/>
			<br/>
			
		   <div class="form-group">
                    <label class="control-label col-sm-3" for="AccountNumber">Account Number:</label>
                    
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="AccNumber" placeholder=" " name="AccountNum">
                    </div>
            </div>
            

			
			<div class="form-group">
                    <label class="control-label col-sm-3" for="Price">Price:</label>
                    
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="Price" placeholder=" " name="Price">
                    </div>
            </div>

            
            <div class="form-group"> 
                
                <div class="col-sm-offset-2 col-lg-9" style="margin-left: 200px">
					<input type ="submit" name="submit" value="Submit" style ="width:100px" class="btn btn-success" role="button">
					<input type = "reset" name= "reset" value = "Reset" style ="width:100px" class="btn btn-danger" role="button">
                </div>  
                
            </div>
            
        </form>
        
    </div>
	
    
    <div class="col-sm-6"></div>
</div>

     <?php 
            /*  if(isset($_POST['submit'])){
                   
                   if($_POST['optradio'] == "CreditCard")
                        echo("CardType:" . $_POST['optradio']);
                   elseif($_POST['optradio'] == "DebitCard")
                        echo("CardType:" . $_POST['optradio'] );
                   
                   elseif($_POST['optradio'] == "Cash")
                       echo("CardType:" . $_POST['optradio'] );
                   else
                       echo "ERROR";
                  
                  echo"Account:".$_POST['AccountNum'];
                  echo"Price:".$_POST['Price'];
               }*/
            ?>
</body>
</html>
