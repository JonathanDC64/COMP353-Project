<?php 
	session_start();
	include_once('../includes/authentication/User.php');
	include_once('../includes/database/database_connect.php'); 
	
	//redirect user to login page if not logged in
	/*if(basename($_SERVER['PHP_SELF']) != "login.php" && !User::loggedin()){
		header('Location: login.php');
	}*/

	// check if we are on local machine or school server
	/*if (strpos($_SERVER['DOCUMENT_ROOT'], 'xampp') !== false) {
		set_include_path("/COMP353-Project/PHP/includes");
	}
	else{
		set_include_path("/includes");
	}*/
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BSPC : <?= isset($pageTitle) ? $pageTitle : '' ?></title>
	<link rel=" shortcut icon" type="image/ico" href="../webroot/favicon.ico?v=1" />
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="../webroot/js/jquery.min.js"></script>
	<script>
		function IsJsonString(str) {
			try {
				JSON.parse(str);
			} catch (e) {
				return false;
			}
			return true;
		}
	</script>
</head>
<body>
	<div class="container">
		<div id="header">
			<div class="page-header">
				<h1>
					Bahamas Sports Physio Center
				</h1>
			</div>

			<!--Navbar-->
			<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="#">BSPC</a>
					</div>
					<?php if(User::loggedin()) : ?>
					<ul class="nav navbar-nav">
						<li class=""><a href="index.php">Home</a></li>
						<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Administration <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="registration.php">Registration</a></li>
							<li><a href="appointment.php">Appointment</a></li>
							<li><a href="prescription.php">Prescription</a></li>
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
						<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span>Logout</a></li>
					</ul>
					<?php endif; ?>
				</div>
			</nav>
		</div>