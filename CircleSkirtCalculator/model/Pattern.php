<?php
//Skirt class
namespace model;
class Pattern
{
    //Calculates if fabric dimensions are enough to make a full skirt
    public function SetFullSkirtFabricDimension($r, $l, $fl, $fw){

        //fold fabric in half twice
        $fabricLength = $fl/2;
        $fabricWidth = $fw/2;

        $skirtLength = $r+$l;

        CalculateSkirtFabricFit($skirtLength, $fabricLength, $fabricWidth);
    }

    //Calculates if fabric dimensions are enough to make a half skirt
    public function SetHalfSkirtFabricDimension($r, $l, $fl, $fw){

        //only fold fabric in half once
        $fabricLength = $fl/2;
        $fabricWidth = $fw;

        $skirtLength = $r+$l;

        CalculateSkirtFabricFit($skirtLength, $fabricLength, $fabricWidth);
    }

    public function CalculateSkirtFabricFit($skirtLength, $fabricLength, $fabricWidth){

        if($fabricLength - $skirtLength <0){
            //fabric is too small - save as public variable $fabricLengthTooSmall
            //store margin of $fabricLength - $skirtLengt as public $fabricLengthMargin
        }
        else{
            //store margin of $fabricLength - $skirtLengt as public $fabricLengthMargin
        }


        if($fabricWidth - $skirtLength <0){
            //fabric is too small - save as public variable $fabricWidthTooSmall
            //store margin of $fabricWidth - $skirtLengt as public $fabricWidthMargin
        }
        else{
            //store margin of $fabricLength - $skirtLengt as public $fabricLengthMargin
        }
    }
}