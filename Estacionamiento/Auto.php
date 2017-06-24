<?php
date_default_timezone_set("America/Buenos_Aires");
class Auto 
{
    private $_patente;
    private $_color;
    private $_marca;
    private $_fechaInicial;
    function __construct($patente,$color,$marca,$fechaInicial)
    {
        $this->_patente=$patente;
        $this->_color=$color;
        $this->_marca=$marca;
        $this->_fechaInicial=$fechaInicial;
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

    function getFechaInicial()
    {
        return $this->_fechaInicial;
    }

    public static function agregarVehiculo($patente,$color,$marca,$fechaIngreso)
    {
        $pdo = new PDO("mysql:host=localhost;dbname=estacionamiento","root","");

        $auxPatente = $patente;
        $auxColor = $color;
        $auxMarca = $marca;
        $auxFechaIngreso = $fechaIngreso;
        $auxNumero=1;

        $consulta = $pdo->prepare("INSERT INTO `autos`(`patente`, `color`, `marca`, `fechaInicial`,`esta`) VALUES (:patente,:color,:marca,:fechaInicial,:esta)");
        $consulta->bindParam(":patente",$auxPatente);
        $consulta->bindParam(":color",$auxColor);
        $consulta->bindParam(":marca",$auxMarca);
        $consulta->bindParam(":fechaInicial",$auxFechaIngreso);
        $consulta->bindParam(":esta",$auxNumero);
        $consulta->execute();

        return true;
    }

    public static function listarAutos()
    {
        try{
            $pdo = new PDO("mysql:host=localhost;dbname=estacionamiento","root","");
            $consulta = $pdo->prepare("SELECT `patente`, `color`, `marca`, `fechaInicial`,`esta` FROM `autos` ORDER BY patente");
            $consulta->execute();
            
            $array=$consulta->fetchall(PDO::FETCH_ASSOC);

            return $array;

        } catch(PDOException $err){
            return array("Error" => $err->getMessage());
        }
    }

    public static function buscarLugarEstacionamiento($piso)
    {

        $array=array();
        try{
            $pdo = new PDO("mysql:host=localhost;dbname=estacionamiento","root","");
            $consulta = $pdo->prepare("SELECT `auto`, `condicion`, `reservado`, `cantidad`, `cochera` FROM `estacionamiento` WHERE cochera='$piso' and condicion='nadie'");
            $consulta->execute();
            
            //return $consulta;
            $array=$consulta->fetchall(PDO::FETCH_ASSOC);

            //return var_dump($array);
            //return count($array);

            foreach ($array as $item) {
                if($item["condicion"]=="nadie")
                    return true;
                else return false;
            }

        } catch(PDOException $err){
            return array("Error" => $err->getMessage());
        }
    }

    public static function agregarAutoAlEstacionamiento($array)
    {
        $pdo2 = new PDO("mysql:host=localhost;dbname=estacionamiento","root","");

        //return var_dump($array);

        if(Auto::buscarLugarEstacionamiento($array["cochera"])==true){
        
          $auto=Auto::agregarVehiculo($array["patente"],$array["color"],$array["marca"],$array["fechaInicial"]);
          $piso=$array["cochera"];
          $patente=$array["patente"];
          $consulta2 = $pdo2->prepare("UPDATE `estacionamiento` SET `auto`='$patente',`condicion`='ocupado',`cantidad`=`cantidad`+1 WHERE `cochera`='$piso' and condicion='nadie'");

          $consulta2->execute();
          return true;
        }
        else return false;
    } 

    public static function retirarAuto($patente)
    {

        $array=Auto::listarAutos();

        foreach ($array as $item) {
            if($item["patente"] == $patente && $item["esta"]==0)
                return false;
        }

        //return $patente;
        $pdo1 = new PDO("mysql:host=localhost;dbname=estacionamiento","root","");
        $consulta1 = $pdo1->prepare("UPDATE `estacionamiento` SET `auto`='nadie',`condicion`='nadie' WHERE `auto`='$patente'");
        $consulta1->execute();

        $pdo2 = new PDO("mysql:host=localhost;dbname=estacionamiento","root","");
        $consulta2 = $pdo2->prepare("UPDATE `autos` SET `esta`=0 WHERE patente='$patente'");
        $consulta2->execute();

        if($consulta1==true && $consulta2==true)
            return true;
    }
/*-Cobro por hora $10, media estadía $90 (12hs) o estadía $170
(24hs)*/
    public static function calcularCosto($fechaIngreso)
    {
        $ingreso=strtotime($fechaIngreso);
        $ahora=strtotime(date("Y-m-d H:i:s"));

        $diferencia=$ahora - $ingreso;
        $i=0;

        while($diferencia>=86400)
        {
            $diferencia=$diferencia-86400;
            $i++;
        }

        $resultado=$i*170;

        if($diferencia <= 43200 && $diferencia >= 32400)
            $resultado=$resultado + 90;
        else 
        {
            if($diferencia < 32400)
                $resultado+=ceil($diferencia/60/60) *10;
                else
                {
                    if($diferencia > 43200 && $diferencia < 72000)
                    {
                        $ceil=ceil($diferencia/60/60) - 12;
                        $resultado=$resultado+90+$ceil*10; 
                    }
                    else
                        $resultado+=170;
                    
                }
        }


    return $resultado;
        
    }

    public static function traerFechaIngreso($patente)
    {
        $array=Auto::listarAutos();

        foreach ($array as $item) {
            if($item["patente"] == $patente)
                return $item["fechaInicial"];
        }

        return false;
    }

    public static function traerCochera($patente)
    {
        $pdo = new PDO("mysql:host=localhost;dbname=estacionamiento","root","");
        $consulta=$pdo->prepare("SELECT `auto`, `cochera` FROM `estacionamiento` WHERE `auto`='$patente'");
        $consulta->execute();
        $array=$consulta->fetchall(PDO::FETCH_ASSOC);

        foreach ($array as $item) {
            if($item["auto"]==$patente)
                return $item["cochera"];
        }
    }
}




?>