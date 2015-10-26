<?php
namespace model;
class SkirtDAL
{
    private $selected;
    private static $skirtSession = 'skirt';

    public function __construct(){
        if(!isset($_SESSION[self::$skirtSession]) &&!is_array($_SESSION[self::$skirtSession])){
            $_SESSION[self::$skirtSession] = array();
        }
    }

    public function SaveSkirt(\model\Skirt $skirt){
        //chosen skirt
        $this->selected = $skirt;
        $exists = false;
        foreach($this->getSkirts() as $savedSkirt){
            if($skirt->isSame($savedSkirt)){
                $exists = true;
            }
        }
        if(count($this->getSkirts())>= 10){
            array_shift($_SESSION[self::$skirtSession]);
        }
        if($exists == false){
            $_SESSION[self::$skirtSession][] = $skirt;
        }
        //TODO:: if $exists = ta bort existsing och lägg till nya främst i array.
    }

    public function getSelectedSkirt(){
        return $this->selected;
    }

    public function getSkirts(){
        return $_SESSION[self::$skirtSession];
    }
}