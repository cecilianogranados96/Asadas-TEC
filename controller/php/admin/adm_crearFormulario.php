<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$nombre = $_POST['nombre1'];
$descripcion = $_POST['descripcion1'];
$requisitos = $_POST['requisitos1'];
$campos = $_POST['campos1'];

$campos = explode(",",$campos);

$asada = $_COOKIE['asada'];

//$tituloNoticia = "the predatory wasps of the palisades";
//$contenidoNoticia = "are out to get us.";

//$query = mysqli_query($conn, "SELECT MAX(idTRAMITE) FROM `TRAMITE`");
$query = mysqli_query($conn, "call selectMaxTramite;");
$results = mysqli_fetch_array($query);
$auto_id = $results['MAX(idTRAMITE)'] + 1;
//$sql = "INSERT INTO `TRAMITE` (`idTRAMITE`, `nombre`, `descripcion`, `requisitos`, `ASADA_idASADA`) VALUES ('$auto_id', '$nombre', '$descripcion', '$requisitos', '$asada')";
$sql = "call insertTramite ('$auto_id', '$nombre', '$descripcion', '$requisitos', '$asada')";

if(mysqli_query($conn, $sql)){
    echo "Formulario creado.";
    
    foreach ($campos as $value) {
        //$query = mysqli_query($conn, "SELECT MAX(idCAMPO) FROM `CAMPO`");
        $query = mysqli_query($conn, "call selectMaxCampo");
        $results = mysqli_fetch_array($query);
        $auto_id2 = $results['MAX(idCAMPO)'] + 1;
        //$sql2 = "INSERT INTO `CAMPO`(`idCAMPO`, `nombre`, `TIPO_CAMPO_idTIPO_CAMPO`, `TRAMITE_idTRAMITE`) VALUES ('$auto_id2','$value',1,'$auto_id')";
        $sql2 = "insertCampo ('$auto_id2','$value',1,'$auto_id')";
        mysqli_query($conn, $sql2);
    }
} 
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

mysqli_close ($conn); // Connection Closed.
?>