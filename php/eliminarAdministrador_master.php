<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$delete = $_COOKIE["delete"];

$query = mysqli_query($conn,"SELECT nombreUsuario FROM USUARIO WHERE PERSONA_cedula = '$delete';");

if($query){

	$results = mysqli_fetch_array($query);
	$nombreUsuario = $results['nombreUsuario'];

    $sql3 = "DELETE FROM USUARIO_X_ASADA WHERE USUARIO_nombreUsuario = '$nombreUsuario'";
    $sql = "DELETE FROM USUARIO WHERE nombreUsuario = '$nombreUsuario'";
    $sql2 = "DELETE FROM PERSONA WHERE idPersona = '$delete'";

if(mysqli_query($conn, $sql3) && mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)){
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