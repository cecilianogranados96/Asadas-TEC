<?php

include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$action = (string)$_POST['action']; //this is unsecure, its just for the example

if("agregarJuntaDirectiva" == $action) {

    $nombre = $_POST['nombre1'];
    $posicion = $_POST['posicion1'];

    $asada = $_COOKIE["asada"];

    $query = mysqli_query($conn,"SELECT idPUESTO FROM PUESTO WHERE nombre = '$posicion';");

    if($query){
        $results = mysqli_fetch_array($query);
        $puesto = $results['idPUESTO'];

        $query = mysqli_query($conn,"SELECT JUNTA_DIRECTIVA_idJUNTA_DIRECTIVA FROM ASADA WHERE idASADA = '$asada';");

        if($query){
            $results = mysqli_fetch_array($query);
            $juntaDirectiva = $results['JUNTA_DIRECTIVA_idJUNTA_DIRECTIVA'];

            $sql = "INSERT INTO `PUESTO_X_JUNTA_DIRECTIVA`(`PUESTO_idPUESTO`, `JUNTA_DIRECTIVA_idJUNTA_DIRECTIVA`, `nombre`) VALUES ('$puesto','$juntaDirectiva','$nombre')";

            if(mysqli_query($conn, $sql)){
                $result = array("status" => "0", "responseText" => "Success");
                echo json_encode($result);
            }
            else{
                $error = $mysqli->error;
                $result = array("status" => "0", "responseText" => $error);
                echo json_encode($result);
            }
        }
        else{
            $error = $mysqli->error;
            $result = array("status" => "0", "responseText" => $error);
            echo json_encode($result);
        }
    }
    else{
        $error = $mysqli->error;
        $result = array("status" => "0", "responseText" => $error);
        echo json_encode($result);
    }
}

if("admins" == $action) {
    $asada = $_COOKIE["asada"];

    $sth = mysqli_query($conn, "CALL selectAdmins('$asada')");
    $rows = array();

    while($r = mysqli_fetch_assoc($sth)) {
        $rows[] = $r;
    }
    echo json_encode($rows);

}

if("crearAdministrador" == $action) {

    $nombre = $_POST['nombre1'];
    $primerApellido = $_POST['primerApellido1'];
    $segundoApellido = $_POST['segundoApellido1'];
    $correo = $_POST['correo1'];
    $contrasena = $_POST['contrasena1'];
    $cedula = $_POST['cedula1'];
    $telefono = $_POST['telefono1'];
    $direccion =  $_POST['direccionExacta1'];
    $distrito = $_POST['distrito1'];

    $asada = $_COOKIE["asada"];

    $query = mysqli_query($conn,"SELECT idDISTRITO FROM DISTRITO WHERE nombre = '$distrito';");


    if($query){
        $results = mysqli_fetch_array($query);
        $distrito = $results['idDISTRITO'];

        $sql = "call insertPersona('$nombre', '$primerApellido', '$segundoApellido','$cedula', '$direccion', $distrito, 1)";

        $sqlUsuario = "call insertUsuario ('$correo', '$contrasena', '$cedula', 1)";

        $sqlAsada = "call insertUsuarioXAsada ('$correo', '$asada')";

        if(mysqli_query($conn, $sql) && mysqli_query($conn, $sqlUsuario) && mysqli_query($conn, $sqlAsada)){
             echo "Administrador agregado exitosamente.";
        }
        else{
             echo "ERROR: $sql. " . mysqli_error($conn);
         }
    }
    else{
        echo "ERROR: $sql. " . mysqli_error($conn);
    }
}

if("getEditarNoticia" == $action) {
    $noticia = $_COOKIE["noticia"];
    $sth = mysqli_query($conn,"call selectNoticia('$noticia')");
    $rows = array();

    while($r = mysqli_fetch_assoc($sth)) {
        $rows[] = $r;
    }

    echo json_encode($rows);
}

if("editarNoticia" == $action) {
    $titulo = $_POST['titulo1'];
    $contenido = $_POST['contenido1'];
    $fotoNoticia = $_POST['fotoNoticia1'];

    $noticia = $_COOKIE["noticia"];

    if($fotoNoticia != ""){
       $urlNoticia = "php/uploads/0_" . str_replace(' ', '', $fotoNoticia);

       $sql = "UPDATE NOTICIA SET titulo = '$titulo', contenido = '$contenido' WHERE idNOTICIA = '$noticia'";
       $sql2 = "UPDATE IMAGEN SET imagen = '$urlNoticia' WHERE NOTICIA_idNOTICIA = '$noticia'";
    }

    else{
       $sql = "UPDATE NOTICIA SET titulo = '$titulo', contenido = '$contenido' WHERE idNOTICIA = '$noticia'";
       $sql2 = "UPDATE NOTICIA SET titulo = '$titulo', contenido = '$contenido' WHERE idNOTICIA = '$noticia'";
    }

    if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)){
        echo "si";
    }
    else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
}

