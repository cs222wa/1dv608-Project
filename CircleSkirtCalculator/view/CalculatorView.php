<?php
namespace view;

class CalculatorView
{

    private static $measurement = 'CalculatorView::Measurement';
    private static $length = 'CalculatorView::Length';
    private static $messageId = 'CalculatorView::Message';
    private static $calculate = 'CalculatorView::Calculate';
    private static $skirtType = 'CalculatorView::SkirtType';
    private $message = "";
    private $skirtDAL;

    public function __construct(\model\SkirtDAL $skirtDAL){
        $this->skirtDAL = $skirtDAL;
    }

    //sends set error message to the calculation form
    public function response() {
        $message = $this->message;
        //render HTML view and message
        $response = $this->renderCalculationForm($message);
        return $response;
    }

    //Display calculation form and list of saved skirts
    private function renderCalculationForm($message)
    {
        return '
			<form action="?calculate" method="get" enctype="multipart/form-data">
				<fieldset>
					<legend>Circle Skirt Pattern Calculator</legend>
					<div id="msgholder">
					    <p class="errormessage" id="' . self::$messageId . '">' . $message . '</p>
					</div>
					<div id="skirtlabels">
                        <div class="formgroup">
                            <label for="' . self::$measurement . '" class="aligned">Waist circumference:</label>
                            <input type="text" size="20" id="' . self::$measurement . '" name="' . self::$measurement . '" value="' . $this->getMeasurement() . '" />
                        </div>
                        <div class="formgroup">
                            <label for="' . self::$length . '" class="aligned">Skirt length:</label>
                            <input type="text" size="20" id="' . self::$length . '" name="' . self::$length . '" value="' . $this->getLength() . '" />
                        </div>
					</div>
					<div id="radio" class="formgroup">
                        <input type="radio" name="' . self::$skirtType . '" value="'. \model\Skirt::$fullSkirt .'" '. $this->getSelectedTextForSkirtType(\model\Skirt::$fullSkirt) .' >
                        <label for="full">'. $this->getTypeText(\model\Skirt::$fullSkirt).'</label>
                        <input type="radio" name="' . self::$skirtType . '" value="'. \model\Skirt::$halfSkirt .'" '. $this->getSelectedTextForSkirtType(\model\Skirt::$halfSkirt) .' >
                        <label for="half">'. $this->getTypeText(\model\Skirt::$halfSkirt).'</label>
					</div>
                    <div class="formgroup">
                        <input type="submit" name="' . self::$calculate . '" value="Calculate" id="submitbutton"/>
                    </div>
				</fieldset>
			</form>
			'. $this->getSavedSkirtsHTML() .'
		';
    }

    //returns skirt object to controller in order to be saved.
    public function getSkirt(){
        try {
            return new \model\Skirt($this->getSkirtType(), $this->getMeasurement(), $this->getLength());
        } catch (\model\NoTypeException $e) {
            $this->message = "You must select a valid skirt type.";
        } catch (\model\NoCircumferenceException $e) {
            $this->message = "Waist circumference must be a number higher than 0 cm.";
        } catch (\model\NoLengthException $e) {
            $this->message = "Skirt length must be a number higher than 0 cm.";
        } catch (\model\CircumferenceInvalidException $e) {
            $this->message = "Waist circumference is invalid - it must be a number.";
        } catch (\model\LengthInvalidException $e) {
            $this->message = "Skirt length is invalid - it must be a number.";
        }
        return null;
    }

    //HTML for the list containing saved skirt calculations
    private function getSavedSkirtsHTML(){
        //place latest calculation first in array
        $skirts = array_reverse($this->skirtDAL->getSkirts());
        if(count($skirts)){
            $return = '<table id=sidebar>
                        <tr>
                        <th>Type</th>
                        <th>Circumference</th>
                        <th>Length</th>
                        <th></th>
                        </tr>';
            foreach($skirts as $skirt){
                /* @var $skirt \model\Skirt */
                $return .= '<tr>
                            <td>'.$this->getTypeText($skirt->getType()).'</td>
                            <td>'.$skirt->getCircumference().'</td>
                            <td>'.$skirt->getLength().'</td>
                            <td><a href="index.php?CalculatorView%3A%3AMeasurement='.$skirt->getCircumference().'&CalculatorView%3A%3ALength='.$skirt->getLength().'&CalculatorView%3A%3ASkirtType='.$skirt->getType().'&CalculatorView%3A%3ACalculate=Calculate">
                            Display Previous Skirt</a></td>
                           ';
            }
            $return .= '</table>';
            return $return;
        }
        return '';
    }

    //checks if user has clicked calculate button
    public function userWantsToCalculate(){
        if (isset($_REQUEST[self::$calculate])){
            return true;
        }
        //If calculate button is not clicked return false.
        return false;
    }

    //gets label text for Radio buttons in the calculation form
    private function getSelectedTextForSkirtType($value){
        if($value == $this->getSkirtType()){
            return 'checked="checked"';
        }
        return '';
    }

    //sets label text for radio buttons in calculations form
    private function getTypeText($value){
        if($value == \model\Skirt::$fullSkirt){
            return 'Full Circle';
        }
        if($value == \model\Skirt::$halfSkirt){
            return 'Half Circle';
        }
        return '';
    }

    //returns the selected skirt type to controller.
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

    //function used to display latest value of the measurement field in form & return it to the skirt object
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

    //function used to display the latest used skirt type in form & return it to the skirt object
    private function getSkirtType(){
         //control if the user have entered anything in the waist measurement field
        if (isset($_REQUEST[self::$skirtType])) {
            //return choice of skirt
            return $_REQUEST[self::$skirtType];
        }
        //if measurement field in the form is empty on submition - display empty form.
        return \model\Skirt::$fullSkirt;
    }

    //function used to display latest value of the skirt length field in form & return it to the skirt object
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
}