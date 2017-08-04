<?php
    class TableGenerator{
        public static function generate_table($Title, $ColumnNames, $RowData){
            echo "
                <table class='table'>
                    <thead>
                        <tr>";
                            foreach($ColumnNames as $ColumnName){
                                TableGenerator::display_column($ColumnName);
                            }
            echo "      </tr>
                    </thead>
                    <tbody>";
                        foreach($RowData as $Row){
                            TableGenerator::display_row($Row);
                        }
            echo "  </tbody>
                </table>
            ";
        }

        private static function display_column($ColumnName){
            echo "<th>$ColumnName</th>";
        }

        private static function display_row($Row){
            echo "<tr>";
                foreach($Row as $Cell){
                    echo "<td>";
                    echo $Cell;
                    echo "</td>";
                }
            echo "</tr>";
        }
    }
?>