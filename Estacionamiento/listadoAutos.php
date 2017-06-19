
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Listado de los Autos</title>
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="jquery.js"></script>

  <script type="text/javascript">
  window.onload=traerTodos;

  function traerTodos(){
    var pagina = "http://localhost/Estacionamiento/apirest/vehiculo";

    $.ajax({
        type: 'GET',
        url: pagina,
        dataType: "json",
        async: true
    })
    .done(function (objJson) {

        var tablaEncabezado = "<table class='table table-bordered'>";
        tablaEncabezado += "<tr><th>Patente</th><th>Color</th><th>Marca</th><th>Fecha de ingreso</th></tr>";
        var tablaCuerpo = "";
        var tablaPie = "</tr></html>";

        for(var i=0;i<objJson.length;i++){
            tablaCuerpo += "<tr><td>"+objJson[i]["patente"]+"</td><td>"+objJson[i]["color"];
            tablaCuerpo += "</td><td>"+objJson[i]["marca"]+"</td><td>"+objJson[i]["fechaInicial"]+"</td>";
            //tablaCuerpo += "</td><td><a href='modificar.php' data-id='"+objJson[i]["id"]+"' onclick='administrarModificar("+objJson[i]["id"]+")' data-toggle='modal' data-target='#myModal' class='open-Modal'>MODIFICAR</a>&nbsp;";
          //tablaCuerpo += "&nbsp;<a href='#' onclick='eliminar("+objJson[i].id+")'>ELIMINAR</a></td></tr>";
    }

        $("#tabla").html(tablaEncabezado+tablaCuerpo+tablaPie);

    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
    });    

}
  
  </script>
</head>
<body>
    <div class="container">
    </br>
        <div id="tabla"></div>
        <a href="menuAdmin.php">Volver al menu &nbsp</a>
        <a href="ingresarAutoAdmin.php">Ingresar otro auto</a>
    </div>

</body>
</html>