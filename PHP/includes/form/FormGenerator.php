<?php
    class FormElement{
        public $Name;
        public $Type;
        public $Values;

        function __construct($_Name, $_Type, $_Values){
            $this->Name = $_Name;
            $this->Type = $_Type;
            $this->Values = $_Values;
        } 
    }

    class FormGenerator{
        public static function generate_form($Title, $Action, $Success, $Elements){
            echo "
                <script>
                    $(function(){
                        $('#$Title').on('click', function(){
                            $.ajax({
                                type: 'POST',
                                url: '$Action',
                                data: $('#$Title-Form').serialize(),
                                success: function(response) {
                                    if(response != '')
                                        $('#errors').html(response);
                                    else
                                        $('#errors').html('$Success');
                                }
                            });
                        });
                    });
                </script>
                <div class='page-header text-center'>
                    <h2>$Title</h2>
                </div>
                <div class='row'>
                    <div class='col-md-6 col-md-offset-3'>
                        <div class='jumbotron'>
                            <form class='form-horizontal' method='POST' id='$Title-Form' action='$Action'>";
                                foreach ($Elements as $Element) {
                                    FormGenerator::display_element($Element);
                                }
                echo "
                                <input type='hidden' name='submitted' value='true' />
                                <div class='form-group'>
                                    <label class='control-label' for='$Title'></label>
                                    <input type='button' class='btn btn-success btn-block' role='button' id='$Title' value='$Title'>
                                    <div id='errors'></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            ";
        }

        private static function display_element($Element){
            $Name = $Element->Name;
            $Type = $Element->Type;
            echo "<div class='form-group'>
                    <label class='control-label' for='$Name'>$Name:</label>";
            switch($Element->Type){
                case "text":
                case "password":
                    echo "<input type='$Type' class='form-control' id='$Name' placeholder='$Name' name='$Name'>";
                    break;
                case "select":
                    echo "<select class='form-control' id='$Name' name='$Name'>";
                    foreach ($Element->Values as $Value) {
                        echo "<option value='$Value'>$Value</option>";
                    }
                    echo "</select>";
                    break;
            }
            echo "</div>";
        }

        public static function generate_element($Name, $Type, $Values){
            return new FormElement($Name, $Type, $Values);
        }
    }
?>