<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$fontanero = $_COOKIE["fontanero"];

$sth = mysqli_query($conn,"SELECT PERSONA.nombre AS nombre, primerApellido, segundoApellido, USUARIO.nombreUsuario AS correo, USUARIO.contrasena AS contrasena, idPERSONA AS cedula, DISTRITO_idDISTRITO AS distrito, CANTON.idCANTON AS canton, PROVINCIA.idPROVINCIA AS provincia, direccion FROM PERSONA INNER JOIN USUARIO ON USUARIO.PERSONA_cedula = '$fontanero' AND USUARIO.PERSONA_cedula = PERSONA.idPersona INNER JOIN DISTRITO ON DISTRITO.idDISTRITO = PERSONA.DISTRITO_idDISTRITO INNER JOIN CANTON ON CANTON.idCANTON = DISTRITO.CANTON_idCANTON INNER JOIN PROVINCIA ON PROVINCIA.idPROVINCIA = CANTON.PROVINCIA_idPROVINCIA");
$rows = array();

while($r = mysqli_fetch_assoc($sth)) {
$rows[] = $r;
}
echo json_encode($rows);

mysqli_close ($conn); // Connection Closed.
?>