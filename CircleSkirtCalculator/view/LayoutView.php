<?php
namespace view;


class LayoutView {

    public function setLayout($controller, $calcView, $skirtview){
        $this->render($controller, $calcView, $skirtview);
    }
    public function render($calculate, $calcView, $skirtView) {

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
         <!-- <p class="notice">Add fabric measurements to calculate if there is enough fabric to make the skirt.</p>-->
          <div class="container">
            <div id="calculationform">
                ' . $calcView->response() . '
            </div>
            <div id="patterndisplay">

            '. $this->renderCalculation($calculate, $skirtView) .'

            </div>
          </div>
         </body>
      </html>
    ';
    }

    private function renderCalculation($calculate, $skirtView){
        if($calculate){
            return $skirtView->render();
        }
        return false;
    }


    private function checkURL(){
        //if url contains "calculation" - return true, if not return false
        if(strpos("$_SERVER[REQUEST_URI]", "?calculation")){
            return true;
        }
        else return false;
    }
}
