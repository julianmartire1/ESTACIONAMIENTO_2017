<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu</title>
    <link rel="stylesheet" href="estilos.css">
    <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
    <script type='text/javascript' src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js'></script>
    <script type='text/javascript' src='http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js'></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    
    <title>Menu</title>
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

if (isset($_SESSION["administrador"])) {
    //echo "Bienvenido ".$_SESSION['administrador'];

    ?>

    <header>
  		<div class="menu_bar">
  			  <a href="#" style="color:#fff" class="bt-menu">Menú<span class="glyphicon glyphicon-th-list"></span></a>
  		</div>

  		<nav>
      			<ul>
      				<li><a href="menuAdmin.php" style="color:#fff;background:#e6344a;"><span class="glyphicon glyphicon-home"></span>Inicio</a></li>
      				<li class="submenu">
        					<a href="#" style="color:#fff;"><span class="glyphicon glyphicon-road"></span>Autos<span class="caret icon-arrow-down6"></span></a>
        					<ul class="children">
                    <li><a href="ingresarAutoAdmin.php" style="color:#fff;">Agregar <span class="glyphicon glyphicon-record"></span></a></li>
                    <li><a href="retirarAuto.php"style="color:#fff;">Retirar <span class="glyphicon glyphicon-record"></span></a></li>
        					</ul>
      				</li>
              <li class="submenu">
        					<a href="#" style="color:#fff;"><span class="glyphicon glyphicon-user"></span>Empleados<span class="caret icon-arrow-down6"></span></a>
        					<ul class="children">
                    <li><a href="registrar.php" style="color:#fff;">Agregar <span class="glyphicon glyphicon-record"></span></a></li>
                    <li><a href="suspender.php"style="color:#fff;">Suspender <span class="glyphicon glyphicon-record"></span></a></li>
                    <li><a href="eliminarEmp.php" style="color:#fff;">Eliminar <span class="glyphicon glyphicon-record"></span></a></li>
        					</ul>
      				</li>
              <li class="submenu">
        					<a href="#" style="color:#fff;"><span class="glyphicon glyphicon-folder-open"></span>Registros<span class="caret icon-arrow-down6"></span></a>
        					<ul class="children">
                    <li><a href="empLogeado.php" style="color:#fff;">Empleados Logueados<span class="glyphicon glyphicon-record"></span></a></li>
                    <li><a href="operacionesEmp.php"style="color:#fff;">Autos Registrados<span class="glyphicon glyphicon-record"></span></a></li>
        					</ul>
      				</li>
              <li class="submenu">
                    <a href="#" style="color:#fff;"><span class="glyphicon glyphicon-list-alt"></span>Listados<span class="caret icon-arrow-down6"></span></a>
                    <ul class="children">
                        <li><a href="listadoAutos.php" style="color:#fff;">Autos<span class="glyphicon glyphicon-record"></span></a></li>
                    </ul>
              </li>
                <li style="float:right;" id="lili" >
                      <a href="cerrarSesion.php" style="color:#fff;"><span class="glyphicon glyphicon-log-out"></span>Log out</a>
                </li>

      			</ul>
  		</nav>
	  </header>

<div class="container">
    <div class='jumbotron' style="margin:20% auto;">
        <h1 class="text-center">Bienvenido, <?php echo $_SESSION["administrador"]; ?></h1>
    </div>
</div>
    <!--
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
            <div class="btn-group">
                <input class='btn btn-success' type='button' name='registroAutos' value='Operaciones de los empleados' onclick = "location='operacionesEmp.php'">
            </div>
            
        </div>
        <form action='menuAdmin.php' method='post'>                
            <input class='btn btn-danger btn-block' type='submit' name='desloguear' value='Cerrar Sesion'>
        </form>
        
    </div>-->

    

    <?php

    

    
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

        <header>
  		<div class="menu_bar">
  			  <a href="#" style="color:#fff" class="bt-menu">Menú<span class="glyphicon glyphicon-th-list"></span></a>
  		</div>

  		<nav>
      			<ul>
      				<li><a href="menuAdmin.php" style="color:#fff;background:#e6344a;"><span class="glyphicon glyphicon-home"></span>Inicio</a></li>
      				<li class="submenu">
        					<a href="#" style="color:#fff;"><span class="glyphicon glyphicon-road"></span>Autos<span class="caret icon-arrow-down6"></span></a>
        					<ul class="children">
                    <li><a href="ingresarAutoAdmin.php" style="color:#fff;">Agregar <span class="glyphicon glyphicon-record"></span></a></li>
                    <li><a href="retirarAuto.php"style="color:#fff;">Retirar <span class="glyphicon glyphicon-record"></span></a></li>
        					</ul>
      				</li>
              <li class="submenu">
                    <a href="#" style="color:#fff;"><span class="glyphicon glyphicon-list-alt"></span>Listados<span class="caret icon-arrow-down6"></span></a>
                    <ul class="children">
                        <li><a href="listadoAutos.php" style="color:#fff;">Autos<span class="glyphicon glyphicon-record"></span></a></li>
                    </ul>
              </li>
                <li style="float:right;" id="lili" >
                      <a href="cerrarSesion.php" style="color:#fff;"><span class="glyphicon glyphicon-log-out"></span>Log out</a>
                </li>

      			</ul>
  		</nav>
	  </header>



    <div class="container">
    <div class='jumbotron' style="margin:20% auto;">
        <h1 class="text-center">Bienvenido, <?php echo $_SESSION["administrador"]; ?></h1>
    </div>
</div>
    

    

    <?php
    }
    else
    {
        header("Location:index.php");
    }
}


?>


</body>
</html>