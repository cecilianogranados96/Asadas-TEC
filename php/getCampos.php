<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$tramite = $_COOKIE["tramite"];

$sth = mysqli_query($conn,"SELECT idCAMPO, nombre FROM CAMPO WHERE TRAMITE_idTRAMITE='$tramite' AND TIPO_CAMPO_idTIPO_CAMPO=1 ORDER BY idCAMPO ASC");
$rows = array();

while($r = mysqli_fetch_assoc($sth)) {
$rows[] = $r;
}
echo json_encode($rows);

mysqli_close ($conn); // Connection Closed.
?>