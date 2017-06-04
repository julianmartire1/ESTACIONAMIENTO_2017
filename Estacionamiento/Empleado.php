<?php

/**
 * 
 */
class Empleado
{
    
    private $_nombre;
    private $_apellido;
    private $_legajo;
    private $_turno;

    function __construct($nombre,$apellido,$legajo,$turno)
    {
        $this->_nombre=$nombre;
        $this->_apellido=$apellido;
        $this->_legajo=$legajo;
        $this->_turno=$turno;
    }

    function getNombre()
    {
        return $this->_nombre;
    }

    function getApellido()
    {
        return $this->_apellido;
    }

    function getLegajo()
    {
        return $this->_legajo;
    }

    function getTurno()
    {
        return $this->_turno;
    }
}



?>