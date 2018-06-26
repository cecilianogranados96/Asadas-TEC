<?php
/**
* Facebook Access
* Author: evilnapsis
**/

session_start();
if(isset($_SESSION["fb_access_token"])){
	session_destroy();
}
header("Location: login.php");

?>