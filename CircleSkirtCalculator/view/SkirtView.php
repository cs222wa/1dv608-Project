<?php
//Display Skirt Pattern and Finished calculation
namespace view;

class SkirtView
{
    private $skirtModel;

    public function __construct(\model\SkirtDAL $skirtM){
        $this->skirtModel = $skirtM;
    }

    public function render(){
        $skirt = $this->skirtModel->getSelectedSkirt();
        return '
        <div id="patterndisplay">
        '. $this->renderHeaderHTML($skirt).'
        '. $this->renderPatternHTML().'
            <div id="instructions">
            '. $this->getFoldingInstructionsHTML($skirt) . '
            '.$this->renderMeasurementsHTML($skirt). '
            '.$this->renderMinFabricHTML($skirt). '
            </div>
        </div>';
    }

    private function renderHeaderHTML(\model\Skirt $skirt){
        if($skirt->getType() == \model\Skirt::$fullSkirt){
            return '<h2 class="patternheader">Full Circle Skirt</h2>';
        }
        elseif($skirt->getType() == \model\Skirt::$halfSkirt){
            return '<h2 class="patternheader">Half Circle Skirt</h2>';
        }
        else{
            return false;
        }
    }

    private function getFoldingInstructionsHTML(\model\Skirt $skirt){
        if($skirt->getType() == \model\Skirt::$fullSkirt){
            return $this->renderFullCircleInstructionsHTML();
        }
        elseif($skirt->getType() == \model\Skirt::$halfSkirt){
            return $this->renderHalfCircleInstructionsHTML();
        }
        else{
            return false;
        }
    }

    private function renderFullCircleInstructionsHTML()
    {
        //render folding instructions for Full Circle skirt
        return '<h3>Folding Instructions</h3><p class="patterntext">Fold fabric once along the width and once along the length.</p>';
    }

    private function renderHalfCircleInstructionsHTML()
    {
        //render folding instructions for Half Circle skirt
        return '<h3>Folding Instructions</h3><p class="patterntext">Fold fabric once along the width.</p>';
    }

    private function renderPatternHTML()
    {
        //render image for pattern
        return '<img src="css/pattern.jpg" class="patternimg" alt="Skirt pattern">';
    }

    private function renderMeasurementsHTML(\model\Skirt $skirt)
    {
      //render calculated measurements saved as variables in Skirt/ returned and sent as parameters by Controller?
        return
            '<h3>Measurements</h3>
            <p class="patterntext"> A: '. round( $skirt->calculateRadius(), 1, PHP_ROUND_HALF_UP) .' cm </p>
            <p class="patterntext"> B: '. round($skirt->getLength(), 1, PHP_ROUND_HALF_UP) .' cm </p>
            ';
    }

    private function renderMinFabricHTML(\model\Skirt $skirt){
        if($skirt->getType() == \model\Skirt::$fullSkirt){
            return
                '<h3>Minimum Fabric requirements</h3>
                <p class="patterntext"> Width required: '. round($skirt->getMinFabric(), 1, PHP_ROUND_HALF_UP) .' cm</p>
                <p class="patterntext"> Length required: '. round($skirt->getMinFabric(), 1, PHP_ROUND_HALF_UP) .' cm</p>
                ';
        }
        elseif($skirt->getType() == \model\Skirt::$halfSkirt){
            return
                '<h3>Minimum Fabric requirements</h3>
                <p class="patterntext"> Width required: '. round($skirt->getMinFabric()/2, 1, PHP_ROUND_HALF_UP) .' cm</p>
                <p class="patterntext"> Length required: '. round($skirt->getMinFabric(), 1, PHP_ROUND_HALF_UP) .' cm</p>
                ';
        }
        else{
            return false;
        }
    }

    /*
   private function renderMargin($marginWidth, $marginLength)
   {
       //render calculated measurements saved as variables in Skirt/ returned and sent as parameters by Controller?
       return
           '<p class="patterntext"> Margin width: '. round($marginWidth, 1, PHP_ROUND_HALF_UP) .' cm </p>
           <p class="patterntext"> Margin length: '. round($marginLength, 1, PHP_ROUND_HALF_UP) .' cm </p>
           ';
   }
   */

}