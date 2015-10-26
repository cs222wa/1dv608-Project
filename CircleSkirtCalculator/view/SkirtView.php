<?php
//Display Skirt Pattern and Finished calculation
namespace view;

class SkirtView
{
    private $skirtModel;

    public function __construct($skirtM){
        $this->skirtModel = $skirtM;
    }

    public function render(){
        $this->renderFoldingInstructions();
        $this->renderPattern();
        $this->renderMeasurements($this->skirtModel->radius, $this->skirtModel->length);
        $this->renderMinFabric();
    }

    private function renderFoldingInstructions(){
        if($this->skirtModel->skirtType == 1){
            return $this->renderFullCircleInstructions();
        }
        elseif($this->skirtModel->skirtType == 2){
            return $this->renderHalfCircleInstructions();
        }
        else{
            return false;
        }
    }

    private function renderFullCircleInstructions()
    {
        //render folding instructions for Full Circle skirt
        return '<p> Fold fabric once along the width and once along the length.</p>';

    }

    private function renderHalfCircleInstructions()
    {
        //render folding instructions for Half Circle skirt
        return '<p> Fold fabric once along the width.</p>';

    }

    private function renderPattern()
    {
        //render image for pattern
        return '<img src="...\css\pattern.jpg" class="patternimg"/>';

    }

    private function renderMeasurements($radius, $length)
    {
        //render calculated measurements saved as variables in Skirt/ returned and sent as parameters by Controller?
        return '<p> A: '. $radius .'</p><p> B: '. $length .'</p> ';

    }
    private function renderMargin($marginWidth, $marginLength)
    {
        //render calculated measurements saved as variables in Skirt/ returned and sent as parameters by Controller?
        return '<p> Margin width: '. $marginWidth .'</p><p> Margin length: '. $marginLength .'</p> ';


    }

    private function renderMinFabric(){
        if($this->skirtModel->skirtType == 1){
            return '<p> Minimum fabric width required: '. $this->skirtModel->minFabric*2 .'</p><p> Minimum fabric length required: '. $this->skirtModel->minFabric*2 .'</p>';
        }
        elseif($this->skirtModel->skirtType == 2){
            return '<p> Minimum fabric width required: '. $this->skirtModel->minFabric .'</p><p> Minimum fabric length required: '. $this->skirtModel->minFabric*2 .'</p>';
        }
        else{
            return false;
        }
    }

}