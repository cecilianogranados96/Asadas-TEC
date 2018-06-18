<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$asada = $_COOKIE["asada"];

//$sth = mysqli_query($conn,"SELECT nombre, mision, vision, historia, horario, telefono, RED_SOCIAL_X_ASADA.direccion AS link, CORREO.correo AS correo FROM ASADA INNER JOIN TELEFONO_X_ASADA ON ASADA.idASADA = '$asada' AND ASADA.idASADA = TELEFONO_X_ASADA.idASADA INNER JOIN TELEFONO ON TELEFONO.idTELEFONO = TELEFONO_X_ASADA.idTELEFONO INNER JOIN RED_SOCIAL_X_ASADA ON RED_SOCIAL_X_ASADA.RED_SOCIAL_idRED_SOCIAL = 0 AND RED_SOCIAL_X_ASADA.ASADA_idASADA = ASADA.idASADA INNER JOIN CORREO_X_ASADA ON CORREO_X_ASADA.idASADA = ASADA.idASADA INNER JOIN CORREO ON CORREO.idCORREO = CORREO_X_ASADA.idCORREO");
$sth = mysqli_query($conn,"call selectAsada('$asada')");
$rows = array();

while($r = mysqli_fetch_assoc($sth)) {
$rows[] = $r;
}
echo json_encode($rows);

mysqli_close ($conn); // Connection Closed.
?>