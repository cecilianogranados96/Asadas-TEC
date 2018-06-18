<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$delete = $_COOKIE["delete"];
$asada = $_COOKIE["asada"];

$sql = "DELETE FROM IMAGEN WHERE NOTICIA_idNOTICIA = '$delete'";
$sql2 = "DELETE FROM NOTICIA WHERE idNOTICIA = '$delete'";

if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)){
    echo "si";
} 
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}

mysqli_close ($conn); // Connection Closed.
?>