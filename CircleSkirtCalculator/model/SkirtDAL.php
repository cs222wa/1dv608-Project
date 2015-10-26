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
        if($exists == false){
            $_SESSION[self::$skirtSession][] = $skirt;
        }

        //i viewn hämtas dessa ut som lista om de finns, om ej, skriv ej ut något
        //kontrollera om sparade mått redan finns - inga dubletter.
        //i listan i view - skriv ut som länkar, om länk klickas, beräkna automatiskt.
    }

    public function getSelectedSkirt(){
        return $this->selected;
    }

    public function getSkirts(){
        return $_SESSION[self::$skirtSession];
    }
}