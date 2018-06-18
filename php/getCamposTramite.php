<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$tramite = $_COOKIE["tramite"];

$sth = mysqli_query($conn,"SELECT idCAMPO, valor FROM CAMPO_X_FORMULARIO WHERE idFORMULARIO = '$tramite'");
$rows = array();

while($r = mysqli_fetch_assoc($sth)) {
$rows[] = $r;
}
echo json_encode($rows);

mysqli_close ($conn); // Connection Closed.
?>