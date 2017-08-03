<?php
    include_once("User.php");
    class AccessRights{

        # different access rights levels #

        // For Receptionist users only
        const AdminReceptionist = 3;

        // For Doctors, Nurses and Therapists
        const AdminHCP = 2;

        // For Patient users only
        const Patient = 1;

        public static function verify_admin_receptionist(){
            AccessRights::verify(AccessRights::AdminReceptionist, "Admin Receptionist");
        }

        public static function verify_admin_hcp(){
            AccessRights::verify(AccessRights::AdminHCP, "Admin HCP");
        }

        public static function verify_patient(){
            AccessRights::verify(AccessRights::Patient, "Patient");
        }

        private static function verify($Access, $Message){
            $User = User::get_user_info();
            if($User->AccessLevel < $Access){
                $access = $Message;
                include("forbiden.php");
                include("footer.php");
                die();
            }
        }
    }
?>