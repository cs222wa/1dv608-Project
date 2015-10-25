<?php
//Display Skirt Pattern and Finished calculation
namespace view;
class SkirtView
{
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

    private function rendermeasurements($radius, $length)
    {
        //render calculated measurements saved as variables in Skirt/ returned and sent as parameters by Controller?

    }
    private function rendermargin($margin)
    {
        //render calculated measurements saved as variables in Skirt/ returned and sent as parameters by Controller?

    }

}