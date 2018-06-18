<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$titulo = $_POST['titulo1'];
$contenido = $_POST['contenido1'];
$fotoNoticia = $_POST['fotoNoticia1'];

$noticia = $_COOKIE["noticia"];

if($fotoNoticia != ""){
   $urlNoticia = "php/uploads/0_" . str_replace(' ', '', $fotoNoticia);

   $sql = "UPDATE NOTICIA SET titulo = '$titulo', contenido = '$contenido' WHERE idNOTICIA = '$noticia'";
   $sql2 = "UPDATE IMAGEN SET imagen = '$urlNoticia' WHERE NOTICIA_idNOTICIA = '$noticia'";
}

else{
   $sql = "UPDATE NOTICIA SET titulo = '$titulo', contenido = '$contenido' WHERE idNOTICIA = '$noticia'";
   $sql2 = "UPDATE NOTICIA SET titulo = '$titulo', contenido = '$contenido' WHERE idNOTICIA = '$noticia'";
}

if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)){
    echo "si";
} 
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

mysqli_close ($conn); // Connection Closed.
?>