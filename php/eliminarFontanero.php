<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$fontanero = $_COOKIE["fontanero"];
$asada = $_COOKIE["asada"];

$query = mysqli_query($conn,"SELECT nombreUsuario FROM USUARIO WHERE PERSONA_cedula = '$fontanero';");

if($query){

	$results = mysqli_fetch_array($query);
	$nombreUsuario = $results['nombreUsuario'];

    $sql = "DELETE FROM USUARIO_X_ASADA WHERE USUARIO_nombreUsuario = '$nombreUsuario' AND ASADA_idASADA = '$asada'";
    $sql2 = "DELETE FROM USUARIO WHERE nombreUsuario = '$nombreUsuario'";
    $sql3 = "DELETE FROM PERSONA WHERE idPersona = '$fontanero'";

if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3)){
    echo "si";
} 
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
}
else{
    echo "no";
}

mysqli_close ($conn); // Connection Closed.
?>