<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$usuario = $_COOKIE["usuario"];
$tramite = $_COOKIE["tramite"];
$valores = $_POST['valores1'];
$ids = $_POST['ids1'];

$query = mysqli_query($conn, "SELECT MAX(idFORMULARIO) FROM `FORMULARIO`");
$results = mysqli_fetch_array($query);
$auto_id = $results['MAX(idFORMULARIO)'] + 1;
$sql = "INSERT INTO `FORMULARIO` (`idFORMULARIO`, `TRAMITE_idTRAMITE`, `USUARIO_nombreUsuario`, `ESTADO_SOLICITUD_idESTADO_SOLICITUD`) VALUES ('$auto_id', '$tramite', '$usuario', 0)";

if(!mysqli_query($conn, $sql)){
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);

} 


$valores = explode(',', $valores);
$ids = explode(',', $ids);

//$valores = array(7,6,5);
//$ids = array(1,1,1);

$cantInserciones = count($valores) - 1;

while($cantInserciones >= 0){
     $sql = "INSERT INTO `CAMPO_X_FORMULARIO` (`idCAMPO`, `idFORMULARIO`, `valor`) VALUES ('$ids[$cantInserciones]', '$auto_id', '$valores[$cantInserciones]')";
     
    if(!mysqli_query($conn, $sql)){
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
    
    $cantInserciones--;
}


mysqli_close ($conn); // Connection Closed.
?>