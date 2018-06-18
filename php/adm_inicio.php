<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$asada = $_COOKIE["asada"];
$sth = mysqli_query($conn,"SELECT NOTICIA.titulo AS titulo, IMAGEN.imagen AS imagen FROM NOTICIA INNER JOIN IMAGEN ON NOTICIA.idNOTICIA=IMAGEN.NOTICIA_idNOTICIA AND ASADA_idASADA='$asada' ORDER BY fechaPublicacion DESC LIMIT 3");
$rows = array();

while($r = mysqli_fetch_assoc($sth)) {
$rows[] = $r;
}
echo json_encode($rows);

mysqli_close ($conn); // Connection Closed.
?>