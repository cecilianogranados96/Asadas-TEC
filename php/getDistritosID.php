<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$canton = $_POST["canton1"];
//$canton = "Heredia";

$sth = mysqli_query($conn,"SELECT idDISTRITO, nombre FROM DISTRITO WHERE canton_idcanton = '$canton'");

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