<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$nombre = $_POST['nombre1'];
$primerApellido = $_POST['primerApellido1'];
$segundoApellido = $_POST['segundoApellido1'];
$correo = $_POST['correo1'];
$contrasena = $_POST['contrasena1'];
$telefono = $_POST['telefono1'];

$fontanero = $_COOKIE["fontanero"];

$sql = "UPDATE PERSONA SET nombre = '$nombre', primerApellido = '$primerApellido', segundoApellido = '$segundoApellido' WHERE idPersona = '$fontanero'";
$sql2 = "UPDATE USUARIO SET nombreUsuario = '$correo', contrasena = '$contrasena' WHERE PERSONA_cedula = '$fontanero'";

if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)){
    echo "si";
} 
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

mysqli_close ($conn); // Connection Closed.
?>