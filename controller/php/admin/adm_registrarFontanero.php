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
$cedula = $_POST['cedula1'];
$telefono = $_POST['telefono1'];
$direccion =  $_POST['direccionExacta1'];
$distrito = $_POST['distrito1'];

$asada = $_COOKIE["asada"];

/*
$nombre = "Fontanera";
$primerApellido = "Nueva";
$segundoApellido = "Y asi";
$correo = "fontanera@fontanera.com";
$cedula = 190290192;
$telefono = 891289189;
$distrito = "Sabanilla";
$direccion =  "direccion";

*/

$query = mysqli_query($conn,"SELECT idDISTRITO FROM DISTRITO WHERE nombre = '$distrito';");


if($query){
    $results = mysqli_fetch_array($query);
    $distrito = $results['idDISTRITO'];

    $sql = "INSERT into PERSONA (nombre, primerApellido, segundoApellido,idPersona, direccion, DISTRITO_idDISTRITO, TIPO_PERSONA_idTIPO_PERSONA) values ('$nombre', '$primerApellido', '$segundoApellido','$cedula', '$direccion', $distrito, 1)";

    $sqlUsuario = "INSERT into USUARIO (nombreUsuario, contrasena, TIPO_USUARIO_idTIPO_USUARIO, PERSONA_cedula) values ('$correo', '$contrasena', 4, '$cedula')";

   $sqlAsada = "INSERT into USUARIO_X_ASADA (USUARIO_nombreUsuario, ASADA_idASADA) values ('$correo', '$asada')";

    if(mysqli_query($conn, $sql) && mysqli_query($conn, $sqlUsuario) && mysqli_query($conn, $sqlAsada)){
         echo "Records inserted successfully.";
         //echo "si";
    } 
    else{
         echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        //echo "no";
     }
} 
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
   //echo "no";
}




mysqli_close ($conn); // Connection Closed.
?>