if("getEstaAsociacion" == $action) {
    $asada = $_COOKIE["asada"];
    $sth = mysqli_query($conn,"call selectAsada('$asada')");
    $rows = array();
    while($r = mysqli_fetch_assoc($sth)) {
        $rows[] = $r;
    }
    echo json_encode($rows);
}

if("estaAsociacion" == $action) {
    $titulo = $_POST['titulo1'];
    $historia = $_POST['historia1'];
    $mision = $_POST['mision1'];
    $vision = $_POST['vision1'];
    $fotoNoticia = $_POST['fotoNoticia1'];
    $telefono = $_POST['telefono1'];
    $horario = $_POST['horario1'];
    $correo = $_POST['correo1'];
    $facebook = $_POST['facebook1'];

    $asada = $_COOKIE["asada"];

    if($fotoNoticia != ""){
       $urlNoticia = "php/uploads/0_" . str_replace(' ', '', $fotoNoticia);

       $sql = "UPDATE ASADA SET nombre = '$titulo', historia = '$historia', mision = '$mision', vision = '$vision', horario = '$horario', logo = '$urlNoticia' WHERE idASADA = '$asada'";
    }

    else{
       $sql = "UPDATE ASADA SET nombre = '$titulo', historia = '$historia', mision = '$mision', vision = '$vision', horario = '$horario' WHERE idASADA = '$asada'";
    }

    $sql2 = "UPDATE TELEFONO SET telefono = '$telefono' WHERE idTELEFONO = (SELECT idTELEFONO FROM TELEFONO_X_ASADA WHERE idASADA = '$asada')";

    $sql3 = "UPDATE CORREO SET correo = '$correo' WHERE idCORREO = (SELECT idCORREO FROM CORREO_X_ASADA WHERE idASADA = '$asada')";

    $sql4 = "UPDATE RED_SOCIAL_X_ASADA SET direccion = '$facebook' WHERE ASADA_idASADA = '$asada'";

    if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3) && mysqli_query($conn, $sql4)){
        echo "La ASADA ha sido editada exitosamente. ";
    }
    else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
}

if("fontaneros" == $action) {
    $asada = $_COOKIE["asada"];
    $sth = mysqli_query($conn,"call selectFontanero('$asada')");
    $rows = array();
    while($r = mysqli_fetch_assoc($sth)) {
        $rows[] = $r;
    }
    echo json_encode($rows);
}

