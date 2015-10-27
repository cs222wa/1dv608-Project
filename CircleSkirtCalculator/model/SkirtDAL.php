<?php
namespace model;
class SkirtDAL
{
    private $selected;
    private static $skirtSession = 'skirt';

    public function __construct(){
        if(!isset($_SESSION[self::$skirtSession]) || !is_array($_SESSION[self::$skirtSession])){
            $_SESSION[self::$skirtSession] = array();
        }
    }

    //saves skirt object in session
    public function SaveSkirt(\model\Skirt $skirt){
        //chosen skirt
        $this->selected = $skirt;
        $exists = false;
        //compare if the current skirt is the same as one of the objects already saved
        foreach($this->getSkirts() as $savedSkirt){
            if($skirt->isSame($savedSkirt)){
                $exists = true;
            }
        }
        //if there are more than 10 skirts saved in the session - remove the oldest one and
        //place the newest one first in the list.
        if(count($this->getSkirts())>= 10){
            array_shift($_SESSION[self::$skirtSession]);
        }
        //if the compared skirt doesn't already exist, save it to the list
        if($exists == false){
            $_SESSION[self::$skirtSession][] = $skirt;
        }
    }

    //returns the currently displayed skirt
    public function getSelectedSkirt(){
        return $this->selected;
    }

    //get the session list of saved skirt objects
    public function getSkirts(){
        return $_SESSION[self::$skirtSession];
    }
}