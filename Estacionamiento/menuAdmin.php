<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link href='http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
    <script type='text/javascript' src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js'></script>
    <script type='text/javascript' src='http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js'></script>
    <title>Menu</title>
</head>
<body>


<?php

session_start();

if (isset($_SESSION["administrador"])) {
    //echo "Bienvenido ".$_SESSION['administrador'];

    ?>
    <div class='jumbotron'>
        <h1 class="text-center">Bienvenido, <?php echo $_SESSION["administrador"]; ?></h1>
    </div>
    <div class='container'>
        <div class="btn-group btn-group-justified">
            <div class="btn-group">
                <input class='btn btn-success' type='button' name='listadoAuto' value='Listado de Autos' onclick = "location='listadoAutos.php'">
            </div>
            <div class="btn-group">
                <input class='btn btn-success' type='button' name='agregarAuto' value='Agregar Auto' onclick = "location='ingresarAutoAdmin.php'">
            </div> 
            <div class="btn-group">
                <input class='btn btn-success' type='button' name='administrarPersonal' value='Administrar el personal' onclick = "location='administrarPersonal.php'">
            </div>
            <div class="btn-group">
                <input class='btn btn-success' type='button' name='empleadosLogin' value='Buscar empleado logeado' onclick = "location='empLogeado.php'">
            </div>
            <div class="btn-group">
                <input class='btn btn-success' type='button' name='retirarAuto' value='Retirar Auto' onclick = "location='retirarAuto.php'">
            </div>
            
        </div>
        <form action='menuAdmin.php' method='post'>  
              
            <input class='btn btn-danger btn-block' type='submit' name='desloguear' value='Cerrar Sesion' onclick = "location='ingresarAutoAdmin.php'">
        </form>
        
    </div>

    

    <?php

    if(isset($_POST["desloguear"]))
    {
        session_destroy();
        header("Location:logear.php");
    }

    

    
}
else {
    if(isset($_SESSION["empleado"]))
    {
        $pdo = new PDO("mysql:host=localhost;dbname=estacionamiento","root","");

        $consulta = $pdo->prepare("INSERT INTO `registrolog`(`empleado`, `dia`) VALUES (:empleado,:dia)");
        $consulta->bindParam(":empleado",$_SESSION['empleado']);
        $consulta->bindParam(":dia",date("j-m-Y G:i"));
        $consulta->execute();

        ?>
    <div class='jumbotron'>
        <h1>Bienvenido, <?php echo $_SESSION["empleado"]; ?></h1>
    </div>
    <div class='container'>
        <input class='btn btn-success' type='button' name='agregarAuto' value='Agregar Auto' onclick = "location='ingresarAutoAdmin.php'">
        <form action='menuAdmin.php' method='post'>            
            <input class='btn btn-danger' type='submit' name='desloguear' value='Cerrar Sesion' onclick = "location='ingresarAutoAdmin.php'">
        </form>
    </div>

    

    <?php

    if(isset($_POST["desloguear"]))
    {
        session_destroy();
        header("Location:logear.php");
    }


        if(isset($_POST["agregarAuto"]))
        {
            header("Location:ingresarAutoAdmin.html");
        }

        if(isset($_POST["desloguear"]))
        {
            session_destroy();
            header("Location:logear.php");
        }

    }
    else
    {
        header("Location:index.php");
    }
}


?>


</body>
</html>