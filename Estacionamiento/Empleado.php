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
    private $_categoria;
    private $_usuario;
    private $_pw;
    private $_estado;

    function __construct($nombre,$apellido,$legajo,$turno,$categoria,$usuario,$pw,$estado)
    {
        $this->_nombre=$nombre;
        $this->_apellido=$apellido;
        $this->_legajo=$legajo;
        $this->_turno=$turno;
        $this->_categoria=$categoria;
        $this->_usuario=$usuario;
        $this->_pw=$pw;
        $this->_estado=$estado;

        $pdo = new PDO("mysql:host=localhost;dbname=estacionamiento","root","");

        $consulta = $pdo->prepare("INSERT INTO `empleados`(`nombre`, `apellido`, `legajo`, `turno`, `categoria`, `usuario`, `pw`, `estado`) 
        VALUES (:nombre,:apellido,:legajo,:turno,:categoria,:usuario,:pw,:estado)");

        $consulta->bindParam(":nombre",$nombre);
        $consulta->bindParam(":apellido",$apellido);
        $consulta->bindParam(":legajo",$legajo);
        $consulta->bindParam(":turno",$turno);
        $consulta->bindParam(":categoria",$categoria);
        $consulta->bindParam(":usuario",$usuario);
        $consulta->bindParam(":pw",$pw);
        $consulta->bindParam(":estado",$estado);

        $consulta->execute();
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

    function getCategoria()
    {
        return $this->_categoria;
    }

    function getUsuario()
    {
        return $this->_usuario;
    }

    function getPw()
    {
        return $this->_pw;
    }

    function getEstado()
    {
        return $this->_estado;
    }

    static function TraerEmpleados()
    {
        try{
            $pdo = new PDO("mysql:host=localhost;dbname=estacionamiento","root","");
            $consulta = $pdo->prepare("SELECT `nombre`, `apellido`, `legajo`, `turno`, `categoria`, `usuario`, `pw`,`estado` FROM `empleados` ORDER BY Apellido, Nombre");
            $consulta->execute();

            while($row = $consulta->fetch(PDO::FETCH_ASSOC))
			{
				$array[] = $row;
			}
            return $array;

        } catch(PDOException $err){
            return array("ERROR" => $err->getMessage());
        }
    }

    public static function GuardarEnBD($empleado)
    {
        try
    	{
			$pdo = new PDO("mysql:host=localhost;dbname=estacionamiento","root","");
			
			$nombre = $empleado->getNombre();
            $apellido = $empleado->getApellido();
            $legajo = $empleado->getLegajo();
            $turno = $empleado->getTurno();
            $categoria = $empleado->getCategoria();
            $usuario = $empleado->getUsuario();
            $pw = $empleado->getPw();
            $estado = $empleado->getEstado();

			$consulta = $pdo->prepare("INSERT INTO `empleados`(`nombre`, `apellido`, `legajo`, `turno`, `categoria`, `usuario`, `pw`,`estado`) VALUES (:nombre,:apellido,:legajo,:turno,:categoria,:usuario,:pw,:estado)");
			$consulta->bindParam(":nombre",$nombre);
			$consulta->bindParam(":apellido",$apellido);
			$consulta->bindParam(":legajo",$legajo);
            $consulta->bindParam(":turno",$turno);
            $consulta->bindParam(":categoria",$categoria);
            $consulta->bindParam(":usuario",$usuario);
            $consulta->bindParam(":pw",$pw);
            $consulta->bindParam(":estado",$estado);
            
			return $consulta->execute();    
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
    }
}



?>