<?php
namespace view;

class CalculatorView
{

    private static $measurement = 'CalculatorView::Measurement';
    private static $length = 'CalculatorView::Length';
    private static $messageId = 'CalculatorView::Message';
    private static $calculate = 'CalculatorView::Calculate';
    private static $fabricLength = 'CalculatorView::FabricLength';
    private static $fabricWidth = 'CalculatorView::FabricWidth';
    private static $skirtType = 'CalculatorView::SkirtType';
    private $message = "";
    public $measurementNotValid = false;
    public $measurementTooShort= false;
    public $lengthNotValid = false;
    public $lengthTooShort= false;
    public $fabricLengthTooShort = false;
    public $fabricLengthNotValid = false;
    public $fabricWidthTooShort = false;
    public $fabricWidthNotValid = false;
    public $noSkirtSelected = false;

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
			<form action="?calculate" method="get" enctype="multipart/form-data">
				<fieldset>
					<legend>Circle Skirt Pattern Calculator</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					<div id="skirtlabels">
					<label for="' . self::$measurement . '" class="aligned">Waist circumference:</label>
					<input type="text" size="20" id="' . self::$measurement . '" name="' . self::$measurement . '" value="' . $this->getMeasurement() . '" />
					<label for="' . self::$length . '" class="aligned">Skirt length:</label>
					<input type="text" size="20" id="' . self::$length . '" name="' . self::$length . '" value="' . $this->getLength() . '" />
					</div>
					<!---
					<div id="fabriclabels">
					<label for="' . self::$fabricLength . '" class="aligned">Fabric Length:</label>
					<input type="text" size="20" id="' . self::$fabricLength . '" name="' . self::$fabricLength . '" value="' . $this->getFabricLength() . '" required=false />
					<label for="' . self::$fabricWidth . '" class="aligned">Fabric Width:</label>
					<input type="text" size="20" id="' . self::$fabricWidth . '" name="' . self::$fabricWidth . '" value="' . $this->getFabricWidth() . '"  required=false />
					</div>-->
					<div id="radio">


