<?php


/**
 * 
 */
class Auto 
{
    private $_patente;
    private $_color;
    private $_marca;
    private $_hora;
    private $_dia;
    private $_mes;
    private $_anio;
    function __construct($patente,$color,$marca,$hora,$dia,$mes,$anio)
    {
        $this->_patente=$patente;
        $this->_color=$color;
        $this->_marca=$marca;
        $this->_hora=$hora;
        $this->_dia=$dia;
        $this->_mes=$mes;
        $this->_anio=$anio;
    }

    function getPatente()
    {
        return $this->_patente;
    }

    function getColor()
    {
        return $this->_color;
    }

    function getMarca()
    {
        return $this->_marca;
    }

    function getHora()
    {
        return $this->_hora;
    }

    function getDia()
    {
        return $this->_dia;
    }

    function getMes()
    {
        return $this->_mes;
    }

    function getAnio()
    {
        return $this->_anio;
    }

    public static function agregarListaAutos($auto)
    {
        $listaAutos=array();

        array_push($listaAutos,$auto);
    } 
}




?>