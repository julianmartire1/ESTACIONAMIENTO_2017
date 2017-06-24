<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ingresar auto</title>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript">


    function agregarOpciones()
    {
        
        var pagina = "administrar.php";
        
            $.ajax({
                type: 'POST',//GET o POST. GET DEFAULT.
                url: pagina,//PAGINA DESTINO DE LA PETICION
                dataType: "text",//INDICA EL TIPO QUE SE ESPERA RECIBIR DESDE EL SERVIDOR (XML, HTML, TEXT, JSON, SCRIPT) 
                data: "optipo="+$("#optipo").val(),//DATO A SER ENVIADO AL SERVIDOR. TIPO: OBJETO, STRING, ARRAY.
                async: true,//ESTABLECE EL MODO DE PETICION. DEFECTO ASINCRONICO.
                statusCode: {//CODIGO NUMERICO DE RESPUESTA HTTP
                        200: function(){
                            console.log("200 - Encontrado!!!");
                        },
                        404: function(){
                            console.log("404 - No encontrado!!!");
                        }
                    }
                })
            .done(function (data) {//RECUPERO LA RESPUESTA DEL SERVIDOR EN 'RESULTADO', DE ACUERDO AL DATATYPE.
                //alert(data);
                    $("#cochera").html(data);
                //alert(data);
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });
    }


    function ingresarAuto(patente,color,marca,optipo,cochera)
    {

        var pagina = "http://localhost/Estacionamiento/apirest/vehiculo";

        
        var formData = new FormData();
        formData.append("patente",$("#patente").val());
        formData.append("color",$("#color").val());
        formData.append("marca",$("#marca").val());        
        formData.append("optipo",$("#optipo").val());
        formData.append("cochera",$("#cochera").val());
        formData.append("empleado",empleado);


        //alert($("#cochera").val());

        $.ajax({
                type: 'POST',
                url: pagina,
                dataType: "text",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                async: true
            })
            .done(function (objJson) {
                alert(objJson);
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
    }
    else {
        echo "<script type='text/javascript'>
            
            var empleado='';

            </script>";
    }
    

?>
    <div class="container">
        <form action="ingresarAutoAdmin.php" method="POST">
            </br>
            <div class="form-group">
				<label for="usr">Patente:</label>
                <input class="form-control" type="text" name="patente" id="patente" placeholder="Ingrese Patente" required></br>
            </div>

            <div class="form-group">
				<label for="usr">Color:</label>
                <input class="form-control" type="text" name="color" id="color" placeholder="Ingrese Color" required></br>
            </div>

            <div class="form-group">
				<label for="usr">Marca:</label>
                <input class="form-control" type="text" name="marca" id="marca" placeholder="Ingrese Marca" required></br>
            </div>

            <div class="form-group">
				<label for="usr">Reservado:</label>
                <select class="form-control" id="optipo" name="optipo" onchange="agregarOpciones()" required> 
                    <option value="">[Seleccione una opción]</option>        
                    <option value="normal">Normal</option>
                    <option value="especial">Discapacitado/Embarazada</option>
                </select>
            </div>

            </br>
            <div class="form-group">
				<label for="usr">Piso y Cochera:</label>
                <select class="form-control" name="cochera" id="cochera" required>
                    <option value="">--Esperando selección--</option>
                </select>
            </div>
            
        </form>
        <input class="btn btn-warning" type="button" value="Ingresar Auto" name="ingresar" onclick="ingresarAuto($('#patente').val(),$('#color').val(),$('#marca').val(),$('#optipo').val(),$('#cochera').val())"> <a href="menuAdmin.php">Volver al menu</a>

        
<?php
}
else
    header("Location:index.php");
?>
    </div>
</body>
</html>


