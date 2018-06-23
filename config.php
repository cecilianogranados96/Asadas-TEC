<?php 
//%%%%%%%%%%%%%%% Configuracion de base de datos %%%%%%%%%%%%%%%
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base = "asadas-tec";    

$link = new mysqli("$host", "$usuario", "$contrasena", "$base");

//%%%%%%%%%%%%%%% Configuracion de cantidad de registros por pagina %%%%%%%%%%%%%%%
$TAMANO_PAGINA = 10;

//%%%%%%%%%%%%%%% Configuracion de login de facebook %%%%%%%%%%%%%%%
$login_url = "http://radar.pet/controller/general/fb/callback.php";
$app_id = "155350348609693";
$app_secret = "2f43afdab4caf8b3e151e90e0e150c61";

//%%%%%%%%%%%%%%% Configuracion generales %%%%%%%%%%%%%%%
$redir =  $_SERVER['HTTP_HOST'];
$link->set_charset("utf8");

//%%%%%%%%%%%%%%% Configuracion generales %%%%%%%%%%%%%%%
$key = "radar.pet";
?>