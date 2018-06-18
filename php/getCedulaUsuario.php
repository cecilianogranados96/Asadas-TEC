<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$usuario = $_COOKIE["usuario"];

$sth = mysqli_query($conn,"SELECT idPERSONA AS cedula, PROVINCIA.nombre AS provincia, CANTON.nombre AS canton, DISTRITO.nombre AS distrito, direccion FROM PERSONA INNER JOIN USUARIO ON USUARIO.nombreUsuario = '$usuario' AND USUARIO.PERSONA_cedula = PERSONA.idPERSONA INNER JOIN DISTRITO ON PERSONA.DISTRITO_idDISTRITO = DISTRITO.idDISTRITO INNER JOIN CANTON ON DISTRITO.CANTON_idCANTON = CANTON.idCANTON INNER JOIN PROVINCIA ON CANTON.PROVINCIA_idPROVINCIA = PROVINCIA.idPROVINCIA");
$rows = array();

while($r = mysqli_fetch_assoc($sth)) {
	$rows[] = $r;
}
echo json_encode($rows);

mysqli_close ($conn); // Connection Closed.
?>