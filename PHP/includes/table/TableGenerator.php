<?php
    include_once("../includes/authentication/User.php");

    // Defines minimum access level required to perform update and delete operations
    class TablePermissions{
        public $UpdateAccessLevel;
        public $DeleteAccessLevel;

        function __construct($_UpdateAccessLevel, $_DeleteAccessLevel){
            $this->UpdateAccessLevel = $_UpdateAccessLevel;
            $this->DeleteAccessLevel = $_DeleteAccessLevel;
        }
    }

    class TableGenerator{
        public static function generate_table($Title, $ColumnNames, $RowData, $UpdateURL, $DeleteURL, $Permissions){
            $User = User::get_user_info();
            echo "
                <table class='table'>
                    <thead>
                        <tr>";
                            foreach($ColumnNames as $ColumnName){
                                TableGenerator::display_column($ColumnName);
                            }
                            if($User->AccessLevel >= $Permissions->UpdateAccessLevel){
                                echo "<th>Update</th>";
                            }
                            if($User->AccessLevel >= $Permissions->DeleteAccessLevel){
                                echo "<th>Delete</th>";
                            }
            echo "      </tr>
                    </thead>
                    <tbody>";
                        foreach($RowData as $Row){
                            TableGenerator::display_row($Row, $User->AccessLevel, $Permissions);
                        }
            echo "  </tbody>
                </table>
            ";
        }

        private static function display_column($ColumnName){
            echo "<th>$ColumnName</th>";
        }

        private static function display_row($Row, $AccessLevel, $Permissions){
            echo "<tr>";
                foreach($Row as $Cell){
                    echo "<td>";
                    echo $Cell;
                    echo "</td>";
                }
                if($AccessLevel >= $Permissions->UpdateAccessLevel){
                    echo "<td><button type='button' class='btn btn-primary'><span class='glyphicon glyphicon-pencil'></span></button></td>";
                }
                if($AccessLevel >= $Permissions->DeleteAccessLevel){
                    echo "<td><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></button></td>";
                }
            echo "</tr>";
        }

        public static function generate_permission($UpdateAccessLevel, $DeleteAccessLevel){
            return new TablePermissions($UpdateAccessLevel, $DeleteAccessLevel);
        }
    }
?>