    
    
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
	echo 'I am in';
		$Patient_Appointment_DR  = Appointment::get_patient_appointment_doctor($PatientID);
		$Patient_Appointment_TH = Appointment::get_patient_appointment_therapist($PatientID);
		$Patient_Notes = Appointment::retrieve_doctor_notes($PatientID);
		
		//var_dump($Patient_Appointment_DR, $Patient_Appointment_TH, $Patient_Notes);
}
var_dump($Patient_Appointment_DR);

?> 


<div id="content">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#Patient-Search">Patient Search</a></li>
		<li><a data-toggle="tab" href="#Patients-List">Patients List</a></li>
	</ul>
	<div class="tab-content well">
       	<div id="Patients-List" class="tab-pane fade in">
            <h2>Patients</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Doctor's First Name</th>
                        <th>Doctor's Last Name</th>
						<th> <a href= "#" >Details</a></th>
						
                     </tr>
                </thead>
				<tbody>
                    <?php foreach($Patient_Appointment_DR as $PatientAppointment) { ?>
                        <tr>
                            <td><?= sprintf("%08d",$PatientAppointment ["Date"]); ?></td>
                            <td><?= $PatientAppointment["First_Name"]; ?></td>
                            <td><?= $PatientAppointment["Last_Name"]; ?></td>                
                        </tr>
                    <?php } ?>
                </tbody>
				 <thead>
                    <tr>
                        <th>Date</th>
                        <th>Therapist's First Name</th>
                        <th>Therapist's Last Name</th>
                     </tr>
                </thead>
                <tbody>
                    <?php foreach($Patient_Appointment_TH as $PatientAppointment) { ?>
                        <tr>
                            <td><?= sprintf("%08d",$PatientAppointment ["Date"]); ?></td>
                            <td><?= $Patient_Appointment_TH["First_Name"]; ?></td>
                            <td><?= $Patient_Appointment_TH["Last_Name"]; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
		</div>
	</div>

    
</div>

<?php include('../includes/footer.php'); ?>

 z