<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Retirar Auto</title>    
    <link rel="stylesheet" href="estilos.css">

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
    <script type='text/javascript' src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js'></script>
    <script type='text/javascript' src='http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js'></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript">


    $(document).ready(main);

    var contador = 1;

    function main () {
    	$('.menu_bar').click(function(){
    		if (contador == 1) {
    			$('nav').animate({
    				left: '0'
    			});
    			contador = 0;
    		} else {
    			contador = 1;
    			$('nav').animate({
    				left: '-100%'
    			});
    		}
    	});

    	// Mostramos y ocultamos submenus
    	$('.submenu').click(function(){
    		$(this).children('.children').slideToggle();
    	});
    }

    </script>

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
                var auto=JSON.parse(objJson);
                alert("Vehiculo retirado:\n"+"Patente: "+auto.patente+"\nColor: "+auto.color+"\nMarca: "+auto.marca+"\nFecha de ingreso: "+auto.fechaInicial+"\nFecha de retiro: "+auto.fechaSalida+"\nPago: $"+auto.pago);
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

            ?>

            <header>
                <div class="menu_bar">
                    <a href="#" style="color:#fff" class="bt-menu">Menú<span class="glyphicon glyphicon-th-list"></span></a>
                </div>

                <nav>
                    <ul>
                        <li><a href="menuAdmin.php" style="color:#fff;text-decoration:none;"><span class="glyphicon glyphicon-home"></span>Inicio</a></li>
                        <li class="submenu">
                            <a href="#" style="color:#fff;background:#e6344a;text-decoration:none;"><span class="glyphicon glyphicon-road"></span>Autos<span class="caret icon-arrow-down6"></span></a>
                            <ul class="children">
                                <li><a href="ingresarAutoAdmin.php" style="color:#fff;text-decoration:none;">Agregar <span class="glyphicon glyphicon-record"></span></a></li>
                                <li><a href="retirarAuto.php"style="color:#fff;text-decoration:none;">Retirar <span class="glyphicon glyphicon-record"></span></a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="#" style="color:#fff;text-decoration:none;"><span class="glyphicon glyphicon-list-alt"></span>Listados<span class="caret icon-arrow-down6"></span></a>
                            <ul class="children">
                                <li><a href="listadoAutos.php" style="color:#fff;text-decoration:none;">Registros de Autos<span class="glyphicon glyphicon-record"></span></a></li>
                                <li><a href="listadoEstacionamiento.php" style="color:#fff;text-decoration:none;">Listado del Estacionamiento<span class="glyphicon glyphicon-record"></span></a></li>
                            </ul>
                        </li>
                        <li style="float:right;" id="lili" >
                            <a href="cerrarSesion.php" style="color:#fff;text-decoration:none;"><span class="glyphicon glyphicon-log-out"></span>Log out</a>
                        </li>
                    </ul>
                </nav>
            </header>

            <?php

    }
    else {
        echo "<script type='text/javascript'>
            
            var empleado='';

            </script>";

            ?>

<header>
  		<div class="menu_bar">
  			  <a href="#" style="color:#fff" class="bt-menu">Menú<span class="glyphicon glyphicon-th-list"></span></a>
  		</div>

  		<nav>
            <ul>
                <li><a href="menuAdmin.php" style="color:#fff;text-decoration:none;"><span class="glyphicon glyphicon-home"></span>Inicio</a></li>
                <li class="submenu">
                    <a href="#" style="color:#fff;background:#e6344a;text-decoration:none;"><span class="glyphicon glyphicon-road"></span>Autos<span class="caret icon-arrow-down6"></span></a>
                    <ul class="children">
                        <li><a href="ingresarAutoAdmin.php" style="color:#fff;text-decoration:none;">Agregar <span class="glyphicon glyphicon-record"></span></a></li>
                        <li><a href="retirarAuto.php"style="color:#fff;text-decoration:none;">Retirar <span class="glyphicon glyphicon-record"></span></a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#" style="color:#fff;text-decoration:none;"><span class="glyphicon glyphicon-user"></span>Empleados<span class="caret icon-arrow-down6"></span></a>
                    <ul class="children">
                        <li><a href="registrar.php" style="color:#fff;text-decoration:none;">Agregar <span class="glyphicon glyphicon-record"></span></a></li>
                        <li><a href="suspender.php"style="color:#fff;text-decoration:none;">Suspender <span class="glyphicon glyphicon-record"></span></a></li>
                        <li><a href="eliminarEmp.php" style="color:#fff;text-decoration:none;">Eliminar <span class="glyphicon glyphicon-record"></span></a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#" style="color:#fff;text-decoration:none;"><span class="glyphicon glyphicon-folder-open"></span>Registros<span class="caret icon-arrow-down6"></span></a>
                    <ul class="children">
                        <li><a href="empLogeado.php" style="color:#fff;text-decoration:none;">Empleados Logueados<span class="glyphicon glyphicon-record"></span></a></li>
                        <li><a href="operacionesEmp.php"style="color:#fff;text-decoration:none;">Autos Registrados<span class="glyphicon glyphicon-record"></span></a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#" style="color:#fff;text-decoration:none;"><span class="glyphicon glyphicon-list-alt"></span>Listados<span class="caret icon-arrow-down6"></span></a>
                    <ul class="children">
                        <li><a href="listadoAutos.php" style="color:#fff;text-decoration:none;">Registros de Autos<span class="glyphicon glyphicon-record"></span></a></li>
                        <li><a href="listadoEstacionamiento.php" style="color:#fff;text-decoration:none;">Listado del Estacionamiento<span class="glyphicon glyphicon-record"></span></a></li>
                    </ul>
                </li>
                <li style="float:right;" id="lili" >
                    <a href="cerrarSesion.php" style="color:#fff;text-decoration:none;"><span class="glyphicon glyphicon-log-out"></span>Log out</a>
                </li>

            </ul>
  		</nav>
</header>
            <?php
    }
?>
    <div class="container">
        <form action="retirarAuto.php" method="POST" style="width: 90%; padding: 40px; margin: auto; box-shadow: 0px 0px 3px grey;">
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