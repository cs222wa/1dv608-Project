<?php
namespace view;
class CalculatorView
{

    private static $measurement = 'RegisterView::Measurement';
    private static $messageId = 'RegisterView::Message';
    private static $calculate = 'RegisterView::Calculate';
    private $message = "";
    public $measurementNotValid = false;
    public $measurementTooShort= false;

    public function response() {
        $message = $this->message;
        //render HTML view and message
        $response = $this->renderCalculationForm($message);
        return $response;
    }

    //Display calculation form
    private function renderCalculationForm($message)
    {
        return '
			<form action="?calculate" method="post" enctype="multipart/form-data">
				<fieldset>
					<legend>Cirkle Skirt Pattern Calculator</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>

					<label for="' . self::$measurement . '">Waist circumference:</label>
					<input type="text" size="20" id="' . self::$measurement . '" name="' . self::$measurement . '" value="' . $this->getMeasurement() . '" />
					<input type="submit" name="' . self::$calculate . '" value="Calculate"/>
				</fieldset>
			</form>
		';
    }

    //sets message
    public function setMessage() {

        if($this->$measurementNotValid){
            $this->message .= 'User exists, pick another username.';
        }
        if($this->measurementTooShort){
            $this->message .= 'Username has too few characters, at least 3 characters.';
        }
        if("" == $this->message){
            return true;
        }
        return false;

    }

    private function getMeasurement()
    {
        //control if the user have entered anything in the measurement field
        if (isset($_POST[self::$measurement])) {
            //return value stripped of tags
            return strip_tags($_POST[self::$measurement]);
        }
        //if measurement field in the form is empty on submition - display empty form.
        return "";
    }

    //checks if user has clicked calculate button
    public function userWantsToCalculate(){
        if (isset($_POST[self::$calculate])){
            return true;
        }
        //If calculate button is not clicked return false.
        return false;
    }

    public function getInputMeasurement(){
        //if a username has been posted
        if(isset($_POST[self::$measurement])){
            $measurement = $_POST[self::$measurement];
            //check for invalid characters - return true if not found, false if found
            if(!preg_match('/[^A-Za-z0-9.#\\-$]/', $measurement)){
                //check that the measurement is a number larger than 0
                if(is_numeric($measurement) && $measurement > 0){
                    //return username to controller
                    return $measurement;
                }
                $this->$measurementTooShort = true;
                return false;
            }
            $this->$measurementNotValid = true;
        }
        $this->$measurementTooShort = true;
        return false;
    }
}