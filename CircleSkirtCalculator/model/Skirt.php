<?php
//Skirt class
namespace model;
class Skirt
{

    //Calculates and returns the radius of a full circle skirt
    public function CalculateRadiusFullSkirt($c){
        $r=$c/(2*pi())-1;
        return $r;
    }

    //Calculates and returns the radius of a half circle skirt
    public function CalculateRadiusHalfSkirt($c){
        $r= (2*$c)/(2*pi())-1;
        return $r;
    }
}