<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$usuario = $_COOKIE["usuario"];

$sth = mysqli_query($conn,"SELECT nombre, primerApellido, segundoApellido FROM PERSONA INNER JOIN USUARIO ON USUARIO.nombreUsuario = '$usuario' AND USUARIO.PERSONA_cedula = PERSONA.idPERSONA");
$rows = array();

while($r = mysqli_fetch_assoc($sth)) {
	$rows[] = $r;
}
echo json_encode($rows);

mysqli_close ($conn); // Connection Closed.
?>