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

?>