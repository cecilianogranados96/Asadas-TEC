<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    /*
    if ($_POST["label"]) {
        $label = $_POST["label"];
    }
    */
    $uploads_dir = 'uploads';

    foreach($_FILES as $file){
        $name = $file['name'];
        $date = date_create();
        $name = str_replace(' ', '', $name);
        $destino =  "uploads/0_".$name;
        if (copy($file['tmp_name'],$destino)) {
            $status = "Archivo subido: ".$name;
            echo("<script>console.log('PHP: ".$status."');</script>");
        } else {
            $status = "Error al subir el archivo";
            echo("<script>console.log('PHP: ".$status."');</script>");
        }
    }
?>