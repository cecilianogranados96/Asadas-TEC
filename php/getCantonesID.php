<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$provincia = $_POST["provincia1"];
//$provincia = "Heredia";

$sth = mysqli_query($conn,"SELECT idCanton, nombre FROM CANTON WHERE PROVINCIA_idPROVINCIA = '$provincia'");

if($sth){
	$rows = array();

	while($r = mysqli_fetch_assoc($sth)) {
		$rows[] = $r;
	}
	echo json_encode($rows);
}else{
	echo "ERROR1";
}


mysqli_close ($conn); // Connection Closed.
?>