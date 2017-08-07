<?php
    if(!isset($connection)){
        include_once ("../database/database_connect.php");
    }
    
    include_once ('Reports.php');
    if(isset($_POST["Patient"])){
        $PatientID = $_POST["Patient"];
        $DoctorReservations = Reports::patient_doctor_reservations($PatientID);
        $TherapistReservations = Reports::patient_therapist_reservations($PatientID);
?>
        <div class="row">
            <div class="col-md-6">
                <h2>Doctor Appointments</h2>
                <table class="table well">
                    <thead>
                        <tr>
                            <th>Doctor ID</th>
                            <th>Doctor Name</th>
                            <th>Appointment Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($DoctorReservations as $DoctorReservation) { ?>
                            <tr>
                                <td><?= $DoctorReservation["DoctorID"]; ?></td>
                                <td><?= $DoctorReservation["Doctor_Name"]; ?></td>
                                <td><?= $DoctorReservation["Appointment_Date"]; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-6">
                <h2>Therapist Appointments</h2>
                <table class="table well">
                    <thead>
                        <tr>
                            <th>Therapist ID</th>
                            <th>Therapist Name</th>
                            <th>Appointment Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($TherapistReservations as $TherapistReservation) { ?>
                            <tr>
                                <td><?= $TherapistReservation["TherapistID"]; ?></td>
                                <td><?= $TherapistReservation["Therapist_Name"]; ?></td>
                                <td><?= $TherapistReservation["Appointment_Date"]; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

<?php
    }
    else{
        echo "Missing fields";
    }
?>