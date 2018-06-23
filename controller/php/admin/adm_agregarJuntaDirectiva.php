<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$nombre = $_POST['nombre1'];
$posicion = $_POST['posicion1'];

$asada = $_COOKIE["asada"];

/*$query = mysqli_query($conn,"SELECT JUNTA_DIRECTIVA_idJUNTA_DIRECTIVA FROM ASADA WHERE idASADA = '$asada';");
$results = mysqli_fetch_array($query);

$juntaDirectiva = $results['JUNTA_DIRECTIVA_idJUNTA_DIRECTIVA'];

$sql = "call insertPuestoxJuntaDirectiva('$posicion','$juntaDirectiva','$nombre');";

if(mysqli_query($conn, $sql)){
    echo "si";
} 
else{
    echo "no";
}*/

$query = mysqli_query($conn,"SELECT idPUESTO FROM PUESTO WHERE nombre = '$posicion';");

if($query){
    $results = mysqli_fetch_array($query);
    $puesto = $results['idPUESTO'];
    
    $query = mysqli_query($conn,"SELECT JUNTA_DIRECTIVA_idJUNTA_DIRECTIVA FROM ASADA WHERE idASADA = '$asada';");
    //$query = mysqli_query($conn,"call selectIdJuntaDirectiva('$asada');");
    
    if($query){
        $results = mysqli_fetch_array($query);
        $juntaDirectiva = $results['JUNTA_DIRECTIVA_idJUNTA_DIRECTIVA'];
        
        $sql = "INSERT INTO `PUESTO_X_JUNTA_DIRECTIVA`(`PUESTO_idPUESTO`, `JUNTA_DIRECTIVA_idJUNTA_DIRECTIVA`, `nombre`) VALUES ('$puesto','$juntaDirectiva','$nombre')";
        //$sql = "call insertPuestoxJuntaDirectiva('$puesto','$juntaDirectiva','$nombre');";
        
        //$sql2 = "DELETE FROM `PUESTO_X_JUNTA_DIRECTIVA` WHERE `PUESTO_idPUESTO` = '$puesto' AND `JUNTA_DIRECTIVA_idJUNTA_DIRECTIVA` = '$juntaDirectiva'";
        //$sql2 = "CALL deletePuestoXJuntaDirectiva('$puesto','$juntaDirectiva');";
        
        //if(mysqli_query($conn, $sql2) && mysqli_query($conn, $sql)){
        if(mysqli_query($conn, $sql)){
            $value =  array('msg' => 'true' );
            echo json_encode($value);
        }
        else{
            $value =  array('msg' => 'false' );
            echo json_encode($value);
        }
    }
    else{
        $value =  array('msg' => 'false' );
        echo json_encode($value);
    }
}
else{
   $value =  array('msg' => 'false' );
    echo json_encode($value);
}

mysqli_close ($conn); // Connection Closed.
?>