<?php


/**
 * 
 */
class Estacionamiento
{
    private $_estado;
    private $_piso;
    private $_cantidad;
    function __construct($estado,$piso,$cantidad)
    {
        $this->_estado=$estado;
        $this->_piso=$piso;
        $this->_cantidad=$cantidad;
    }

    function getEstado()
    {
        return $this->_estado;
    }

    function getPiso()
    {
        return $this->_piso;
    }

    function getCantidad()
    {
        return $this->_cantidad;
    }
}



 ?>