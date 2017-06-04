<?php 

require_once "Auto.php";

if($_POST["op"]=="altaAuto")
{
    try
    {
        $patente=$_POST["patente"];
        $color=$_POST["color"];
        $marca=$_POST["marca"];
        $hora=date("G");
        $dia=date("j");
        $mes=date("n");
        $anio=date("Y");

        $pdo=new PDO("mysql:dbname=estacionamiento","root","");
        $consulta=$pdo->prepare("INSERT INTO `autos`(`patente`, `color`, `marca`, `hora`, `dia`, `mes`, `anio`) 
        VALUES ($patente,$color,$marca,$hora,$dia,$mes,$anio");
/*
        $consulta->bindParam(":patente",$_POST["patente"]);
        $consulta->bindParam(":color",$_POST["color"]);
        $consulta->bindParam(":marca",$_POST["marca"]);
        $hora=date("G");
        $dia=date("j");
        $mes=date("n");
        $anio=date("Y");
        $consulta->bindParam(":hora",$hora);
        $consulta->bindParam(":dia",$dia);
        $consulta->bindParam(":mes",$mes);
        $consulta->bindParam(":anio",$anio);*/

        $band=$consulta->execute();

        if($band)
            echo "true";
            else echo "false";

        $auto=new Auto($_POST["patente"],$_POST["color"],$_POST["marca"],$hora,$dia,$mes,$anio);

        Auto::agregarListaAutos($auto);

        echo "Auto Agregado";
        
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>