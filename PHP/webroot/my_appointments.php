    
    
<?php 
include ('../includes/header.php'); 
include_once ('../includes/authentication/AccessRights.php'); 
include_once ('../includes/authentication/User.php');
include_once ('../includes/form/FormGenerator.php');
include_once ("../includes/database/database_connect.php");
include_once ('../includes/appointment/Appointment.php');

$User = User::get_user_info();

if($User->Role == "Patient" ){
    $Patient_Appointment_DR  = Appointment::get_patient_appointment_doctor();
    $Patient_Appointment_TH = Appointment::get_patient_appointment_therapist();
}


?> 


<div id="content">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#Doctor-Appointments">Doctor Appointments</a></li>
		<li><a data-toggle="tab" href="#Therapist-Appointments">Therapist Appointments</a></li>
	</ul>
    <div class="tab-content well">
        <div id="Doctor-Appointments" class="tab-pane fade in active">
            <h2>Doctor Appointments</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>First Name</th>
                        <th>Last Name</th>
						<th>Type</th>
                        <th>View Details<th/>
                    </tr>
                </thead>
				<tbody>
                    <?php foreach($Patient_Appointment_DR as $PatientAppointment) { ?>
                        <tr>
                            <td><?= $PatientAppointment ["Appointment_Date"];?></td>
                            <td><?= $PatientAppointment["First_Name"]; ?></td>
                            <td><?= $PatientAppointment["Last_Name"]; ?></td>
                            <td>Doctor</td>
                            <td>
                            <a href="my_appointment.php?AppointmentID=<?= $PatientAppointment["AppointmentID"] ?>&Type=Doctor" class="btn btn-info" role="button">View Details</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div  id="Therapist-Appointments" class="tab-pane fade in">
            <h2>Therapist Appointments</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>First Name</th>
                        <th>Last Name</th>
						<th>Type</th>
                        <th>View Details<th/>
                    </tr>
                </thead>
				<tbody>
                    <?php foreach($Patient_Appointment_TH as $Patient_Appointment_TH) { ?>
                        <tr>
                            <td><?= $Patient_Appointment_TH ["Appointment_Date"]; ?></td>
                            <td><?= $Patient_Appointment_TH["First_Name"]; ?></td>
                            <td><?= $Patient_Appointment_TH["Last_Name"]; ?></td>
                            <td>Therapist</td>
                            <td>
                            <a href="my_appointment.php?AppointmentID=<?= $Patient_Appointment_TH["AppointmentID"] ?>&Type=Therapist" class="btn btn-info" role="button">View Details</a>
                            </td>
                        </tr>
                    <?php } ?>
            </table>
        </div>
</div>

<?php include('../includes/footer.php'); ?>
