<?php 
//%%%%%%%%%%%%%%% Configuracion de base de datos %%%%%%%%%%%%%%%
$host = "asadastec.tk";
$usuario = "admin_asadas";
$contrasena = "asadas123*";
$base = "admin_asadas";
$link = new mysqli("$host", "$usuario", "$contrasena", "$base");
//%%%%%%%%%%%%%%% Configuracion de cantidad de registros por pagina %%%%%%%%%%%%%%%
$TAMANO_PAGINA = 10;
//%%%%%%%%%%%%%%% Configuracion de login de facebook %%%%%%%%%%%%%%%
$login_url = "https://asadastec.tk/controller/general/fb/callback.php";
$app_id = "480677335695670";
$app_secret = "70ab41c4deeec1a65644119b3c2c071f";
//%%%%%%%%%%%%%%% Configuracion generales %%%%%%%%%%%%%%%
$redir =  $_SERVER['HTTP_HOST'];
$link->set_charset("utf8");

date_default_timezone_set('America/Costa_Rica');

setlocale(LC_ALL,"es_ES");
?>