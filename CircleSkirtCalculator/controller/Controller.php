<?php
namespace controller;
class Controller
{
    private $calcView;
    private $skirtView;
    private $skirt;


    public function __construct( \view\CalculatorView $calculatorV, \view\SkirtView $skirtV, \model\Skirt $skirtM){
        $this->calcView = $calculatorV;
        $this->skirtView = $skirtV;
        $this->skirt = $skirtM;
    }

    //Initiates calculations process.
    //if no calculation could be performed, doCalculate returns false.
    public function doCalculate(){
        //control if user have pressed the calculate button
        if($this->calcView->userWantsToCalculate())
       {
           //if user wants to make a calculation, proceed with getting form input.
           $waistCircumference = $this->calcView->getInputMeasurement();
           $skirtLength = $this->calcView->getInputSkirtLength();
           //fetch skirt type choice
           $skirtType = $this->calcView->getSkirtStyleChoice();
           if($skirtType){
            //full skirt selected
               $this->skirt->CalculateRadiusFullSkirt($waistCircumference, $skirtLength);
           }
           else{
               //half skirt selected
               $this->skirt->CalculateRadiusHalfSkirt($waistCircumference, $skirtLength);

           }
           return true;
       }
        else{
            //if user haven't pressed the button, return false.
            return false;
        }
    }
}