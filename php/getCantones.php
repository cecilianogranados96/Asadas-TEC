<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$provincia = $_POST["provincia1"];
//$provincia = "Heredia";

$query = mysqli_query($conn,"SELECT idPROVINCIA FROM PROVINCIA WHERE nombre = '$provincia';");

if($query){

	$results = mysqli_fetch_array($query);
	$idProvincia = $results['idPROVINCIA'];

	$sth = mysqli_query($conn,"SELECT idCanton, nombre FROM CANTON WHERE PROVINCIA_idPROVINCIA = '$idProvincia'");

	if($sth){
		$rows = array();

		while($r = mysqli_fetch_assoc($sth)) {
			$rows[] = $r;
		}
		echo json_encode($rows);
	}else{
		echo "ERROR1";
	}
		
}else{
	echo "ERROR2";
}


mysqli_close ($conn); // Connection Closed.
?>