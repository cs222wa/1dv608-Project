<?php
namespace view;
class LayoutView {

    //calls function to render HTML layout
    public function setLayout($controller, $calcView, $skirtview){
        $this->render($controller, $calcView, $skirtview);
    }

    //renders basic HTML layout with calculations form and skirt pattern.
    private function render($calculate, $calcView, $skirtView) {
        echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <link rel="stylesheet" type="text/css" href="css\\style.css">
          <title>Circle Skirt Calculator</title>
        </head>
        <body>
        <header id="header"><h1 class="hidden">Circle Skirt Calculator</h1></header>
          <h3>Enter your waist measurement and desired skirt length in the form below and pick a skirt model</h3>
          <div class="container">
            <div id="calculationform">
                ' . $calcView->response() . '
            </div>
                '. $this->renderCalculation($calculate, $skirtView) .'
          </div>
         </body>
      </html>
    ';
    }

    //calls skirt view to render finished pattern and calculation information.
    private function renderCalculation($calculate, $skirtView){
        if($calculate){
            return $skirtView->render();
        }
        return false;
    }
}
