<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$asada = $_COOKIE["asada"];

$sth = mysqli_query($conn,"SELECT idPERSONA, PERSONA.nombre AS nombre, primerApellido, segundoApellido, USUARIO.nombreUsuario, ASADA.nombre AS asada FROM PERSONA INNER JOIN USUARIO ON USUARIO.PERSONA_cedula = PERSONA.idPersona AND USUARIO.TIPO_USUARIO_idTIPO_USUARIO = 1 INNER JOIN USUARIO_X_ASADA ON USUARIO_X_ASADA.USUARIO_nombreUsuario = USUARIO.nombreUsuario INNER JOIN ASADA ON ASADA.idASADA = USUARIO_X_ASADA.ASADA_idASADA ORDER BY ASADA.nombre");
$rows = array();

while($r = mysqli_fetch_assoc($sth)) {
$rows[] = $r;
}
echo json_encode($rows);

mysqli_close ($conn); // Connection Closed.
?>