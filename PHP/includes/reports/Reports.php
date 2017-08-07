<?php
    class Reports{
        //1)
        public static function num_therapist_patients($StartDate, $EndDate){
            global $connection;
            $stmt = $connection->prepare(
            "SELECT COUNT(PatientID) AS Number_Of_Patients, Therapist.TherapistID, CONCAT(First_Name, ' ', Last_Name) AS Therapist_Name
                FROM Patient
                INNER JOIN Appointment USING(PatientID)
                INNER JOIN TherapistAppointment USING(AppointmentID)
                INNER JOIN Therapist USING(TherapistID)
                INNER JOIN User ON Therapist.UserID = User.UserID
                INNER JOIN UserInformation ON User.UserID = UserInformation.UserID
                WHERE Appointment_Date between DATE(:StartDate) AND DATE(:EndDate)
                GROUP BY Therapist.TherapistID");
            
            $stmt->bindParam(':StartDate', $StartDate);
            $stmt->bindParam(':EndDate', $EndDate);

            $stmt->execute();

            return $stmt->fetchAll();
        }

        //2)
        public static function equipment_never_used(){
            global $connection;
            $stmt = $connection->prepare(
            "SELECT EquipmentID, Name 
                FROM Equipment
                WHERE EquipmentID NOT IN (
                    SELECT EquipmentID 
                    FROM Equipment 
                    INNER JOIN Treatment USING(EquipmentID)
                )"
            );

            $stmt->execute();

            return $stmt->fetchAll();
        }

        //3)
        public static function patients_list(){
            global $connection;
            $stmt = $connection->prepare(
            "SELECT PatientID, CONCAT(First_Name, ' ', Last_Name) AS Patient_Name, Phone_Number, Age
                FROM Patient
                INNER JOIN User ON Patient.UserID = User.UserID
                INNER JOIN UserInformation ON User.UserID = UserInformation.UserID
            "
            );

            $stmt->execute();

            return $stmt->fetchAll();
        }

        //4)
        public static function therapist_list(){
            global $connection;
            $stmt = $connection->prepare(
            "SELECT TherapistID, CONCAT(First_Name, ' ', Last_Name) AS Therapist_Name, Phone_Number, Age, Experience
                FROM Therapist
                INNER JOIN User ON Therapist.UserID = User.UserID
                INNER JOIN UserInformation ON User.UserID = UserInformation.UserID
            "
            );

            $stmt->execute();

            return $stmt->fetchAll();
        }

        //5)
        public static function working_therapist_list(){
            global $connection;
            $stmt = $connection->prepare(
            "SELECT DISTINCT Therapist.TherapistID, CONCAT(First_Name, ' ', Last_Name) AS Therapist_Name, Phone_Number, Age, Experience
                FROM Therapist
                INNER JOIN User ON Therapist.UserID = User.UserID
                INNER JOIN UserInformation ON User.UserID = UserInformation.UserID
                INNER JOIN TherapistAppointment ON Therapist.TherapistID = TherapistAppointment.TherapistID
            "
            );

            $stmt->execute();

            return $stmt->fetchAll();
        }

        //6)
        public static function patient_doctor_reservations($PatientID){
            global $connection;
            $stmt = $connection->prepare(
            "SELECT DoctorID, CONCAT(First_Name, ' ', Last_Name) AS Doctor_Name, Appointment_Date 
                FROM Appointment
                INNER JOIN DoctorAppointment USING(AppointmentID)
                INNER JOIN Doctor USING(DoctorID)
                INNER JOIN User ON Doctor.UserID = User.UserID
                INNER JOIN UserInformation ON User.UserID = UserInformation.UserID
                WHERE PatientID = :PatientID;
            "
            );

            $stmt->bindParam(':PatientID', $PatientID);

            $stmt->execute();

            return $stmt->fetchAll();
        }

        public static function patient_therapist_reservations($PatientID){
            global $connection;
            $stmt = $connection->prepare(
            "SELECT TherapistID, CONCAT(First_Name, ' ', Last_Name) AS Therapist_Name, Appointment_Date 
                FROM Appointment
                INNER JOIN TherapistAppointment USING(AppointmentID)
                INNER JOIN Therapist USING(TherapistID)
                INNER JOIN User ON Therapist.UserID = User.UserID
                INNER JOIN UserInformation ON User.UserID = UserInformation.UserID
                WHERE PatientID = :PatientID;
            "
            );

            $stmt->bindParam(':PatientID', $PatientID);

            $stmt->execute();

            return $stmt->fetchAll();
        }

        //7)
        public static function doctor_availabilities($DoctorID, $StartDate, $EndDate){

        }

        public static function therapist_availabilities($TherapistID, $StartDate, $EndDate){

        }
    }
?>