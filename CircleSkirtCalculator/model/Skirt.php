<?php
//Skirt class
namespace model;
class NoTypeException extends \Exception {};
class NoCircumferenceException extends \Exception {};
class NoLengthException extends \Exception {};
class CircumferenceInvalidException extends \Exception {};
class LengthInvalidException extends \Exception {};

class Skirt
{
    public static $fullSkirt = "fullskirt";
    public static $halfSkirt = "halfskirt";
    private $skirtType;
    private $circumference;
    private $radius;
    private $length;
    private $minFabric;

    public function __construct($type, $circumference, $length){
        if (!$type == self::$fullSkirt || !$type == self::$halfSkirt)
            throw new NoTypeException();
        if (is_numeric($circumference) == false || strlen($circumference) == 0)
            throw new NoCircumferenceException();
        if (is_numeric($length) == false || strlen($length) == 0)
            throw new NoLengthException();
        if (preg_match('/[^A-Za-z0-9.#\\-$]/', $circumference))
            throw new CircumferenceInvalidException();
        if (preg_match('/[^A-Za-z0-9.#\\-$]/', $length)){
            throw new LengthInvalidException();
        }

        $this->skirtType = $type;
        $this->circumference = $circumference;
        $this->length = $length;
        $this->radius = 0;
        $this->minFabric = 0;
    }

    public function getCircumference(){
        return $this->circumference;
    }

    public function getLength(){
        return $this->length;
    }

    public function getType(){
        return $this->skirtType;
    }

    public function getMinFabric(){
        return $this->minFabric;
    }

    //compare a saved skirt object with a new one to see if they are identical
    public function isSame(\model\Skirt $toCompare){
        return ($toCompare->getLength() == $this->getLength() && $toCompare->getCircumference() == $this->getCircumference() && $toCompare->getType() == $this->getType());
    }

    //select which type of skirt shall be calculated and return the result
    public function calculateRadius(){
        switch($this->skirtType){
            case self::$fullSkirt:
                $this->CalculateRadiusFullSkirt();
                break;
            case self::$halfSkirt:
                $this->CalculateRadiusHalfSkirt();
                break;
            default :
                throw new NoTypeException();;
        }
        return $this->radius;
    }

    //Calculates and returns the radius of a full circle skirt
    private function CalculateRadiusFullSkirt(){
        $this->radius=$this->circumference/(2*pi())-1;
        //calculate minimum pattern measurements.
        $this->minFabric = ($this->radius+$this->length) * 2;
    }

    //Calculates and returns the radius of a half circle skirt
    private function CalculateRadiusHalfSkirt(){
        $this->radius= (2*$this->circumference)/(2*pi())-1;
        //calculate minimum pattern measurements.
        $this->minFabric = ($this->radius+$this->length) * 2;
    }
}