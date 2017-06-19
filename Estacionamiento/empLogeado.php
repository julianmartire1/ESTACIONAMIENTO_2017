<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <title>Buscar login del empleado</title>
</head>
<body>
    <div class="container">
        <form action="empLogeado.php" method="post">
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


            foreach ($array as $item) {
                if($item["empleado"]==$usuario)
                    echo "</br>" . $item["empleado"]. " se logeo: ".$item["dia"]."</br>";
            }
        }


        ?>
        </br>
        
    </div>
</body>
</html>