<?php
date_default_timezone_set("America/Buenos_Aires");

$ahora=strtotime(date("Y-m-d H:i:s"));
$scar=strtotime("2017-06-18 02:00:00");

$diferencia=$ahora-$scar;
echo $diferencia/60/60 ."</br>";
echo ceil($diferencia/60/60) ."</br>";


?>



