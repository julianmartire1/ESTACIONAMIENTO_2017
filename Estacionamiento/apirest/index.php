

    <?php
    date_default_timezone_set("America/Buenos_Aires");
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require '/vendor/autoload.php';
    require "../Auto.php";

    $config['displayErrorDetails'] = true;
    $config['addContentLengthHeader'] = false;
    /*

    ¡La primera línea es la más importante! A su vez en el modo de
    desarrollo para obtener información sobre los errores
    (sin él, Slim por lo menos registrar los errores por lo que si está utilizando
    el construido en PHP webserver, entonces usted verá en la salida de la consola
    que es útil).

    La segunda línea permite al servidor web establecer el encabezado Content-Length,
    lo que hace que Slim se comporte de manera más predecible.
    */

    $app = new \Slim\App(["settings" => $config]);
/*
    $app->get('/', function (Request $request, Response $response) {

      $response->getBody()->write("Hola Slim con .htaccess");

      return $response;
    });*/

    $app->get('/vehiculo',
      function(Request $request,Response $response )
      {
          $array=array();
          $array=Auto::listarAutos();


          $response->getBody()->write(json_encode($array));

      });

    $app->post('/vehiculo',
      function(Request $request,Response $response )
      {
          $band=false;
          $band2=false;
          $ArrayDeParametros = $request->getParsedBody();

          $patente= $ArrayDeParametros['patente'];
          $color= $ArrayDeParametros['color'];
          $marca= $ArrayDeParametros['marca'];
          $piso=$ArrayDeParametros['cochera'];
          $empleado=$ArrayDeParametros['empleado'];

      //return var_dump($ArrayDeParametros);

          $fechaInicial= date("Y-m-d H:i:s");

          $arraydeautos=Auto::listarAutos();

          if(count($arraydeautos)==0)
          {
            $band2=true;
          }
          else
          {
            foreach ($arraydeautos as $item) {
                if($item["patente"]==$patente)
                {
                    $json["opcion"] = "Ya existe el Auto";
                    return json_encode($json["opcion"]);
                }
                else
                {                    
                     $band2=true;
                }
            }
          }


        $array=array("patente"=>$patente,"color"=>$color,"marca"=>$marca,"cochera"=>$piso,"fechaInicial"=>$fechaInicial);

          if($band2==true)
            {
                $band=Auto::agregarAutoAlEstacionamiento($array);
                
            }
          else
          {
              $json["opcion"] = "Ya existe el Auto";
              return json_encode($json["opcion"]);
          }

          if($band)
          {
            $pdo = new PDO("mysql:host=localhost;dbname=estacionamiento","root","");

            $auxNumero=1;

            $consulta = $pdo->prepare("INSERT INTO `operaciones`(`empleado`, `operacion`, `auto`, `cochera`, `fecha`, `cantidad`) VALUES ('$empleado',$auxNumero,'$patente','$piso',NOW(),$auxNumero)");
            $consulta->execute();



            $json["opcion"] = "Auto Agregado ";
             return json_encode($json["opcion"]);
          }
          else
          {
              $json["opcion"] = "Cochera no disponible";
              return json_encode($json["opcion"]);
          }

          

      });


      $app->put('/vehiculo',
      function(Request $request,Response $response )
      {
        $ArrayDeParametros = $request->getParsedBody();
        $band=false;
        $patente= $ArrayDeParametros['patente'];
        $empleado= $ArrayDeParametros['emp'];


        $band=Auto::retirarAuto($patente);


        if($band==false)
            $json["opcion"] = "No se puede retirar";
        else
        {
            $fInicial=Auto::traerFechaIngreso($patente);
            if($fInicial==false)
                $json["opcion"] = "Error al encontrar la fecha";
            else
            {
                $pdo = new PDO("mysql:host=localhost;dbname=estacionamiento","root","");

                $auxNumero=2;
                $piso=Auto::traerCochera($patente);
                $consulta = $pdo->prepare("INSERT INTO `operaciones`(`empleado`, `operacion`, `auto`, `cochera`, `fecha`, `cantidad`) VALUES ('$empleado',$auxNumero,'$patente','$piso',NOW(),$auxNumero-1)");
                $consulta->execute();
                $json["opcion"] = "Tiene que pagar ".Auto::calcularCosto($fInicial)."$";
            }
        }


            return json_encode($json["opcion"]);
          

      });

    $app->run();


?>
