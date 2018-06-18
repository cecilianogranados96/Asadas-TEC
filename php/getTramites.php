<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$correoUsuario = $_POST['email1']; // Fetching Values from URL.

$sth = mysqli_query($conn,"SELECT FORMULARIO.fecha, ESTADO_SOLICITUD.nombre as estado, TRAMITE.nombre FROM FORMULARIO INNER JOIN TRAMITE ON FORMULARIO.TRAMITE_idTRAMITE = TRAMITE.idTRAMITE  INNER JOIN ESTADO_SOLICITUD ON FORMULARIO.ESTADO_SOLICITUD_idESTADO_SOLICITUD = ESTADO_SOLICITUD.idESTADO_SOLICITUD WHERE FORMULARIO.USUARIO_nombreUsuario = '$correoUsuario'");

$rows = array();

while($r = mysqli_fetch_assoc($sth)) {
$rows[] = $r;
}
echo json_encode($rows);

mysqli_close ($conn); // Connection Closed.
?>