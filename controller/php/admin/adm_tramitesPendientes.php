<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//$tipo = $_POST['tipo1'];
//$estado = $_POST['estado1'];

$asada = $_COOKIE["asada"];
$tipo = $_COOKIE["tipo"];
$estado = $_COOKIE["estado"];

if($tipo == "a" && $estado == "a"){
    $sth = mysqli_query($conn,"SELECT idFORMULARIO, fecha, TRAMITE.nombre AS nombre, USUARIO.nombreUsuario AS usuario, ESTADO_SOLICITUD.nombre AS estadoSolicitud FROM FORMULARIO INNER JOIN TRAMITE ON TRAMITE.idTRAMITE = FORMULARIO.TRAMITE_idTRAMITE AND TRAMITE.ASADA_idASADA = '$asada' INNER JOIN ESTADO_SOLICITUD ON ESTADO_SOLICITUD.idESTADO_SOLICITUD = FORMULARIO.ESTADO_SOLICITUD_idESTADO_SOLICITUD INNER JOIN USUARIO ON USUARIO.nombreUsuario = FORMULARIO.USUARIO_nombreUsuario INNER JOIN USUARIO_X_ASADA ON USUARIO.nombreUsuario = USUARIO_X_ASADA.USUARIO_nombreUsuario INNER JOIN PERSONA ON PERSONA.idPersona = USUARIO.PERSONA_cedula ORDER BY fecha ASC");
}
else if($tipo != "a" && $estado == "a"){
    $sth = mysqli_query($conn,"SELECT idFORMULARIO, fecha, TRAMITE.nombre AS nombre, USUARIO.nombreUsuario AS usuario, ESTADO_SOLICITUD.nombre AS estadoSolicitud FROM FORMULARIO INNER JOIN TRAMITE ON TRAMITE.idTRAMITE = '$tipo' AND TRAMITE.idTRAMITE = FORMULARIO.TRAMITE_idTRAMITE AND TRAMITE.ASADA_idASADA = '$asada' INNER JOIN ESTADO_SOLICITUD ON ESTADO_SOLICITUD.idESTADO_SOLICITUD = FORMULARIO.ESTADO_SOLICITUD_idESTADO_SOLICITUD INNER JOIN USUARIO ON USUARIO.nombreUsuario = FORMULARIO.USUARIO_nombreUsuario INNER JOIN USUARIO_X_ASADA ON USUARIO.nombreUsuario = USUARIO_X_ASADA.USUARIO_nombreUsuario INNER JOIN PERSONA ON PERSONA.idPersona = USUARIO.PERSONA_cedula ORDER BY fecha ASC");
}
else if($tipo == "a" && $estado != "a"){
    $sth = mysqli_query($conn,"SELECT idFORMULARIO, fecha, TRAMITE.nombre AS nombre, USUARIO.nombreUsuario AS usuario, ESTADO_SOLICITUD.nombre AS estadoSolicitud FROM FORMULARIO INNER JOIN TRAMITE ON FORMULARIO.ESTADO_SOLICITUD_idESTADO_SOLICITUD = '$estado' AND TRAMITE.idTRAMITE = FORMULARIO.TRAMITE_idTRAMITE AND TRAMITE.ASADA_idASADA = '$asada' INNER JOIN ESTADO_SOLICITUD ON ESTADO_SOLICITUD.idESTADO_SOLICITUD = FORMULARIO.ESTADO_SOLICITUD_idESTADO_SOLICITUD INNER JOIN USUARIO ON USUARIO.nombreUsuario = FORMULARIO.USUARIO_nombreUsuario INNER JOIN USUARIO_X_ASADA ON USUARIO.nombreUsuario = USUARIO_X_ASADA.USUARIO_nombreUsuario INNER JOIN PERSONA ON PERSONA.idPersona = USUARIO.PERSONA_cedula ORDER BY fecha ASC");
}
else if($tipo != "a" && $estado != "a"){
    $sth = mysqli_query($conn,"SELECT idFORMULARIO, fecha, TRAMITE.nombre AS nombre, USUARIO.nombreUsuario AS usuario, ESTADO_SOLICITUD.nombre AS estadoSolicitud FROM FORMULARIO INNER JOIN TRAMITE ON TRAMITE.idTRAMITE = '$tipo' AND FORMULARIO.ESTADO_SOLICITUD_idESTADO_SOLICITUD = '$estado' AND TRAMITE.idTRAMITE = FORMULARIO.TRAMITE_idTRAMITE AND TRAMITE.ASADA_idASADA = '$asada' INNER JOIN ESTADO_SOLICITUD ON ESTADO_SOLICITUD.idESTADO_SOLICITUD = FORMULARIO.ESTADO_SOLICITUD_idESTADO_SOLICITUD INNER JOIN USUARIO ON USUARIO.nombreUsuario = FORMULARIO.USUARIO_nombreUsuario INNER JOIN USUARIO_X_ASADA ON USUARIO.nombreUsuario = USUARIO_X_ASADA.USUARIO_nombreUsuario INNER JOIN PERSONA ON PERSONA.idPersona = USUARIO.PERSONA_cedula ORDER BY fecha ASC");
}
$rows = array();

while($r = mysqli_fetch_assoc($sth)) {
$rows[] = $r;
}
echo json_encode($rows);

mysqli_close ($conn); // Connection Closed.
?>