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
        return '
        <div id="patterndisplay">
        '. $this->renderHeader().'
        '. $this->renderPattern().'
            <div id="instructions">
            '. $this->renderFoldingInstructions() . '
            '.$this->renderMeasurements($this->skirtModel->radius, $this->skirtModel->length). '
            '.$this->renderMinFabric(). '
            </div>
        </div>';
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

    private function renderHeader(){
        if($this->skirtModel->skirtType == 1){
            return '<h2 class="patternheader">Full Circle Skirt</h2>';
        }
        elseif($this->skirtModel->skirtType == 2){
            return '<h2 class="patternheader">Half Circle Skirt</h2>';
        }
        else{
            return false;
        }
    }

    private function renderFullCircleInstructions()
    {
        //render folding instructions for Full Circle skirt
        return '<h3>Folding Instructions</h3><p class="patterntext">Fold fabric once along the width and once along the length.</p>';

    }

    private function renderHalfCircleInstructions()
    {
        //render folding instructions for Half Circle skirt
        return '<h3>Folding Instructions</h3><p class="patterntext">Fold fabric once along the width.</p>';

    }

    private function renderPattern()
    {
        //render image for pattern
        return '<img src="../css/pattern.jpg" class="patternimg" alt="Skirt pattern"/>';

    }

    private function renderMeasurements($radius, $length)
    {
        //render calculated measurements saved as variables in Skirt/ returned and sent as parameters by Controller?
        return '<h3>Measurements</h3><p class="patterntext"> A: '. round($radius, 1, PHP_ROUND_HALF_UP) .' cm </p><p class="patterntext"> B: '. round($length, 1, PHP_ROUND_HALF_UP) .' cm </p> ';

    }
    private function renderMargin($marginWidth, $marginLength)
    {
        //render calculated measurements saved as variables in Skirt/ returned and sent as parameters by Controller?
        return '<p class="patterntext"> Margin width: '. round($marginWidth, 1, PHP_ROUND_HALF_UP) .' cm </p><p class="patterntext"> Margin length: '. round($marginLength, 1, PHP_ROUND_HALF_UP) .' cm </p> ';


    }

    private function renderMinFabric(){
        if($this->skirtModel->skirtType == 1){
            return '<h3>Minimum Fabric requirements</h3><p class="patterntext"> Width required: '. round($this->skirtModel->minFabric, 1, PHP_ROUND_HALF_UP) .' cm</p><p class="patterntext"> Length required: '. round($this->skirtModel->minFabric, 1, PHP_ROUND_HALF_UP) .' cm</p>';
        }
        elseif($this->skirtModel->skirtType == 2){
            return '<h3>Minimum Fabric requirements</h3><p class="patterntext"> Width required: '. round($this->skirtModel->minFabric/2, 1, PHP_ROUND_HALF_UP) .' cm</p><p class="patterntext"> Length required: '. round($this->skirtModel->minFabric, 1, PHP_ROUND_HALF_UP) .' cm</p>';
        }
        else{
            return false;
        }
    }

}