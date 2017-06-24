<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <title>Eliminar Empleado</title>
</head>
<body>

<?php 
session_start();
if(isset($_SESSION["administrador"]))
{

?>
	<div class="container">
		<form action="eliminarEmp.php" method="post">
			</br>
			<div class="form-group">
				<label for="usr">Usuario:</label>
				<input class="form-control" type="text" name="usuario" id="usuario" placeholder="Ingrese usuario del empleado a eliminar"></br>
			</div>
			<input class="btn btn-danger" type="submit" value="Eliminar" name="eliminar"> <a href="menuAdmin.php">Volver al menu</a>
		</form>
	</div>
    <?php

    
	if(isset($_POST['eliminar'])){
///***********************************************************************************************///
///COMO CLIENTE DEL SERVICIO WEB///
///***********************************************************************************************///
		
//1.- INCLUIMOS LA LIBRERIA NUSOAP DENTRO DE NUESTRO ARCHIVO
		require_once('lib/nusoap.php');

//2.- INDICAMOS URL DEL WEB SERVICE
		$host = 'http://localhost/Estacionamiento/SERVIDOR/testWS.php';
		
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
		$result = $client->call('eliminarEmpleado', array($usuario));

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
                echo '<script language="javascript">alert("'.$result.'");</script>';
				
			}
		}
	}
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
</body>
</html>