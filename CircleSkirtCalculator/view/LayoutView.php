<?php
namespace view;
use model\Skirt;

class LayoutView {

    public function setLayout($calcView){
        $this->render($calcView);
    }
    public function render( \view\CalculatorView $calcView) {
        echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Circle Skirt Calculator</title>
        </head>
        <body>
          <h2>Enter your waist measurement in the form below and pick a skirt model</h2>
          <div class="container">
              ' . $calcView->response() . '
          </div>
         </body>
      </html>
    ';
    }


    private function checkURL(){
        //if url contains "register" - return true, if not return false
        if(strpos("$_SERVER[REQUEST_URI]", "?register")){
            return true;
        }
        else return false;
    }
}
