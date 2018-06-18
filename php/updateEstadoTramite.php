<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$estado = $_POST['estado1'];

$tramite = $_COOKIE["tramite"];

$sql = "UPDATE FORMULARIO SET ESTADO_SOLICITUD_idESTADO_SOLICITUD='$estado' WHERE idFORMULARIO = '$tramite'";

if(mysqli_query($conn, $sql)){
    echo "si";
} 
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

mysqli_close ($conn); // Connection Closed.
?>