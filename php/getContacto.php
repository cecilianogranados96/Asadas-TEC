<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$asada = $_COOKIE["asada"];

$sth = mysqli_query($conn,"SELECT telefono, CORREO.correo AS correo FROM TELEFONO INNER JOIN TELEFONO_X_ASADA ON TELEFONO_X_ASADA.idASADA = '$asada' AND TELEFONO_X_ASADA.idTELEFONO = TELEFONO.idTELEFONO INNER JOIN CORREO_X_ASADA ON CORREO_X_ASADA.idASADA = '$asada' AND TELEFONO_X_ASADA.idASADA = CORREO_X_ASADA.idASADA INNER JOIN CORREO ON CORREO.idCORREO = CORREO_X_ASADA.idCORREO");
$rows = array();

while($r = mysqli_fetch_assoc($sth)) {
	$rows[] = $r;
}
echo json_encode($rows);

mysqli_close ($conn); // Connection Closed.
?>