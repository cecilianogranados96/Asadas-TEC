<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "asadas";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (mysqli_connect_errno()) {
	echo "Failed to connect to " . mysqli_connect_error();
        exit();
}
?>