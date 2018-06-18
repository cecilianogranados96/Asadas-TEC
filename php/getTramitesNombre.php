<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$asada = $_COOKIE["asada"];

$sth = mysqli_query($conn,"SELECT idTRAMITE, nombre FROM TRAMITE WHERE ASADA_idASADA = '$asada'");

$rows = array();

while($r = mysqli_fetch_assoc($sth)) {
$rows[] = $r;
}
echo json_encode($rows);

mysqli_close ($conn); // Connection Closed.
?>