<?php 
    $pageTitle = 'HCP Appointment';
    include ('../includes/header.php'); 
    include_once ('../includes/authentication/AccessRights.php'); 
	include_once('../includes/appointment/appointment2.php');
	include_once('../includes/authentication/user.php');
    include_once ('../includes/form/FormGenerator.php'); 
    AccessRights::verify_patient();
	
	$UserInfo=user::get_user_info();
	
	$UserID=$UserInfo->UserID;
	$UserType=$UserInfo->Role;
	

	if($UserType=="Patient")
	{
		$PatientID=Appointment::retrive_patientID($UserID);
		$Appointment=Appointment::retrive_patient_appointment($PatientID);
	}
	elseif($UserType=="Doctor")
	{
		$DoctorID=Appointment::retrive_doctorID($UserID);
		$Appointment=Appointment::retrive_doctor_appointment($DoctorID);
	}
	elseif($UserType=="Therapist")
	{
		$TherapistID=Appointment::retrive_therapistID($UserID);
		$Appointment=Appointment::retrive_therapist_appointment($TherapistID);	
	}
?>


		<div id="content">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#Appointments">Appointments</a></li>
			</ul>
			<div class="tab-content well">
			<div id="Appointments" class="tab-pane fade in active">
			<h2>Appointments</h2>
					<table class="table">
						<thead>
							<tr>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>	
							<?php foreach($Appointment as $Appointment) { ?>
								<tr>
									<td><?= $Appointment["First_Name"]; ?></td>
									<td><?= $Appointment["Last_Name"]; ?></td>
									<td><?= $Appointment["Appointment_Date"]; ?></td>
									<td>	
							  <?php 
									if($UserType=="Doctor")
									{?>
										<div class="col-sm-offset-2 col-lg-4">
											<a href="DoctorAppointment.php?AppointmentID=<?= $Appointment["DoctorAppointmentID"]?>" style ="width:150px" class="btn btn-primary" role="button">Information</a>										
										</div>	
							  <?php } 
									elseif($UserType=="Therapist")
									{?>
										<div class="col-sm-offset-2 col-lg-4">
											<a href="TherapistAppointment.php?AppointmentID=<?= $Appointment["TherapistAppointmentID"]?>" style ="width:150px" class="btn btn-primary" role="button">Information</a>										
										</div>	
							  <?php }
									elseif($UserType=="Patient")
									{?>
										<div class="col-sm-offset-2 col-lg-4">
											<a href="appointment.php?PatientID=<?= $Appointment["PatientID"]?>" style ="width:150px" class="btn btn-primary" role="button">Information</a>										
										</div>	
							  <?php }?>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>	
		</div>



<?php include('../includes/footer.php'); ?>