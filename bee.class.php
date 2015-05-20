<?php

/**
 * Classe abstraite représentant une abeille
 */
abstract class Bee{
    
    protected $_type;    // Type d'abeille
    protected $_PV;     // Points de vie
    protected $_PV_max; // Points de vie max
    protected $_DMG;    // Points de vie perdus lorsque touché
    
    /**
     * Retourne le type d'abeille
     * @return string
     */
    public function get_type(){
        return $this->_type;
    }
    
    /**
     * Retourne une représentation lisible de la vie de l'abeille
     * Indique les PV courant / PV max
     * @return string
     */
    public function get_life(){
        return $this->_PV .'/'. $this->_PV_max;
    }
    
    /**
     * Retire a l'abeille des points de vie
     */
    public function attack(){
        $this->_PV -= $this->_DMG;
    }
    
    /**
     * Indique si l'abeille est morte
     * @return boolean
     */
    public function is_dead(){
        return $this->_PV <= 0;
    }
}

/**
 * Représente une abeille Reine
 */
final class QweenBee extends Bee{
    
    function __construct(){
        $this->_type    = __CLASS__;
        $this->_PV      = 100;
        $this->_PV_max  = 100;
        $this->_DMG     = 8;
    }
}

/**
 * Représente une abeille Travailleuse
 */
final class WorkerBee extends Bee{
    
    function __construct(){
        $this->_type    = __CLASS__;
        $this->_PV      = 75;
        $this->_PV_max  = 75;
        $this->_DMG     = 10;
    }
}

/**
 * Représente une abeille drone
 */
final class DroneBee extends Bee{   
    
    function __construct(){
        $this->_type    = __CLASS__;
        $this->_PV      = 50;
        $this->_PV_max  = 50;
        $this->_DMG     = 12;
    }
}