<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$nombre = $_POST['nombre1'];
$primerApellido = $_POST['primerApellido1'];
$segundoApellido = $_POST['segundoApellido1'];
$password = $_POST['password1'];
$correo = $_POST['email1'];
$cedula = $_POST['cedula1'];
$telefono = $_POST['telefono1'];
$distrito = $_POST['distrito1'];
$direccion =  $_POST['direccionExacta1'];

$query = mysqli_query($conn,"SELECT idDISTRITO FROM DISTRITO WHERE nombre = '$distrito';");
$results = mysqli_fetch_array($query);
$distrito = $results['idDISTRITO'];

$sql = "INSERT into PERSONA (nombre, primerApellido, segundoApellido,idPersona, direccion, DISTRITO_idDISTRITO) values ('$nombre', '$primerApellido', '$segundoApellido','$cedula', '$direccion', $distrito )";

if(mysqli_query($conn, $sql)){

    $sql = "INSERT into USUARIO (nombreUsuario, contrasena, TIPO_USUARIO_IDTIPO_USUARIO,PERSONA_cedula) values ('$correo', '$password',0,'$cedula')";
    
    $query_TelefonoId = mysqli_query($conn, "SELECT MAX(idTELEFONO) FROM `TELEFONO`");
    $results = mysqli_fetch_array($query_TelefonoId);
	$idTelefono = $results['MAX(idTELEFONO)']+1;
    $sql2 = "INSERT INTO TELEFONO(idTELEFONO, telefono) values('$idTelefono','$telefono')";
    $sql3 = "INSERT INTO TELEFONO_X_USUARIO(idTELEFONO, nombreUsuario) values('$idTelefono','$correo')";

    if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3)){

    	$sqlUXA = "INSERT into USUARIO_X_ASADA (USUARIO_nombreUsuario, ASADA_idASADA) values ('$correo', 0)";

    	if(mysqli_query($conn, $sqlUXA)){
       		echo "si";
       	}
       	else{
       		echo "no";
       	}
    }
    else{
       echo "no";
   }
} 
else{
    //echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
   echo "no";
}



mysqli_close ($conn); // Connection Closed.
?>