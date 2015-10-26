<?php
//Skirt class
namespace model;
class Skirt
{
    public $skirtType;
    public $radius;
    public $length;
    public $minFabric;

    public function __construct(){
        $this->skirtType = 0;
        $this->radius = 0;
        $this->length = 0;
        $this->minFabric = 0;

    }

    //Calculates and returns the radius of a full circle skirt
    public function CalculateRadiusFullSkirt($c, $length){
        $this->radius=$c/(2*pi())-1;
        $this->skirtType = 1;
        $this->length = $length;
        //calculate minimum pattern measurements.
        $this->minFabric = ($this->radius+$this->length) * 2;
        return $this->radius;
    }

    //Calculates and returns the radius of a half circle skirt
    public function CalculateRadiusHalfSkirt($c, $length){
        $this->radius= (2*$c)/(2*pi())-1;
        $this->skirtType = 2;
        $this->length = $length;
        //calculate minimum pattern measurements.
        $this->minFabric = ($this->radius+$this->length) * 2;
        return $this->radius;
    }
}