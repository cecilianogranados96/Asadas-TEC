<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$canton = $_POST["canton1"];
//$canton = "Heredia";

$query = mysqli_query($conn,"SELECT idCANTON FROM CANTON WHERE nombre = '$canton';");

if($query){

	$results = mysqli_fetch_array($query);
	$idcanton = $results['idCANTON'];

	$sth = mysqli_query($conn,"SELECT idDISTRITO, nombre FROM DISTRITO WHERE canton_idcanton = '$idcanton'");

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