if("hacerNoticia" == $action) {
    $tituloNoticia = $_POST['titulo1'];
    $contenidoNoticia = $_POST['contenido1'];
    $fotoNoticia = $_POST['foto1'];
    $idASADA = $_POST['asada1'];
    $asada = $_COOKIE['asada'];

    $query = mysqli_query($conn, "SELECT MAX(idNOTICIA) FROM `NOTICIA`");
    $results = mysqli_fetch_array($query);
    $auto_id = $results['MAX(idNOTICIA)'] + 1;
    $sql = "INSERT INTO `NOTICIA` (`idNOTICIA`, `titulo`, `contenido`, `ASADA_idASADA`) VALUES ('$auto_id', '$tituloNoticia', '$contenidoNoticia', '$asada')";

    $query = mysqli_query($conn, "SELECT MAX(idIMAGEN) FROM `IMAGEN`");
    $results = mysqli_fetch_array($query);
    $auto_id_img = $results['MAX(idIMAGEN)'] + 1;
    $urlNoticia = "php/uploads/0_" . str_replace(' ', '', $fotoNoticia);

    $sql_noticia = "INSERT INTO `IMAGEN` (`idIMAGEN`, `imagen`, `NOTICIA_idNOTICIA`) VALUES ('$auto_id_img', '$urlNoticia', '$auto_id')";


    if(mysqli_query($conn, $sql)){
        echo "Noticia.";
    }
    else{
        echo "NEWS ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }

    if(mysqli_query($conn, $sql_noticia)){
        echo "Foto.";
    }
    else{
        echo "PHOTO ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }

    echo $auto_id;
}

if("inicio" == $action) {
    $asada = $_COOKIE["asada"];
    $sth = mysqli_query($conn,"SELECT NOTICIA.titulo AS titulo, IMAGEN.imagen AS imagen FROM NOTICIA INNER JOIN IMAGEN ON NOTICIA.idNOTICIA=IMAGEN.NOTICIA_idNOTICIA AND ASADA_idASADA='$asada' ORDER BY fechaPublicacion DESC LIMIT 3");
    $rows = array();

    while($r = mysqli_fetch_assoc($sth)) {
        $rows[] = $r;
    }
    echo json_encode($rows);
}

if("juntaDirectiva" == $action) {
    $asada = $_COOKIE["asada"];
    $sth = mysqli_query($conn,"SELECT PUESTO_idPUESTO, PUESTO_X_JUNTA_DIRECTIVA.nombre AS nombre, PUESTO.nombre AS puesto FROM PUESTO_X_JUNTA_DIRECTIVA INNER JOIN PUESTO ON PUESTO.idPUESTO = PUESTO_X_JUNTA_DIRECTIVA.PUESTO_idPUESTO INNER JOIN JUNTA_DIRECTIVA ON JUNTA_DIRECTIVA.idJUNTA_DIRECTIVA = PUESTO_X_JUNTA_DIRECTIVA.JUNTA_DIRECTIVA_idJUNTA_DIRECTIVA INNER JOIN ASADA ON ASADA.idASADA = '$asada' AND ASADA.JUNTA_DIRECTIVA_idJUNTA_DIRECTIVA = JUNTA_DIRECTIVA.idJUNTA_DIRECTIVA ORDER BY PUESTO_idPUESTO DESC");
    $rows = array();

    while($r = mysqli_fetch_assoc($sth)) {
        $rows[] = $r;
    }
    echo json_encode($rows);
}

if("getModificarFontanero" == $action) {
    $fontanero = $_COOKIE["fontanero"];

    $sth = mysqli_query($conn,"SELECT PERSONA.nombre AS nombre, primerApellido, segundoApellido, USUARIO.nombreUsuario AS correo, USUARIO.contrasena AS contrasena, idPERSONA AS cedula, DISTRITO_idDISTRITO AS distrito, CANTON.idCANTON AS canton, PROVINCIA.idPROVINCIA AS provincia, direccion FROM PERSONA INNER JOIN USUARIO ON USUARIO.PERSONA_cedula = '$fontanero' AND USUARIO.PERSONA_cedula = PERSONA.idPersona INNER JOIN DISTRITO ON DISTRITO.idDISTRITO = PERSONA.DISTRITO_idDISTRITO INNER JOIN CANTON ON CANTON.idCANTON = DISTRITO.CANTON_idCANTON INNER JOIN PROVINCIA ON PROVINCIA.idPROVINCIA = CANTON.PROVINCIA_idPROVINCIA");
    $rows = array();

    while($r = mysqli_fetch_assoc($sth)) {
        $rows[] = $r;
    }
    echo json_encode($rows);

}

if("modificarFontanero" == $action) {
    $nombre = $_POST['nombre1'];
    $primerApellido = $_POST['primerApellido1'];
    $segundoApellido = $_POST['segundoApellido1'];
    $correo = $_POST['correo1'];
    $contrasena = $_POST['contrasena1'];
    $telefono = $_POST['telefono1'];

    $fontanero = $_COOKIE["fontanero"];

    $sql = "UPDATE PERSONA SET nombre = '$nombre', primerApellido = '$primerApellido', segundoApellido = '$segundoApellido' WHERE idPersona = '$fontanero'";
    $sql2 = "UPDATE USUARIO SET nombreUsuario = '$correo', contrasena = '$contrasena' WHERE PERSONA_cedula = '$fontanero'";

    if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)){
        echo "si";
    }
    else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
}

if("noticias" == $action) {
    $asada = $_COOKIE["asada"];
    $sth = mysqli_query($conn,"SELECT idNOTICIA, titulo, fechaPublicacion FROM NOTICIA WHERE ASADA_idASADA='$asada'");
    $rows = array();

    while($r = mysqli_fetch_assoc($sth)) {
        $rows[] = $r;
    }
    echo json_encode($rows);
}

