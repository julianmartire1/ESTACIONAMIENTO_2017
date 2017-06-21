<?php
date_default_timezone_set("America/Buenos_Aires");
//$ahora=strtotime(date("Y-m-d H:i:s"));
echo " - ". Probar();

function Probar(){
    /*-Cobro por hora $10, media estadía $90 (12hs) o estadía $170
(24hs)*/
    $scar=strtotime("2017-06-18 02:00:00");
    $ahora=strtotime("2017-06-19 23:00:00");

    $diferencia=$ahora - $scar;
    $i=0;

    while($diferencia>=86400)
    {
        $diferencia=$diferencia-86400;
        $i++;
    }

    $resultado=$i*170;

    if($diferencia <= 43200 && $diferencia >= 32400)
        $resultado=$resultado + 90;
    else 
    {
        if($diferencia < 32400)
            $resultado+=ceil($diferencia/60/60) *10;
            else
            {
                if($diferencia > 43200 && $diferencia < 72000)
                {
                    $ceil=ceil($diferencia/60/60) - 12;
                    $resultado=$resultado+90+$ceil*10; 
                }
                else
                {
                    $resultado+=170;
                }
                
            }
    }


    return $resultado;

}
?>



