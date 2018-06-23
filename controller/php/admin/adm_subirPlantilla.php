<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$plantilla = $_POST['plantilla1'];

$tramite = $_COOKIE['tramite'];


$urlPlantilla = "php/uploads/0_" . str_replace(' ', '', $plantilla);

$sql = "UPDATE TRAMITE SET plantilla = '$urlPlantilla' WHERE idTRAMITE = '$tramite'";

if(mysqli_query($conn, $sql)){
    echo "Plantilla actualizada exitosamente.";
} 
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

mysqli_close ($conn); // Connection Closed.
?>