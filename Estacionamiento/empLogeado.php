<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="estilos.css">
    <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <title>Buscar login del empleado</title>
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

    $(document).ready(function(){

      $('.ir-arriba').click(function(){
          $('body, html').animate({
            scrollTop: '0px'
          }, 400);
        });
      });


      $(window).scroll(function(){
    		if( $(this).scrollTop() > 0 ){
    			$('.ir-arriba').slideDown(300);
    		} else {
    			$('.ir-arriba').slideUp(300);
    		}
    	});

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
        					<a href="#" style="color:#fff;text-decoration:none;"><span class="glyphicon glyphicon-user"></span>Empleados<span class="caret icon-arrow-down6"></span></a>
        					<ul class="children">
                    <li><a href="registrar.php" style="color:#fff;text-decoration:none;">Agregar <span class="glyphicon glyphicon-record"></span></a></li>
                    <li><a href="suspender.php"style="color:#fff;text-decoration:none;">Suspender <span class="glyphicon glyphicon-record"></span></a></li>
                    <li><a href="eliminarEmp.php" style="color:#fff;text-decoration:none;">Eliminar <span class="glyphicon glyphicon-record"></span></a></li>
        					</ul>
      				</li>
              <li class="submenu">
        					<a href="#" style="color:#fff;background:#e6344a;text-decoration:none;"><span class="glyphicon glyphicon-folder-open"></span>Registros<span class="caret icon-arrow-down6"></span></a>
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
      <span class="ir-arriba glyphicon glyphicon-menu-up" id="arriba"></span>
    <div class="container">
        <form action="empLogeado.php" method="post" style="width: 90%; padding: 40px; margin: auto; box-shadow: 0px 0px 3px grey;">
            </br>
			<div class="form-group">
				<label for="usr">Usuario:</label>
                <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Ingrese el usuario del empleado a buscar"></br>
            </div>
            <input class="btn btn-primary" type="submit" value="Buscar" name="empDia"> <a href="menuAdmin.php">Volver al menu</a>
        </form>
        
        <?php

        if(isset($_POST["empDia"]))
        {
            $array=array();
            $pdo = new PDO("mysql:host=localhost;dbname=estacionamiento","root","");
            $usuario=$_POST["usuario"];
            $consulta = $pdo->prepare("SELECT `empleado`, `dia` FROM `registrolog` WHERE 1");
            $consulta->execute();

            while($row = $consulta->fetch(PDO::FETCH_ASSOC))
            {
                $array[] = $row;
            }

            

            echo "</br></br><table class='table table-bordered'>
        <tr><th>Empleado</th><th>Se legueo</th></tr>";

            foreach ($array as $item) {
                if($item["empleado"]==$usuario)
                echo "<tr><td>". $item["empleado"]."</td><td>".$item["dia"]."</tr>";
            }
            echo "</tr></table>";
        }
}
else{
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
        </br>
        
    </div>

    <style media="screen">
    .ir-arriba{
        display: none;
        padding: 20px;
        background: #024959;
        font-size: 20px;
        color: #fff;
        cursor: pointer;
        position: fixed;
        top: 90%;
        right: 20px;
        border-radius: 30px;
      }
      .ir-arriba:hover{
        background: #E6344A;
      }
    </style>
</body>
</html>