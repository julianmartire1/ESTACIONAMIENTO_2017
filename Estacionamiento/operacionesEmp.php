<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Listado de los Autos</title>
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="jquery.js"></script>

  <script type="text/javascript">
  window.onload=traerTodos;

  function traerTodos(){
    var pagina = "http://localhost/Estacionamiento/apirest/vehiculo";

    $.ajax({
        type: 'GET',
        url: pagina,
        dataType: "json",
        async: true
    })
    .done(function (objJson) {

        var tablaEncabezado = "<table class='table table-bordered'>";
        tablaEncabezado += "<tr><th>Patente</th><th>Color</th><th>Marca</th><th>Fecha de ingreso</th></tr>";
        var tablaCuerpo = "";
        var tablaPie = "</tr></html>";

        for(var i=0;i<objJson.length;i++){
            tablaCuerpo += "<tr><td>"+objJson[i]["patente"]+"</td><td>"+objJson[i]["color"];
            tablaCuerpo += "</td><td>"+objJson[i]["marca"]+"</td><td>"+objJson[i]["fechaInicial"]+"</td>";
            //tablaCuerpo += "</td><td><a href='modificar.php' data-id='"+objJson[i]["id"]+"' onclick='administrarModificar("+objJson[i]["id"]+")' data-toggle='modal' data-target='#myModal' class='open-Modal'>MODIFICAR</a>&nbsp;";
          //tablaCuerpo += "&nbsp;<a href='#' onclick='eliminar("+objJson[i].id+")'>ELIMINAR</a></td></tr>";
        }

        $("#tabla").html(tablaEncabezado+tablaCuerpo+tablaPie);

    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });    

}
  
  </script>
</head>
<body>
<div class="container">
</br>
<?php
require_once "Empleado.php";
session_start();
if(isset($_SESSION["administrador"]))
{//`empleado`, `operacion`, `auto`, `cochera`, `fecha`, `cantidad`
        $array=Empleado::TraerOperaciones();
?>
        <table class='table table-bordered'>
        <tr>
            <th colspan='5'>Registro de Autos</th>
        </tr>
        <tr>
            <th>Empleado</th><th>Auto</th><th>Cochera</th><th>Fecha de Ingreso</th>
        </tr>  
<?php   
        for($i=0;$i<count($array);$i++){
            if($array[$i]["empleado"]=="")
            continue;
            if($array[$i]["operacion"]==1)
            {
                ?>
                <tr>
                    <td>  <?php echo $array[$i]["empleado"]; ?> </td><td>  <?php echo  $array[$i]["auto"]; ?> </td><td> <?php echo $array[$i]["cochera"]; ?> </td><td> <?php echo $array[$i]["fecha"]; ?>
                </tr>
                <?php
            }
        }
?>
        </table></br></br>
        <table class='table table-bordered'>
        <tr>
            <th colspan='4'>Autos Retirados</th>
        </tr>
        <tr>
            <th>Empleado</th><th>Auto</th><th>Fecha de Ingreso</th>
        </tr>  
<?php   
        for($i=0;$i<count($array);$i++){
            if($array[$i]["operacion"]==2)
            {
                ?>
                <tr>
                    <td>  <?php echo $array[$i]["empleado"]; ?> </td><td>  <?php echo  $array[$i]["auto"]; ?>  </td><td> <?php echo $array[$i]["fecha"]; ?>
                </tr>
                <?php
            }
        }
?>
        </table></br></br><a href="menuAdmin.php">Volver al menu</a>
<?php
}
else
{
    if(isset($_SESSION["empleado"]))
    {
        echo "<script type='text/javascript'>
        
        alert('No es administrador');
        window.location='menuAdmin.php';

        </script>";
    }
    else
        header("Location:index.php");
}
?>
</div>
</body>
</html>