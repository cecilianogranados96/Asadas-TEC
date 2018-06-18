<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$usuario = $_COOKIE["usuario"];

$sth = mysqli_query($conn,"SELECT telefono FROM TELEFONO INNER JOIN TELEFONO_X_USUARIO ON TELEFONO_X_USUARIO.nombreUsuario = '$usuario' AND TELEFONO_X_USUARIO.idTELEFONO = TELEFONO.idTELEFONO");
$rows = array();

while($r = mysqli_fetch_assoc($sth)) {
	$rows[] = $r;
}
echo json_encode($rows);

mysqli_close ($conn); // Connection Closed.
?>