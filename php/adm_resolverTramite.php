<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$tramite = $_COOKIE["tramite"];

$query = mysqli_query($conn, "SELECT TRAMITE_idTRAMITE AS idTRAMITE FROM FORMULARIO WHERE idFORMULARIO = '$tramite'");
$results = mysqli_fetch_array($query);
$formulario = $results['idTRAMITE'];

$sth = mysqli_query($conn,"SELECT idCAMPO, nombre, TIPO_CAMPO_idTIPO_CAMPO AS tipoCampo FROM CAMPO WHERE TRAMITE_idTRAMITE = '$formulario'");
$rows = array();

while($r = mysqli_fetch_assoc($sth)) {
$rows[] = $r;
}
echo json_encode($rows);

mysqli_close ($conn); // Connection Closed.
?>