<?php
namespace view;
use model\Skirt;

class LayoutView {

    public function setLayout($calcView){
        $this->render($calcView);
    }
    public function render( \view\CalculatorView $calcView) {

        //boolean - finns skirt eller inte?
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
              ' . $calcView->response() . '
          </div>
         </body>
      </html>
    ';
    }


    private function checkURL(){
        //if url contains "calculation" - return true, if not return false
        if(strpos("$_SERVER[REQUEST_URI]", "?calculation")){
            return true;
        }
        else return false;
    }
}
