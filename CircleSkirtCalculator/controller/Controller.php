<?php
namespace controller;
use model\SkirtDAL;

class Controller
{
    private $calcView;
    private $skirtView;
    private $skirtDAL;


    public function __construct( \view\CalculatorView $calculatorV, \view\SkirtView $skirtV, \model\SkirtDAL $skirtM){
        $this->calcView = $calculatorV;
        $this->skirtView = $skirtV;
        $this->skirtDAL = $skirtM;
    }

    //Initiates calculations process.
    //if no calculation could be performed, doCalculate returns false.
    public function doCalculate(){
        //control if user have pressed the calculate button
        if($this->calcView->userWantsToCalculate()){
            $skirt = $this->calcView->getSkirt();
            $this->skirtDAL->saveSkirt($skirt);
            return true;
       }
        //if user haven't pressed the button, return false.
        return false;
    }
}
