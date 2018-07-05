<?php 
include 'config.php';



$sth = mysqli_query($link,"SELECT logo FROM `asada`");
$array = array();
while($r = mysqli_fetch_assoc($sth)) {
    if ($r['logo'] != ''){
        $porciones = explode("/", $r['logo']);
        array_push($array,$porciones[2]); 
    }
}

$sth = mysqli_query($link,"SELECT imagen FROM `noticia`");
while($r = mysqli_fetch_assoc($sth)) {
    if ($r['imagen'] != ''){
        $porciones = explode("/", $r['imagen']);
        array_push($array,$porciones[2]); 
    }
}

$sth = mysqli_query($link,"SELECT plantilla FROM `tramite`");
while($r = mysqli_fetch_assoc($sth)) {
    if ($r['plantilla'] != ''){
        $porciones = explode("/", $r['plantilla']);
        array_push($array,$porciones[2]); 
    }
}

$sth = mysqli_query($link,"SELECT respuesta FROM `formulario`");
while($r = mysqli_fetch_assoc($sth)) {
    $array1 = json_decode($r['respuesta'],true);
    foreach($array1 as $valor){
         $porciones = explode("/", $valor);
         if ($porciones[0] == "uploads"){
             array_push($array,$porciones[2]); 
         }
    }
}

function listar_directorios_ruta($ruta,$array){
     if (is_dir($ruta)){
         if ($dh = opendir($ruta)){
             
             if ($ruta != 'uploads/ordenes/'){
                 //echo "$ruta <br>"; 
                 while (($file = readdir($dh)) !== false){
                    if ($file!="." && $file!=".."){
                        //echo "<br />$file"; 
                        if (!in_array($file, $array)) {
                            //echo "NO EXISTE $ruta$file <BR>";
                            unlink($ruta.$file);
                        }
                        listar_directorios_ruta($ruta . $file . DIRECTORY_SEPARATOR,$array);
                    }
                 }
             }
             closedir($dh);
         }
     }
}

listar_directorios_ruta('uploads/',$array);



?>