					<input type="radio" name="' . self::$skirtType . '" value="'. \model\Skirt::$fullSkirt .'" '. $this->getSelectedTextForSkirtType(\model\Skirt::$fullSkirt) .' ><label for="full">Full Circle</label>
					<input type="radio" name="' . self::$skirtType . '" value="'. \model\Skirt::$halfSkirt .'" '. $this->getSelectedTextForSkirtType(\model\Skirt::$halfSkirt) .' ><label for="half">Half Circle</label>
					</div>
					<input type="submit" name="' . self::$calculate . '" value="Calculate" id="submitbutton"/>
				</fieldset>
			</form>
		';
    }

    public function getSkirt(){
       return new \model\Skirt($this->getSkirtType(), $this->getMeasurement(), $this->getLength());
    }


    //returns the selected skirt type to controller. true = full circle, false = half circle
    //if method returns null - no style have been selected and an error message will be shown
    public function getSkirtStyleChoice(){
        if(isset($_REQUEST[self::$skirtType])){
            $skirtType = $_REQUEST[self::$skirtType];
            if($skirtType == \model\Skirt::$fullSkirt){
                return true;
            }
            if($skirtType == \model\Skirt::$halfSkirt ){
                return false;
            }
        }
        return null;
    }

    private function getSkirtType(){
         //control if the user have entered anything in the waist measurement field
        if (isset($_REQUEST[self::$skirtType])) {
            //return value stripped of tags
            return $_REQUEST[self::$skirtType];
        }
        //if measurement field in the form is empty on submition - display empty form.
        return \model\Skirt::$fullSkirt;
    }

    private function getSelectedTextForSkirtType($value){
        if($value == $this->getSkirtType()){
            return 'checked="checked"';
        }
        return '';
    }

    //sets message
    public function setMessage() {

        if($this->$measurementNotValid){
            $this->message .= 'Measurement is not valid. It must be a number.';
        }
        if($this->measurementTooShort){
            $this->message .= 'Measurement must be a number higher than 0.';
        }
        if($this->$lengthNotValid){
            $this->message .= 'Skirt length is not valid. It must be a number.';
        }
        if($this->lengthTooShort){
            $this->message .= 'Skirt length must be a number higher than 0.';
        }
        if($this->fabricLengthNotValid){
            $this->message .= 'The length of the fabric is not valid. It must be a number.';
        }
        if($this->fabricLengthTooShort){
            $this->message .= 'Fabric length must be a number higher than 0.';
        }
        if($this->fabricWidthNotValid){
            $this->message .= 'The width of the fabric is not valid. It must be a number.';
        }
        if($this->fabricWidthTooShort){
            $this->message .= 'Fabric width must be a number higher than 0.';
        }
        if($this->noSkirtSelected){
            $this->message .= 'You must select a skirt type.';
        }
        if("" == $this->message){
            return true;
        }
        return false;

    }

    //function used to display latest value of the measurement field
    private function getMeasurement()
    {
        //control if the user have entered anything in the waist measurement field
        if (isset($_REQUEST[self::$measurement])) {
            //return value stripped of tags
            return strip_tags($_REQUEST[self::$measurement]);
        }
        //if measurement field in the form is empty on submition - display empty form.
        return "";
    }

    //function used to display latest value of the skirt length field
    private function getLength()
    {
        //control if the user have entered anything in the skirt length field
        if (isset($_REQUEST[self::$length])) {
            //return value stripped of tags
            return strip_tags($_REQUEST[self::$length]);
        }
        //if skirt length field in the form is empty on submition - display empty form.
        return "";
    }

    //function used to display latest value of the fabric length field
    private function getFabricLength()
    {
        //control if the user have entered anything in the fabric length field
        if (isset($_REQUEST[self::$fabricLength])) {
            //return value stripped of tags
            return strip_tags($_REQUEST[self::$fabricLength]);
        }
        //if fabric length field in the form is empty on submition - display empty form.
        return "";
    }

    //function used to display latest value of the fabric width field
    private function getFabricWidth()
    {
        //control if the user have entered anything in the fabric width field
        if (isset($_REQUEST[self::$fabricWidth])) {
            //return value stripped of tags
            return strip_tags($_REQUEST[self::$fabricWidth]);
        }
        //if fabric width field in the form is empty on submition - display empty form.
        return "";
    }


    //checks if user has clicked calculate button
    public function userWantsToCalculate(){
        if (isset($_REQUEST[self::$calculate])){
            return true;
        }
        //If calculate button is not clicked return false.
        return false;
    }


    public function getInputMeasurement(){
        //if a waist measurement has been posted
        if(isset($_REQUEST[self::$measurement])){
            $measurement = $_REQUEST[self::$measurement];
            //check for invalid characters - return true if not found, false if found
            if(!preg_match('/[^A-Za-z0-9.#\\-$]/', $measurement)){
                //check that the measurement is a number larger than 0
                if(is_numeric($measurement) && $measurement > 0){
                    //return measurement to controller
                    return $measurement;
                }
                $this->measurementTooShort = true;
                return false;
            }
            $this->measurementNotValid = true;
        }
        $this->measurementTooShort = true;
        return false;
    }

    public function getInputSkirtLength(){
        //if a skirt length has been posted
        if(isset($_REQUEST[self::$length])){
            $length = $_REQUEST[self::$length];
            //check for invalid characters - return true if not found, false if found
            if(!preg_match('/[^A-Za-z0-9.#\\-$]/', $length)){
                //check that the skirt length is a number larger than 0
                if(is_numeric($length) && $length > 0){
                    //return skirt length to controller
                    return $length;
                }
                $this->lengthTooShort = true;
                return false;
            }
            $this->lengthNotValid = true;
        }
        $this->lengthTooShort = true;
        return false;
    }

    public function getInputFabricLength(){
        //if a fabric length has been posted
        if(isset($_REQUEST[self::$fabricLength])){
            $length = $_REQUEST[self::$fabricLength];
            //check for invalid characters - return true if not found, false if found
            if(!preg_match('/[^A-Za-z0-9.#\\-$]/', $length)){
                //check that the fabric length is a number
                if(is_numeric($length)){
                    //return fabric length to controller
                    return $length;
                }
                $this->fabricLengthTooShort = true;
                return false;
            }
            $this->fabricLengthNotValid = true;
        }
        $this->fabricLengthTooShort = true;
        return false;
    }

    public function getInputFabricWidth(){
        //if a fabric width has been posted
        if(isset($_REQUEST[self::$fabricWidth])){
            $width = $_REQUEST[self::$fabricWidth];
            //check for invalid characters - return true if not found, false if found
            if(!preg_match('/[^A-Za-z0-9.#\\-$]/', $width)){
                //check that the fabric width is a number
                if(is_numeric($width)){
                    //return fabric width to controller
                    return $width;
                }
                $this->fabricWidthTooShort = true;
                return false;
            }
            $this->fabricWidthNotValid = true;
        }
        $this->fabricWidthTooShort = true;
        return false;
    }

}