<?php
    class Reports{
        //1)
        public static function num_therapist_patients($StartDate, $EndDate){
            global $connection;
            $stmt = $connection->prepare(
            "SELECT COUNT(PatientID) AS Number_Of_Patients, Therapist.TherapistID, First_Name, Last_Name
                FROM Patient
                INNER JOIN Appointment USING(PatientID)
                INNER JOIN TherapistAppointment USING(AppointmentID)
                INNER JOIN Therapist USING(TherapistID)
                INNER JOIN User ON Therapist.UserID = User.UserID
                INNER JOIN UserInformation ON User.UserID = UserInformation.UserID
                WHERE Appointment_Date between DATE(':StartDate') AND DATE(':EndDate')
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
    }
?>