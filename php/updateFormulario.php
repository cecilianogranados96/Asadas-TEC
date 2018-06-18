<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$usuario = $_COOKIE["usuario"];
$tramite = $_COOKIE["tramite"];
$valores = $_POST['valores1'];
$ids = $_POST['ids1'];

$valores = explode(',', $valores);
$ids = explode(',', $ids);

$cantInserciones = count($valores) - 1;

while($cantInserciones >= 0){
     $sql = "INSERT INTO `CAMPO_X_FORMULARIO` (`idCAMPO`, `idFORMULARIO`, `valor`) VALUES ('$ids[$cantInserciones]', '$tramite', '$valores[$cantInserciones]')";
     
    if(!mysqli_query($conn, $sql)){
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
    
    $cantInserciones--;
}


mysqli_close ($conn); // Connection Closed.
?>