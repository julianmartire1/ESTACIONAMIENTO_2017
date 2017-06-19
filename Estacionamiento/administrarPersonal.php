<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

    <title>Document</title>
</head>
<body>
    
</body>
</html>

<?php
session_start();

if (isset($_SESSION["administrador"])) 
{

    ?>
    <div class="container">
        </br>
        <input class="btn btn-primary" type='button' name='agregarEmpleado' value='Agregar empleado' onclick = "location='registrar.php'">
        <input class="btn btn-primary" type='button' name='suspenderEmpleado' value='Suspender Empleado' onclick = "location='suspender.php'">
        <input class="btn btn-primary" type='button' name='eliminarEmpleado' value='Eliminar empleado' onclick = "location='eliminarEmp.php'">
    </div>
    <?php
}
else {
    echo "asd";
}
?>