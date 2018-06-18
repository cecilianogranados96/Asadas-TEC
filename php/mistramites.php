<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$usuario = $_COOKIE["usuario"];
$asada = $_COOKIE["asada"];

$sth = mysqli_query($conn,"SELECT idFORMULARIO, fecha, TRAMITE.nombre AS nombre, ESTADO_SOLICITUD.nombre AS estado FROM FORMULARIO INNER JOIN TRAMITE ON FORMULARIO.USUARIO_nombreUsuario = '$usuario' AND TRAMITE.idTRAMITE = FORMULARIO.TRAMITE_idTRAMITE AND TRAMITE.ASADA_idASADA = '$asada' INNER JOIN ESTADO_SOLICITUD ON ESTADO_SOLICITUD.idESTADO_SOLICITUD = FORMULARIO.ESTADO_SOLICITUD_idESTADO_SOLICITUD ORDER BY fecha ASC");

$rows = array();

while($r = mysqli_fetch_assoc($sth)) {
$rows[] = $r;
}
echo json_encode($rows);

mysqli_close ($conn); // Connection Closed.
?>