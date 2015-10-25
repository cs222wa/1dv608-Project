<?php
namespace controller;
class Controller
{
    private $calcView;
    private $skirtView;
    private $skirt;


    public function __Controller($calcView, $skirtView, $skirtModel){
        $this->calcView = $calcView;
        $this->skirtView = $skirtView;
        $this->skirt = $skirtModel;
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

           //hämta ut val av kjolstyp

           //if fabric width & length != 0 - räkna ut om tyget räcker
           //om det ej angets, räkna endast ut kjolmönstrets mått



           return true;
       }

        //if user haven't pressed the button, return false.
        return false;
    }

}