<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$noticia = $_COOKIE["noticia"];

//$sth = mysqli_query($conn,"SELECT titulo, contenido, IMAGEN.imagen as imagen FROM NOTICIA INNER JOIN IMAGEN WHERE NOTICIA.idNOTICIA = '$noticia' AND IMAGEN.NOTICIA_idNOTICIA = NOTICIA.idNOTICIA");
$sth = mysqli_query($conn,"call selectNoticia('$noticia')");
$rows = array();

while($r = mysqli_fetch_assoc($sth)) {
    $rows[] = $r;
}
echo json_encode($rows);

mysqli_close ($conn); // Connection Closed.
?>