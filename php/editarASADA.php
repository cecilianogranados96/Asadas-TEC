<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$titulo = $_POST['titulo1'];
$historia = $_POST['historia1'];
$mision = $_POST['mision1'];
$vision = $_POST['vision1'];
$fotoNoticia = $_POST['fotoNoticia1'];
$telefono = $_POST['telefono1'];
$horario = $_POST['horario1'];
$correo = $_POST['correo1'];
$facebook = $_POST['facebook1'];

$asada = $_COOKIE["asada"];

if($fotoNoticia != ""){
   $urlNoticia = "php/uploads/0_" . str_replace(' ', '', $fotoNoticia);

   $sql = "UPDATE ASADA SET nombre = '$titulo', historia = '$historia', mision = '$mision', vision = '$vision', horario = '$horario', logo = '$urlNoticia' WHERE idASADA = '$asada'";
}

else{
   $sql = "UPDATE ASADA SET nombre = '$titulo', historia = '$historia', mision = '$mision', vision = '$vision', horario = '$horario' WHERE idASADA = '$asada'";
}

$sql2 = "UPDATE TELEFONO SET telefono = '$telefono' WHERE idTELEFONO = (SELECT idTELEFONO FROM TELEFONO_X_ASADA WHERE idASADA = '$asada')";

$sql3 = "UPDATE CORREO SET correo = '$correo' WHERE idCORREO = (SELECT idCORREO FROM CORREO_X_ASADA WHERE idASADA = '$asada')";

$sql4 = "UPDATE RED_SOCIAL_X_ASADA SET direccion = '$facebook' WHERE ASADA_idASADA = '$asada'";

if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3) && mysqli_query($conn, $sql4)){
    echo "La ASADA ha sido editada exitosamente. ";
} 
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

mysqli_close ($conn); // Connection Closed.
?>