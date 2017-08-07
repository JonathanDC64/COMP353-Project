<?php 
    $pageTitle = 'Reports';
    include ('../includes/header.php'); 
    include_once ('../includes/authentication/AccessRights.php');
    include_once ('../includes/form/FormGenerator.php'); 
    include_once ('../includes/reports/Reports.php');
    include_once ("../includes/authentication/User.php");
    AccessRights::verify_admin_receptionist();
?>

<div id="content">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#Therapist-Patients">Therapist Number Of Patients</a></li>
		<li><a data-toggle="tab" href="#Equipment-Never-Used">Equipment Never Used</a></li>
        <li><a data-toggle="tab" href="#Patient-Visitation-List">Patient Visitation List</a></li>
        <li><a data-toggle="tab" href="#Therapist-Visitation-List">Therapist Visitation List</a></li>
        <li><a data-toggle="tab" href="#Working-Therapist-List">Working Therapist List</a></li>
        <li><a data-toggle="tab" href="#Patient-Reservations">Patient Reservations</a></li>
	</ul>
	<div class="tab-content well">
        <div id="Therapist-Patients" class="tab-pane fade in active">
            <?php
                FormGenerator::generate_form("Therapist Number Of Patients", "../includes/reports/number_of_patients.php", "Search successful",
					[
						FormGenerator::generate_element("Start_Date", "date", []),
                        FormGenerator::generate_element("End_Date", "date", [])
					]
				);
            ?>
		</div>
        <div id="Equipment-Never-Used" class="tab-pane fade in">
            <h2>Equipment Never Used</h2>
			<table class="table">
                <thead>
                    <tr>
                        <th>Equipment ID</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $EquipmentNeverUsed = Reports::equipment_never_used();
                        foreach($EquipmentNeverUsed as $Equipment) { ?>
                        <tr>
                            <td><?= $Equipment["EquipmentID"]; ?></td>
                            <td><?= $Equipment["Name"]; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
		</div>
        <div id="Patient-Visitation-List" class="tab-pane fade in">
            <h2>Patient Visitation List</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Patient ID</th>
                        <th>Patient Name</th>
                        <th>Phone Number</th>
                        <th>Age</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $Patients = Reports::patients_list();
                        foreach($Patients as $Patient) { ?>
                        <tr>
                            <td><?= $Patient["PatientID"]; ?></td>
                            <td><?= $Patient["Patient_Name"]; ?></td>
                            <td><?= $Patient["Phone_Number"]; ?></td>
                            <td><?= $Patient["Age"]; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div id="Therapist-Visitation-List" class="tab-pane fade in">
            <h2>Therapist Visitation List</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Therapist ID</th>
                        <th>Therapist Name</th>
                        <th>Phone Number</th>
                        <th>Age</th>
                        <th>Experience</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $Therapists = Reports::therapist_list();
                        foreach($Therapists as $Therapist) { ?>
                        <tr>
                            <td><?= $Therapist["TherapistID"]; ?></td>
                            <td><?= $Therapist["Therapist_Name"]; ?></td>
                            <td><?= $Therapist["Phone_Number"]; ?></td>
                            <td><?= $Therapist["Age"]; ?></td>
                            <td><?= $Therapist["Experience"]; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div id="Working-Therapist-List" class="tab-pane fade in">
            <h2>Working Therapist List</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Therapist ID</th>
                        <th>Therapist Name</th>
                        <th>Phone Number</th>
                        <th>Age</th>
                        <th>Experience</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $WorkingTherapists = Reports::working_therapist_list();
                        foreach($WorkingTherapists as $WorkingTherapist) { ?>
                        <tr>
                            <td><?= $WorkingTherapist["TherapistID"]; ?></td>
                            <td><?= $WorkingTherapist["Therapist_Name"]; ?></td>
                            <td><?= $WorkingTherapist["Phone_Number"]; ?></td>
                            <td><?= $WorkingTherapist["Age"]; ?></td>
                            <td><?= $WorkingTherapist["Experience"]; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div id="Patient-Reservations" class="tab-pane fade in">
            <?php
                $Patients = User::retrieve_patients();
                $Patients_Select = array();
                foreach($Patients as $Patient){
                    array_push($Patients_Select, [$Patient["PatientID"], $Patient["First_Name"] . " " . $Patient["Last_Name"]]);
                }
	
                FormGenerator::generate_form("Patient Reservations", "../includes/reports/patient_reservations.php", "Search successful",
					[
						FormGenerator::generate_element("Patient", "select", $Patients_Select)
					]
				);
            ?>
		</div>
	</div>
</div>

<?php include ('../includes/footer.php'); ?>