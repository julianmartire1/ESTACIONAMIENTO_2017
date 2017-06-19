<?php ///***********************************************************************************************///
///COMO PROVEEDOR DEL SERVICIO WEB///
///***********************************************************************************************///

//1.- INCLUIMOS LA LIBRERIA NUSOAP DENTRO DE NUESTRO ARCHIVO
 require_once("../lib/nusoap.php"); 
 require_once("../Empleado.php");

//2.- CREAMOS LA INSTACIA AL SERVIDOR
 $server = new nusoap_server(); 

//3.- INICIALIZAMOS EL SOPORTE WSDL (Web Service Description Language)
 $server->configureWSDL('Mi Web Service #2', 'urn:EstacionamientoWS'); 

//3.1- AGREGAR DATO COMPLEJO

$server->wsdl->addComplexType(
 
  'empleado',
  'complexType',
  'struct',
  'all',
  '',
  array( 'nombre' => array('name' => 'nombre', 'type' => 'xsd:string'),
        'apellido' => array('name' => 'apellido', 'type' => 'xsd:string'),
        'legajo' => array('name' => 'legajo', 'type' => 'xsd:int'),
        'turno' => array('name' => 'turno', 'type' => 'xsd:string'),
        'categoria' => array('name' => 'categoria', 'type' => 'xsd:string'),
        'usuario' => array('name' => 'usuario', 'type' => 'xsd:string'),        
        'password' => array('name' => 'password', 'type' => 'xsd:string'),
        'estado' => array('name' => 'estado', 'type' => 'xsd:string')
  )
     
     
 );

 $server->wsdl->addComplexType(
 
  'user', 
  'complexType',
  'struct',
  'all',
  '',
  array('usuario' => array('name' => 'usuario', 'type' => 'xsd:string'),
     'password' => array('name' => 'password', 'type' => 'xsd:string')
     )
 );

//4.- REGISTRAMOS EL METODO A EXPONER
 $server->register('verificarUsuario',                 // METODO
    array('usuario' => 'tns:user'),   // PARAMETROS DE ENTRADA
    array('return' => 'xsd:string'),      // PARAMETROS DE SALIDA
    'urn:EstacionamientoWS',                   // NAMESPACE
    'urn:EstacionamientoWS#verificarUsuario',            // ACCION SOAP
    'rpc',                           // ESTILO
    'encoded',                       // CODIFICADO
    'Verificamos si el usuario existe'   // DOCUMENTACION
   );

   $server->register('agregarEmpleado',                 // METODO
    array('Empleado' => 'tns:empleado'),   // PARAMETROS DE ENTRADA
    array('return' => 'xsd:string'),      // PARAMETROS DE SALIDA
    'urn:EstacionamientoWS',                   // NAMESPACE
    'urn:EstacionamientoWS#agregarEmpleado',            // ACCION SOAP
    'rpc',                           // ESTILO
    'encoded',                       // CODIFICADO
    'Agrega un empleado'   // DOCUMENTACION
   );

   $server->register('suspenderEmpleado',                 // METODO
    array('Empleado' => 'tns:empleado'),   // PARAMETROS DE ENTRADA
    array('return' => 'xsd:string'),      // PARAMETROS DE SALIDA
    'urn:EstacionamientoWS',                   // NAMESPACE
    'urn:EstacionamientoWS#suspenderEmpleado',            // ACCION SOAP
    'rpc',                           // ESTILO
    'encoded',                       // CODIFICADO
    'Suspende un empleado'   // DOCUMENTACION
   );

   $server->register('eliminarEmpleado',                 // METODO
    array('Empleado' => 'tns:empleado'),   // PARAMETROS DE ENTRADA
    array('return' => 'xsd:string'),      // PARAMETROS DE SALIDA
    'urn:EstacionamientoWS',                   // NAMESPACE
    'urn:EstacionamientoWS#eliminarEmpleado',            // ACCION SOAP
    'rpc',                           // ESTILO
    'encoded',                       // CODIFICADO
    'Elimina un empleado'   // DOCUMENTACION
   );

//5.- DEFINIMOS EL METODO COMO UNA FUNCION PHP

 function verificarUsuario($usuario) 
    {

        $arrayDeEmpleados = Empleado::TraerEmpleados();


        foreach ($arrayDeEmpleados as $item)
        {
            if($item["usuario"] == $usuario["usuario"] && $item["pw"] == $usuario["password"])
            {
                
                if($item["categoria"] == "admin")
                {
                    return "admin";
                }
                else
                {
     				return "empleado";
                }
            }
        }

        return "no existe";
 }


 function agregarEmpleado($Empleado)
 {
    $empleado=new Empleado($Empleado["nombre"],$Empleado["apellido"],$Empleado["legajo"],$Empleado["turno"],$Empleado["categoria"],$Empleado["usuario"],$Empleado["password"],$Empleado["estado"]);
    return "agregado";
 }

function suspenderEmpleado($Empleado)
{
    $band=false;
    $usuario="";
    $arrayDeEmpleados = Empleado::TraerEmpleados();


    foreach ($arrayDeEmpleados as $item) {

        if($item["usuario"]==$Empleado["usuario"])
        {
            $pdo = new PDO("mysql:host=localhost;dbname=estacionamiento","root","");
            $consulta = $pdo->prepare("UPDATE `empleados` SET `estado`='suspendido' WHERE `usuario`=:usuario");
            $consulta->bindParam(":usuario",$item['usuario']);
            $consulta->execute();
            $retorno="El usuario: ".$item['usuario'];
            $band=true;
            break;
        }
    }


    if($band==true)
    {   
        return $retorno ." fue suspendido";
    }
    else
    {   
        return $retorno ." no suspendido";
    }
}

function eliminarEmpleado($Empleado)
{
    $band=false;
    $usuario="";
    $arrayDeEmpleados = Empleado::TraerEmpleados();


    foreach ($arrayDeEmpleados as $item) {

        if($item["usuario"]==$Empleado["usuario"])
        {
            $pdo = new PDO("mysql:host=localhost;dbname=estacionamiento","root","");
            $consulta = $pdo->prepare("UPDATE `empleados` SET `estado`='eliminado' WHERE `usuario`=:usuario");
            $consulta->bindParam(":usuario",$item['usuario']);
            $consulta->execute();
            $retorno="El usuario: ".$item['usuario'];
            $band=true;
            break;
        }
    }


    if($band==true)
    {   
        return $retorno ." fue eliminado";
    }
    else
    {   
        return $retorno ." no eliminado";
    }
}
 


//6.- USAMOS EL PEDIDO PARA INVOCAR EL SERVICIO
 $HTTP_RAW_POST_DATA = file_get_contents("php://input");
 
 $server->service($HTTP_RAW_POST_DATA);


?>