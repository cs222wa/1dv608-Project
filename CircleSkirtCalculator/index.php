<?php
//Starts new session
session_start();

//INCLUDE THE FILES NEEDED...
require_once('controller/Controller.php');
require_once('view/CalculatorView.php');
require_once('view/LayoutView.php');
require_once('view/SkirtView.php');
require_once('model/Skirt.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$calculate = false;
//CREATE OBJECTS OF THE MODEL
$skirtModel = new \model\Skirt();

//CREATE OBJECTS OF THE VIEWS
$layoutView = new \view\LayoutView();
$calcView = new \view\CalculatorView();
$skirtView = new \view\SkirtView($skirtModel);

//CREATE OBJECT OF THE CONTROLLER - SEND OBJECTS OF THE CORRESPONDING VIEWS AND MODELS AS PARAMETERS
$controller = new \controller\Controller($calcView, $skirtView, $skirtModel);


//CALL CONTROLLER METHOD doCalculate IN ORDER TO DETERMINE IF USER WANTS TO CALCULATE A SKIRT PATTERN
$calculate = $controller->doCalculate();

//PICK WHICH VIEW TO DISPLAY
$layoutView->setLayout($calculate, $calcView, $skirtView);





/*
//PICK WHICH VIEW TO DISPLAY
$layoutview->setLayout($calcView);

*/






//Display calculation-form

//display SkirtView after calculation is complete