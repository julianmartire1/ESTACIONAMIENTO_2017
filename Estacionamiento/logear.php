<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--final de Estilos-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <title>Loguear</title>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION["admnistrador"]) && !isset($_SESSION["empleado"]))
{
?>
	<div class="container">
		</br></br>
		<form action="logear.php" method="post" style="width: 90%; padding: 40px; margin: auto; box-shadow: 0px 0px 3px grey;">
			</br>
			<div class="form-group">
				<label for="usr">Usuario:</label>
				<input class="form-control" type="text" name="usuario" id="usuario" placeholder="Ingrese nombre de usuario" required>
			</div>
			</br>
			<div class="form-group">
				<label for="usr">Contraseña:</label>
				<input class="form-control" type="password" name="pw" id="pw" placeholder="Ingrese contraseña" required>
			</div>
			</br>
			<input class="btn btn-primary" type="submit" value="Iniciar Sesion" name="iniciar">
		</form>
	</div>
    <?php
	if(isset($_POST['usuario']) && isset($_POST['pw']) && isset($_POST['iniciar'])){
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
		$usuario["password"]=$_POST["pw"];

//4.- INVOCAMOS AL METODO SOAP, PASANDOLE EL PARAMETRO DE ENTRADA
		$result = $client->call('verificarUsuario', array($usuario));

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

				if($result=="admin")
				{
					session_start();
					$_SESSION['administrador']=$_POST["usuario"];
					header("Location:menuAdmin.php");
					
				}
				else
				{
					if($result=="empleado")
					{
						session_start();
						$_SESSION['empleado']=$_POST["usuario"];
						header("Location:menuAdmin.php");
					}
					else
					{
						echo $result;
					}
				}
			}
		}
	}
}
else
header("Location:menuAdmin.php");
	
	?>
</body>
</html>