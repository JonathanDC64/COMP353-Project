    
    
<?php 
include ('../includes/header.php'); 
include_once ('../includes/authentication/AccessRights.php'); 
include_once ('../includes/authentication/User.php');
include_once ('../includes/form/FormGenerator.php');
include_once("../database/database_connect.php");
include_once('../includes/appointment/Appointment.php');

$Patient_Appointment = Appointment::get_patient_appointment($_POST['Patient_ID']);
?> 


<div id="content">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#Patient-Search">Patient Search</a></li>
		<li><a data-toggle="tab" href="#Patients-List">Patients List</a></li>
	</ul>
	<div class="tab-content well">
        <div id="Patient-Search" class="tab-pane fade in active">
			<?php
                FormGenerator::generate_form("Patient Search", "../includes/authentication/patient_search.php", "Search successful",
					[
						FormGenerator::generate_element("PHN", "text", [])
					]
				);
            ?>
		</div>
		<div id="Patients-List" class="tab-pane fade in">
            <h2>Patients</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>PHN</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone Number</th>
                        <th>Age</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($PatientAppointments as $PatientAppointment) { ?>
                        <tr>
                            <td><?= sprintf("%08d",$PatientAppointment ["Date"]); ?></td>
                            <td><?= $Patient["First_Name"]; ?></td>
                            <td><?= $Patient["Last_Name"]; ?></td>
                            <td><?= $Patient["Phone_Number"]; ?></td>
                            <td><?= $Patient["Age"]; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
		</div>
	</div>

    
</div>

<?php include('../includes/footer.php'); ?>

    






/*
			foreach($PatientAppointments as $PatientAppointment){
				?>
				<tr>
					<td><?= $PatientAppointment["Date"]; ?></td>
					
					<td><a href='make_payment.php?AppointmentID=<?= $PatientAppointment["AppointmentID"]; ?>'>Make Payement</a></td>
				</tr>
				<?php
			}
		*/