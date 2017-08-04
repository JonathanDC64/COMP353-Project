<?php 
	include_once ("../includes/appointment/Appointment.php");
	include_once ("../includes/database/database_connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>BSPC</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- BootStrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- BootStrap Theme -->
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <!-- JavaScript -->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
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
<?php   
	
   
	//echo $sql_dr;	
	//echo 'Hello';
?>
<div class="container">
    <div class="col-sm-6">
        <h2>Patient Details</h2>
        <form class="form-horizontal" action="Appointment(Test).php" method="post">
            
           <!-- <div class="form-group">
                    <label class="control-label col-sm-3" for="FirstName">First Name:</label>
                    
                    <div class="col-lg-8">
                        <input type="FName" class="form-control" id="FirstName" placeholder=" " name="FirstName">
                    </div>
            </div>
            
            <div class="form-group">
                    <label class="control-label col-sm-3" for="LastName">Last Name:</label>
                    <div class="col-lg-8">
                        <input type="LName" class="form-control" id="LastName" placeholder=" " name="Last">
                    </div>
            </div>
            
            
            <div class="form-group">
                    <label class="control-label col-sm-3" for="PHN">
                    Health Number:</label>
                    <div class="col-lg-8">
                        <input type="HealthNum" class="form-control" id="HealthNum" placeholder=" " name="HealthNum">
                    </div>
            </div>
            
            <div class="form-group">
                    <label class="control-label col-sm-3" for="Age">Phone Number:</label>
                    <div class="col-lg-8">
                        <input type="PhoneNum" class="form-control" id="PhoneNum" placeholder=" " name="PhoneNUm">
                    </div>
            </div>
            !-->
            <hr>
            
            <h2>Select Doctor</h2>
            
            <div class="form-group">
                 <label class="control-label col-sm-3" for="SelectDoctor">Doctor:</label>
                <div class="col-sm-8">
                    <select class="form-control" >
                        <option>Please Select Doctor</option>
                        <option>Ahnaf Shahariar</option>
                        <option>Ali</option>
                        <option>Jonathon</option>
                    </select>
                </div>
            </div>
            
            
            <div class="form-group">
                <div class = "col-sm-3">
                    <label class="control-label col-sm-2" for="Date" style = "margin-left:60px">Date:</label>
                </div>
                <div class="col-lg-8">
    
	<input type="Date" class="form-control" id="AppointmentDate" placeholder=" " name="AppointmentDate">
                </div>
            </div>
            
            <div class="form-group">
                <div class = "col-sm-3">
                    <label class="control-label col-sm-2" for="Date" style = "margin-left:60px">Time:</label>
                </div>
                <div class="col-lg-8">
                    <input type="Time" class="form-control" id="AppointmentDate" placeholder=" " name="AppointmentDate">
                </div>
            </div>
            
            <br/>
            <!--Button-->
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-lg-9" style="margin-left: 200px">
                    <input type="submit" class="btn btn-primary btn-lg" value="Submit">
                    <input type="submit" class="btn btn-primary btn-lg" value="Reset">
                </div>  
            </div>
            
        </form>
        
    </div>
    
  <div class="col-sm-6"></div>
</div>

</body>
</html>
    
    