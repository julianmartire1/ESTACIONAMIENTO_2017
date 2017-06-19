<?php 



switch ($_POST["optipo"])
{
    case 'normal':

        $pdo = new PDO("mysql:host=localhost;dbname=estacionamiento","root","");

        $consulta = $pdo->prepare("SELECT * FROM `estacionamiento` WHERE condicion='nadie' and reservado='normal'");
        $consulta->execute();
        $array=$consulta->fetchall(PDO::FETCH_ASSOC);
            echo "<option value=''>--Seleccionar Piso y Cochera--</option>";
        for ($i=0; $i < count($array); $i++) { 
                echo "<option value='".$array[$i]["cochera"]."'>".$array[$i]["cochera"]."</option>";
        }

/*
        echo "<option value='banfield'>Banfield</option>";
        echo "<option value='lomasDeZamora'>Lomas de Zamora</option>";
        echo "<option value='monteChingolo'>Monte Chingolo</option>";
        echo "<option value='ezpeleta'>Ezpeleta City</option>";*/
        break;
    case 'especial':
        $pdo = new PDO("mysql:host=localhost;dbname=estacionamiento","root","");

        $consulta = $pdo->prepare("SELECT * FROM `estacionamiento` WHERE condicion='nadie' and reservado='especial'");
        $consulta->execute();
        $array=$consulta->fetchall(PDO::FETCH_ASSOC);
            echo "<option value=''>--Seleccionar Piso y Cochera--</option>";
        for ($i=0; $i < count($array); $i++) { 
                echo "<option value='".$array[$i]["cochera"]."'>".$array[$i]["cochera"]."</option>";
        }
        break;
    default:
        echo "";
        break;
}



/*
require_once "Auto.php";

if($_POST["op"]=="altaAuto")
{
    try
    {
        $patente=$_POST["patente"];
        $color=$_POST["color"];
        $marca=$_POST["marca"];
        $fechaInicial=getdate();

        $auto=new Auto($_POST["patente"],$_POST["color"],$_POST["marca"],$fechaInicial);

        Auto::agregarListaAutos($auto);

        echo "Auto Agregado";
        
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
}
*/
?>