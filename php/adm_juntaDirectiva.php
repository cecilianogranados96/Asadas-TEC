<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$asada = $_COOKIE["asada"];

$sth = mysqli_query($conn,"SELECT PUESTO_idPUESTO, PUESTO_X_JUNTA_DIRECTIVA.nombre AS nombre, PUESTO.nombre AS puesto FROM PUESTO_X_JUNTA_DIRECTIVA INNER JOIN PUESTO ON PUESTO.idPUESTO = PUESTO_X_JUNTA_DIRECTIVA.PUESTO_idPUESTO INNER JOIN JUNTA_DIRECTIVA ON JUNTA_DIRECTIVA.idJUNTA_DIRECTIVA = PUESTO_X_JUNTA_DIRECTIVA.JUNTA_DIRECTIVA_idJUNTA_DIRECTIVA INNER JOIN ASADA ON ASADA.idASADA = '$asada' AND ASADA.JUNTA_DIRECTIVA_idJUNTA_DIRECTIVA = JUNTA_DIRECTIVA.idJUNTA_DIRECTIVA ORDER BY PUESTO_idPUESTO DESC");
$rows = array();

while($r = mysqli_fetch_assoc($sth)) {
$rows[] = $r;
}
echo json_encode($rows);

mysqli_close ($conn); // Connection Closed.
?>