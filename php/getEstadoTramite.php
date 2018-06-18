<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$tramite = $_COOKIE["tramite"];

$sth = mysqli_query($conn,"SELECT nombre, idESTADO_SOLICITUD AS estado FROM ESTADO_SOLICITUD INNER JOIN FORMULARIO ON FORMULARIO.idFORMULARIO = '$tramite' AND ESTADO_SOLICITUD.idESTADO_SOLICITUD = FORMULARIO.ESTADO_SOLICITUD_idESTADO_SOLICITUD");
$rows = array();

while($r = mysqli_fetch_assoc($sth)) {
$rows[] = $r;
}
echo json_encode($rows);

mysqli_close ($conn); // Connection Closed.
?>