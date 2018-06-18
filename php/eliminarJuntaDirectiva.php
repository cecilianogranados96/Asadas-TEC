<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$delete = $_COOKIE["delete"];
$asada = $_COOKIE["asada"];

$query = mysqli_query($conn,"SELECT JUNTA_DIRECTIVA_idJUNTA_DIRECTIVA AS juntaDirectiva FROM ASADA WHERE idASADA = '$asada'");

if($query){

	$results = mysqli_fetch_array($query);
	$nombreUsuario = $results['juntaDirectiva'];

    $sql = "DELETE FROM PUESTO_X_JUNTA_DIRECTIVA WHERE PUESTO_idPUESTO = '$delete' AND JUNTA_DIRECTIVA_idJUNTA_DIRECTIVA = '$nombreUsuario'";

if(mysqli_query($conn, $sql)){
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