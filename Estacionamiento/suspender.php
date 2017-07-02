<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <link rel="stylesheet" href="estilos.css">
    <!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
    <script type='text/javascript' src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js'></script>
    <script type='text/javascript' src='http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js'></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <title>Suspender Empleado</title>
	<script type="text/javascript">

    function alerta()
    {
      alert("hola");
    }

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
</head>
<body>
<?php
session_start();
if(isset($_SESSION["administrador"]))
{
?> 
	<header>
		<div class="menu_bar">
			<a href="#" style="color:#fff" class="bt-menu">Menú<span class="glyphicon glyphicon-th-list"></span></a>
		</div>

		<nav>
			<ul>
				<li><a href="menuAdmin.php" style="color:#fff;text-decoration:none;"><span class="glyphicon glyphicon-home"></span>Inicio</a></li>
				<li class="submenu">
					<a href="#" style="color:#fff;text-decoration:none;"><span class="glyphicon glyphicon-road"></span>Autos<span class="caret icon-arrow-down6"></span></a>
					<ul class="children">
						<li><a href="ingresarAutoAdmin.php" style="color:#fff;text-decoration:none;">Agregar <span class="glyphicon glyphicon-record"></span></a></li>
						<li><a href="retirarAuto.php"style="color:#fff;text-decoration:none;">Retirar <span class="glyphicon glyphicon-record"></span></a></li>
					</ul>
				</li>
				<li class="submenu">
					<a href="#" style="color:#fff;background:#e6344a;text-decoration:none;"><span class="glyphicon glyphicon-user"></span>Empleados<span class="caret icon-arrow-down6"></span></a>
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
					<a href="cerrarSesion.php" style="color:#fff;text-decoration:none"><span class="glyphicon glyphicon-log-out"></span>Log out</a>
				</li>
			</ul>
		</nav>
	</header>
	<div class="container">
    <form action="suspender.php" method="post" style="width: 90%; padding: 40px; margin: auto; box-shadow: 0px 0px 3px grey;">
		</br>
		<div class="form-group">
            <label for="usr">Usuario:</label>
        	<input class="form-control" type="text" name="usuario" id="usuario" placeholder="Ingrese el usuario del empleado a suspender"></br>
		</div>

        <input class="btn btn-warning" type="submit" value="Suspender" name="suspender"> <a href="menuAdmin.php">Volver al menu</a>
    </form>

    
	</div>
    <?php

    
	if(isset($_POST['suspender'])){
///***********************************************************************************************///
///COMO CLIENTE DEL SERVICIO WEB///
///***********************************************************************************************///
		
//1.- INCLUIMOS LA LIBRERIA NUSOAP DENTRO DE NUESTRO ARCHIVO
		require_once('lib/nusoap.php');

//2.- INDICAMOS URL DEL WEB SERVICE
		$host = 'http: //localhost/Estacionamiento/SERVIDOR/testWS.php';
		
//3.- CREAMOS LA INSTANCIA COMO CLIENTE
		$client = new nusoap_client($host . '?wsdl');

//3.- CHECKEAMOS POSIBLES ERRORES AL INSTANCIAR
		$err = $client->getError();
		if ($err) {
			echo '<h2>ERROR EN LA CONSTRUCCION DEL WS:</h2><pre>' . $err . '</pre>';
			die();
		}

$usuario["usuario"]=$_POST["usuario"];


//4.- INVOCAMOS AL METODO SOAP, PASANDOLE EL PARAMETRO DE ENTRADA
		$result = $client->call('suspenderEmpleado', array($usuario));

//5.- CHECKEAMOS POSIBLES ERRORES AL INVOCAR AL METODO DEL WS 
		if ($client->fault) {
			echo '<h2>ERROR AL INVOCAR METODO:</h2><pre>';
			print_r($result);
			echo '</pre>';
		} 
		else {// CHECKEAMOS POR POSIBLES ERRORES
			$err = $client->getError();
			if ($err) {//MOSTRAMOS EL ERROR
				echo '<h2>ERROR EN EL CLIENTE:</h2><pre>' . $err . '</pre>';
			} 
			else {//MOSTRAMOS EL RESULTADO DEL METODO DEL WS.
				//echo '<pre>' . $result . '</pre>';
                echo '<script language="javascript">alert("'.$result.'");</script>';
				
			}
		}
	}
}
else {
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
</body>
</html>