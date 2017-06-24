<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Retirar Auto</title>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

    <script type="text/javascript">
    
    function retirarAuto()
    {
        var pagina = "http://localhost/Estacionamiento/apirest/vehiculo";
        $.ajax({
                type: 'PUT',
                url: pagina,
                dataType: "text",
                data: {
                    patente : $("#patente").val(),
                    emp : empleado
                },
        async: true
            })
            .done(function (objJson) {
                alert(objJson);
                window.location.href = "listadoAutos.php";
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
            }); 
    }
    
    </script>
</head>
<body>
<?php
session_start();
if(isset($_SESSION["administrador"]) || isset($_SESSION["empleado"]))
{
    if(isset($_SESSION["empleado"]))
    {
        echo "<script type='text/javascript'>
            
            var empleado='".$_SESSION["empleado"]."';

            </script>";
    }
    else {
        echo "<script type='text/javascript'>
            
            var empleado='';

            </script>";
    }
?>
    <div class="container">
        <form action="retirarAuto.php" method="POST">
            </br>
            <div class="form-group">
				<label for="usr">Patente:</label>
                <input class="form-control" type="text" name="patente" id="patente" placeholder="Ingrese Patente del auto a retirar" required></br>
            </div>
            <input class="btn btn-warning" type="button" value="Retirar Auto" name="retirar" onclick="retirarAuto()"> <a href="menuAdmin.php">Volver al menu</a>
        </form>
    </div>

    <?php
}
else
    header("Location:index.php");
        ?>


</body>
</html>