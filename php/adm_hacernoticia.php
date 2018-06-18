<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$tituloNoticia = $_POST['titulo1'];
$contenidoNoticia = $_POST['contenido1'];
$fotoNoticia = $_POST['foto1'];
$idASADA = $_POST['asada1'];
$asada = $_COOKIE['asada'];

//$tituloNoticia = "the predatory wasps of the palisades";
//$contenidoNoticia = "are out to get us.";

$query = mysqli_query($conn, "SELECT MAX(idNOTICIA) FROM `NOTICIA`");
//$query = mysqli_query($conn, "call selectMaxNoticia();");
$results = mysqli_fetch_array($query);
$auto_id = $results['MAX(idNOTICIA)'] + 1;
$sql = "INSERT INTO `NOTICIA` (`idNOTICIA`, `titulo`, `contenido`, `ASADA_idASADA`) VALUES ('$auto_id', '$tituloNoticia', '$contenidoNoticia', '$asada')";

$query = mysqli_query($conn, "SELECT MAX(idIMAGEN) FROM `IMAGEN`");
//$query = mysqli_query($conn, "call selectMaxImagen();");
$results = mysqli_fetch_array($query);
$auto_id_img = $results['MAX(idIMAGEN)'] + 1;
$urlNoticia = "php/uploads/0_" . str_replace(' ', '', $fotoNoticia);

$sql_noticia = "INSERT INTO `IMAGEN` (`idIMAGEN`, `imagen`, `NOTICIA_idNOTICIA`) VALUES ('$auto_id_img', '$urlNoticia', '$auto_id')";


if(mysqli_query($conn, $sql)){
    echo "Noticia.";
} 
else{
    echo "NEWS ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

if(mysqli_query($conn, $sql_noticia)){
    echo "Foto.";
} 
else{
    echo "PHOTO ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

echo $auto_id;

mysqli_close ($conn); // Connection Closed.
?>