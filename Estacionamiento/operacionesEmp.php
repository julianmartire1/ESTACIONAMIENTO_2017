<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Listado de los Autos</title>
    
    <link rel="stylesheet" href="estilos.css">
    <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
    <script type='text/javascript' src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js'></script>
    <script type='text/javascript' src='http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js'></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>

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
    require_once "Empleado.php";
session_start();
    ?>

    <header>
  		<div class="menu_bar">
  			  <a href="#" style="color:#fff" class="bt-menu">Menú<span class="glyphicon glyphicon-th-list"></span></a>
  		</div>

  		<nav>
      			<ul>
      				<li><a href="menuAdmin.php" style="color:#fff"><span class="glyphicon glyphicon-home"></span>Inicio</a></li>
      				<li class="submenu">
        					<a href="#" style="color:#fff"><span class="glyphicon glyphicon-road"></span>Autos<span class="caret icon-arrow-down6"></span></a>
        					<ul class="children">
                    <li><a href="ingresarAutoAdmin.php" style="color:#fff;">Agregar <span class="glyphicon glyphicon-record"></span></a></li>
                    <li><a href="retirarAuto.php"style="color:#fff;">Retirar <span class="glyphicon glyphicon-record"></span></a></li>
        					</ul>
      				</li>
              <li class="submenu">
        					<a href="#" style="color:#fff"><span class="glyphicon glyphicon-user"></span>Empleados<span class="caret icon-arrow-down6"></span></a>
        					<ul class="children">
                    <li><a href="registrar.php" style="color:#fff;">Agregar <span class="glyphicon glyphicon-record"></span></a></li>
                    <li><a href="suspender.php"style="color:#fff;">Suspender <span class="glyphicon glyphicon-record"></span></a></li>
                    <li><a href="eliminarEmp.php" style="color:#fff;">Eliminar <span class="glyphicon glyphicon-record"></span></a></li>
        					</ul>
      				</li>
              <li class="submenu">
        					<a href="#" style="color:#fff;background:#e6344a;"><span class="glyphicon glyphicon-folder-open"></span>Registros<span class="caret icon-arrow-down6"></span></a>
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
</br>

<?php

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

        <table class='table table-bordered'>
        <tr>
            <th colspan='4'>Cantidad de operaciones</th>
        </tr>
        <tr>
            <th>Empleado</th><th>Cantidad</th>
        </tr>  
<?php   
        $arrayEmpleados=Empleado::TraerEmpleados();

        foreach ($arrayEmpleados as $item) {
            if($item["categoria"]!="admin")
            {
            ?>
                <tr>
                    <td>  <?php echo $item["usuario"]; ?> </td><td>  <?php echo  Empleado::totalOperacionesEmpleado($item["usuario"]);  ?></td>
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