<?php 
    $pageTitle = 'My Appointment';
    include_once ("../includes/appointment/Appointment.php");
    include_once ("../includes/authentication/User.php");
    include ('../includes/header.php');
    $User = User::get_user_info();
    $UserID = $User->UserID;

    if(isset($_GET["AppointmentID"], $_GET["Type"]) && !empty($_GET["AppointmentID"])&& !empty($_GET["Type"])){
        $AppointmentID = $_GET["AppointmentID"];
        $Type = $_GET["Type"];
        if($User->Role == "Patient"){
            $PatientID = User::retrieve_patient($UserID)["PatientID"];
            //validate that user is patient
            if(Appointment::validate_patient_appointment($AppointmentID, $PatientID)){
                $Appointment = null;
                $Prescription = null;
                $Title = null;
                if($Type == "Doctor"){
                    $Appointment = Appointment::get_patient_doctor_appointment($AppointmentID)[0];
                    $Prescription = Appointment::get_doctor_prescription($AppointmentID)[0];
                    $Title = "Doctors Appointment";
                }
                else{ //Therapist
                    $Appointment = Appointment::get_patient_therapist_appointment($AppointmentID)[0];
                    $Prescription = Appointment::get_therapist_prescription($AppointmentID)[0];
                    $Title = "Therapist Appointment";
                }
?>
                <div id="content">
                    <h2><?= $Title; ?></h2>
                    <table class="table well">
                        <tr>
                            <td><strong>Appointment ID:</strong></td>
                            <td><?= $Appointment["AppointmentID"];  ?></td>
                        </tr>
                        <tr>
                            <td><strong>Appointment Date:</strong></td>
                            <td><?= $Appointment["Appointment_Date"] ?></td>
                        </tr>
                        <tr>
                            <td><strong>Doctor Name:</strong></td>
                            <td><?= $Appointment["First_Name"] . " " . $Appointment["Last_Name"]; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Doctors Note:</strong></td>
                            <td><?= isset($Prescription["DoctorsNote"]) ? $Prescription["DoctorsNote"] : ""; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Diagnosis:</strong></td>
                            <td><?= isset($Prescription["Diagnosis"]) ? $Prescription["Diagnosis"] : ""; ?></td>
                        </tr>
                    </table>
                </div>
<?php
            }
            else{
                echo "This is not your appointment.";
            }
        }
        elseif($User->Role == "Doctor" || $User->Role == "Therapist"){
            $Appointment = null;
            $validated = false;
            $UpdateButton = null;
            if($User->Role == "Doctor"){
                $DoctorID = User::retrieve_doctor($User->UserID);
                $Appointment = Appointment::get_doctor_patient_appointment($AppointmentID)[0];
                $Prescription = Appointment::get_doctor_prescription($AppointmentID)[0];
                $UpdateButton = "DoctorAppointment";
                if(Appointment::validate_doctor_appointment($AppointmentID, $DoctorID)){
                    $validated = true;
                }
            }
            else{
                $TherapistID = User::retrieve_therapist($User->UserID)["TherapistID"];
                $Appointment = Appointment::get_therapist_patient_appointment($AppointmentID)[0];
                $Prescription = Appointment::get_therapist_prescription($AppointmentID);
                $UpdateButton = "TherapistAppointment";
                if(Appointment::validate_therapist_appointment($AppointmentID, $TherapistID)){
                    $validated = true;
                }
            }

            if($validated){
                $Prescription = count($Prescription) > 0 ? $Prescription[0] : null;
?>
                <div id="content">
                    <h2>My <?= $User->Role; ?> Appointment</h2>
                    <a href="<?= $UpdateButton; ?>.php?AppointmentID=<?= $Appointment["AppointmentID"]; ?>&Type=<?= $User->Role; ?>" class='btn btn-info' role='button'>Update Record</a>						
                    <table class="table well">
                        <tr>
                            <td><strong>Appointment ID:</strong></td>
                            <td><?= $Appointment["AppointmentID"];  ?></td>
                        </tr>
                        <tr>
                            <td><strong>Appointment Date:</strong></td>
                            <td><?= $Appointment["Appointment_Date"] ?></td>
                        </tr>
                        <tr>
                            <td><strong>Patient Name:</strong></td>
                            <td><?= $Appointment["First_Name"] . " " . $Appointment["Last_Name"]; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Doctors Note:</strong></td>
                            <td><?= isset($Prescription["DoctorsNote"]) ? $Prescription["DoctorsNote"] : ""; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Diagnosis:</strong></td>
                            <td><?= isset($Prescription["Diagnosis"]) ? $Prescription["Diagnosis"] : ""; ?></td>
                        </tr>
                    </table>
                </div>
<?php
            }
            else{
                echo "This is not your appointment.";
            }
        }
    }
    else{
        header("Location: my_appointments.php");
    }
    include('../includes/footer.php'); 
?>