if("plantillas" == $action) {
    $asada = $_COOKIE["asada"];
    $sth = mysqli_query($conn,"SELECT idTRAMITE, nombre, plantilla FROM TRAMITE WHERE ASADA_idASADA = '$asada' ORDER BY idTRAMITE DESC");
    $rows = array();
    while($r = mysqli_fetch_assoc($sth)) {
        $rows[] = $r;
    }
    echo json_encode($rows);
}

if("registrarFontanero" == $action) {
    $nombre = $_POST['nombre1'];
    $primerApellido = $_POST['primerApellido1'];
    $segundoApellido = $_POST['segundoApellido1'];
    $correo = $_POST['correo1'];
    $contrasena = $_POST['contrasena1'];
    $cedula = $_POST['cedula1'];
    $telefono = $_POST['telefono1'];
    $direccion =  $_POST['direccionExacta1'];
    $distrito = $_POST['distrito1'];

    $asada = $_COOKIE["asada"];

    $query = mysqli_query($conn,"SELECT idDISTRITO FROM DISTRITO WHERE nombre = '$distrito';");

    if($query){
        $results = mysqli_fetch_array($query);
        $distrito = $results['idDISTRITO'];

        $sql = "INSERT into PERSONA (nombre, primerApellido, segundoApellido,idPersona, direccion, DISTRITO_idDISTRITO, TIPO_PERSONA_idTIPO_PERSONA) values ('$nombre', '$primerApellido', '$segundoApellido','$cedula', '$direccion', $distrito, 1)";

        $sqlUsuario = "INSERT into USUARIO (nombreUsuario, contrasena, TIPO_USUARIO_idTIPO_USUARIO, PERSONA_cedula) values ('$correo', '$contrasena', 4, '$cedula')";

       $sqlAsada = "INSERT into USUARIO_X_ASADA (USUARIO_nombreUsuario, ASADA_idASADA) values ('$correo', '$asada')";

        if(mysqli_query($conn, $sql) && mysqli_query($conn, $sqlUsuario) && mysqli_query($conn, $sqlAsada)){
             echo "Records inserted successfully.";
        }
        else{
             echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
         }
    }
    else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
}

if("resolverTramite" == $action) {
    $tramite = $_COOKIE["tramite"];

    $query = mysqli_query($conn, "SELECT TRAMITE_idTRAMITE AS idTRAMITE FROM FORMULARIO WHERE idFORMULARIO = '$tramite'");
    $results = mysqli_fetch_array($query);
    $formulario = $results['idTRAMITE'];

    $sth = mysqli_query($conn,"SELECT idCAMPO, nombre, TIPO_CAMPO_idTIPO_CAMPO AS tipoCampo FROM CAMPO WHERE TRAMITE_idTRAMITE = '$formulario'");
    $rows = array();

    while($r = mysqli_fetch_assoc($sth)) {
        $rows[] = $r;
    }
    echo json_encode($rows);
}

if("subirPlantilla" == $action) {
    $plantilla = $_POST['plantilla1'];
    $tramite = $_COOKIE['tramite'];

    $urlPlantilla = "php/uploads/0_" . str_replace(' ', '', $plantilla);

    $sql = "UPDATE TRAMITE SET plantilla = '$urlPlantilla' WHERE idTRAMITE = '$tramite'";

    if(mysqli_query($conn, $sql)){
        echo "Plantilla actualizada exitosamente.";
    }
    else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
}

if("contacto" == $action) {
    $asada = $_COOKIE["asada"];

    $sth = mysqli_query($conn,"SELECT telefono, horario, RED_SOCIAL_X_ASADA.direccion AS link, CORREO.correo AS correo FROM ASADA INNER JOIN TELEFONO_X_ASADA ON ASADA.idASADA = '$asada' AND ASADA.idASADA = TELEFONO_X_ASADA.idASADA INNER JOIN TELEFONO ON TELEFONO.idTELEFONO = TELEFONO_X_ASADA.idTELEFONO INNER JOIN RED_SOCIAL_X_ASADA ON RED_SOCIAL_X_ASADA.RED_SOCIAL_idRED_SOCIAL = 0 AND RED_SOCIAL_X_ASADA.ASADA_idASADA = ASADA.idASADA INNER JOIN CORREO_X_ASADA ON CORREO_X_ASADA.idASADA = ASADA.idASADA INNER JOIN CORREO ON CORREO.idCORREO = CORREO_X_ASADA.idCORREO");
    $rows = array();

    while($r = mysqli_fetch_assoc($sth)) {
        $rows[] = $r;
    }
    echo json_encode($rows);
}

mysqli_close ($conn); // Connection Closed.

?>
