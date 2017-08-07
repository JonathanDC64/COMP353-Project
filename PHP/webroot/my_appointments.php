    
    
<?php 
include ('../includes/header.php'); 
include_once ('../includes/authentication/AccessRights.php'); 
include_once ('../includes/authentication/User.php');
include_once ('../includes/form/FormGenerator.php');
include_once("../includes/database/database_connect.php");
include_once('../includes/appointment/Appointment.php');

$PatientID = User::get_user_info();
//var_dump($PatientID);
//$PatientID = $PatientID->UserID;
 /*$sql = $connection->prepare('SELECT PatientID FROM Patient WHERE UserID = :PatientID');
 $sql->bindParam(":PatientID",$PatientID);
 $sql->execute();
 $result = $sql->fetchAll();*/
// var_dump($PatientID->Role);

if($PatientID->Role == "Patient" ){
	
		$Patient_Appointment_DR  = Appointment::get_patient_appointment_doctor($PatientID);
		$Patient_Appointment_TH = Appointment::get_patient_appointment_therapist($PatientID);
		$Patient_Notes = Appointment::retrieve_doctor_notes($PatientID);
		
		//var_dump($Patient_Appointment_DR, $Patient_Appointment_TH, $Patient_Notes);
}


?> 


<div id="content">
    
       	<div id="Patients-List">
            <h2>Patients</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>First Name</th>
                        <th>Last Name</th>
						<th>Type</th>
                        <th>Details</th>
                     </tr>
                </thead>
				<tbody>
                    <?php foreach($Patient_Appointment_DR as $PatientAppointment) { ?>
                        <tr>
                            <td><?= $PatientAppointment ["Appointment_Date"];?></td>
                            <td><?= $PatientAppointment["First_Name"]; ?></td>
                            <td><?= $PatientAppointment["Last_Name"]; ?></td>
                            <td>Doctor</td>
                            <td>Details</td>
                        </tr>
                    <?php } ?>
                
                    <?php foreach($Patient_Appointment_TH as $Patient_Appointment_TH) { ?>
                        <tr>
                            <td><?= $Patient_Appointment_TH ["Appointment_Date"]; ?></td>
                            <td><?= $Patient_Appointment_TH["First_Name"]; ?></td>
                            <td><?= $Patient_Appointment_TH["Last_Name"]; ?></td>
                            <td>Therapist</td>
                        </tr>
                    <?php } ?>
            </table>
		</div>

    
</div>

<?php include('../includes/footer.php'); ?>
