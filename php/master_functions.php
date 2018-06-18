<?php

include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$action = (string)$_POST['action']; //this is unsecure, its just for the example

if("admins" == $action) {
  $sth = mysqli_query($conn,"SELECT idPERSONA, PERSONA.nombre AS nombre, primerApellido, segundoApellido, USUARIO.nombreUsuario, ASADA.nombre AS asada FROM PERSONA INNER JOIN USUARIO ON USUARIO.PERSONA_cedula = PERSONA.idPersona AND USUARIO.TIPO_USUARIO_idTIPO_USUARIO = 1 INNER JOIN USUARIO_X_ASADA ON USUARIO_X_ASADA.USUARIO_nombreUsuario = USUARIO.nombreUsuario INNER JOIN ASADA ON ASADA.idASADA = USUARIO_X_ASADA.ASADA_idASADA ORDER BY ASADA.nombre");
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
  $asada = $_POST['asada1'];

  $query = mysqli_query($conn,"SELECT idDISTRITO FROM DISTRITO WHERE nombre = '$distrito';");
  $query2 = mysqli_query($conn,"SELECT idASADA FROM ASADA WHERE nombre = '$asada';");


  if($query && $query2){
      $results = mysqli_fetch_array($query);
      $distrito = $results['idDISTRITO'];

      $results = mysqli_fetch_array($query2);
      $asada = $results['idASADA'];

      $sql = "INSERT into PERSONA (nombre, primerApellido, segundoApellido,idPersona, direccion, DISTRITO_idDISTRITO, TIPO_PERSONA_idTIPO_PERSONA) values ('$nombre', '$primerApellido', '$segundoApellido','$cedula', '$direccion', $distrito, 1)";

      $sqlUsuario = "INSERT into USUARIO (nombreUsuario, contrasena, TIPO_USUARIO_idTIPO_USUARIO, PERSONA_cedula) values ('$correo', '$contrasena', 1, '$cedula')";

     $sqlAsada = "INSERT into USUARIO_X_ASADA (USUARIO_nombreUsuario, ASADA_idASADA) values ('$correo', '$asada')";

      if(mysqli_query($conn, $sql) && mysqli_query($conn, $sqlUsuario) && mysqli_query($conn, $sqlAsada)){
           echo "Records inserted successfully.";
           //echo "si";
      }
      else{
           echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
          //echo "no";
       }
  }
  else{
      echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
     //echo "no";
  }
}

if("registrarASADA" == $action) {
  $titulo = $_POST['titulo1'];
  $historia = $_POST['historia1'];
  $mision = $_POST['mision1'];
  $vision = $_POST['vision1'];
  $fotoNoticia = $_POST['fotoNoticia1'];
  $telefono = $_POST['telefono1'];
  $horario = $_POST['horario1'];
  $correo = $_POST['correo1'];
  $facebook = $_POST['facebook1'];
  $distrito = $_POST['distrito1'];
  $cedula = $_POST['cedula1'];
  $direccion = $_POST['direccion1'];
  $fecha = $_POST['fecha1'];

  $asada = $_COOKIE["asada"];

  $urlNoticia = "php/uploads/0_" . str_replace(' ', '', $fotoNoticia);

  // CREAR JUNTA DIRECTIVA
  $query = mysqli_query($conn, "SELECT MAX(idJUNTA_DIRECTIVA) FROM `JUNTA_DIRECTIVA`");

  if($query)
  {
  	$results = mysqli_fetch_array($query);
  	$auto_id = $results['MAX(idJUNTA_DIRECTIVA)'] + 1;

  	if(mysqli_query($conn, "INSERT INTO JUNTA_DIRECTIVA (idJUNTA_DIRECTIVA) values('$auto_id')")){

  		$juntaDirectiva = $auto_id;

  		//BUSCAR DISTRITO

  		$query = mysqli_query($conn, "SELECT idDISTRITO FROM DISTRITO where nombre = '$distrito'");

  		if($query){

  			$results = mysqli_fetch_array($query);
  			$idDistrito = $results['idDISTRITO'];

  			$query_ASADAid = mysqli_query($conn, "SELECT MAX(idASADA) FROM `ASADA`");
  			$results = mysqli_fetch_array($query_ASADAid);
  			$idASADA = $results['MAX(idASADA)'] + 1;

                          $sql = "INSERT INTO `ASADA`(`idASADA`, `nombre`, `cedulaJuridica`, `mision`, `vision`, `historia`, `direccion`, `logo`, `horario`, `fechaFundacion`, `DISTRITO_idDISTRITO`, `JUNTA_DIRECTIVA_idJUNTA_DIRECTIVA`) VALUES ('$idASADA','$titulo','$cedula','$mision','$vision','$historia','$direccion','$urlNoticia','$horario','$fecha','$idDistrito','$juntaDirectiva')";

                          //$sql =  "INSERT INTO ASADA (idASADA, nombre, cedulaJuridica, fechaFundacion, mision, vision, historia, direccion, logo, horario, DISTRITO_idDISTRITO, JUNTA_DIRECTIVA_idJUNTA_DIRECTIVA) VALUES ('$idASADA','$nombre','$cedulaJur','$fecha','$mision','$vision','$historia','$direccion','$logo','$horario', '$idDistrito','$juntaDirectiva')";

  			//echo $nombre.". ".$cedulaJur.". ".$fecha.". ".$mision.". ".$vision.". ".$historia.". ".$direccion.". ".$logo.". ".$horario.". ".$idDistrito.". ".$juntaDirectiva;

  			if(mysqli_query($conn, $sql)){

  				$query_TelefonoId = mysqli_query($conn, "SELECT MAX(idTELEFONO) FROM `TELEFONO`");
                                  $results = mysqli_fetch_array($query_TelefonoId);
  			        $idTelefono = $results['MAX(idTELEFONO)']+1;
                                  $sql = "INSERT INTO TELEFONO(idTELEFONO, telefono) values('$idTelefono','$telefono')";

                                  $query_CorreoId = mysqli_query($conn, "SELECT MAX(idCORREO) FROM `CORREO`");
                                  $results2 = mysqli_fetch_array($query_CorreoId);
  			        $idCorreo = $results2['MAX(idCORREO)']+1;
                                  $sql2 = "INSERT INTO CORREO(idCORREO, correo) values('$idCorreo','$correo')";

  				if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2))
  				{
  					$sql = "INSERT INTO TELEFONO_X_ASADA(idTELEFONO, idASADA) VALUES('$idTelefono', '$idASADA')";
                                          $sql2 = "INSERT INTO CORREO_X_ASADA(idCORREO, idASADA) VALUES('$idCorreo', '$idASADA')";
                                          $sql3 = "INSERT INTO `RED_SOCIAL_X_ASADA`(`RED_SOCIAL_idRED_SOCIAL`, `ASADA_idASADA`, `direccion`) VALUES (0,'$idASADA','$facebook')";

  					if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3)){
  						echo "si";
  					}else{
  						echo "no";
  					}
  				}
  			}
  		}
  	}
  }
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
  $asada = $_POST['asada1'];

  $query = mysqli_query($conn,"SELECT idDISTRITO FROM DISTRITO WHERE nombre = '$distrito';");
  $query2 = mysqli_query($conn,"SELECT idASADA FROM ASADA WHERE nombre = '$asada';");


  if($query && $query2){
      $results = mysqli_fetch_array($query);
      $distrito = $results['idDISTRITO'];

      $results = mysqli_fetch_array($query2);
      $asada = $results['idASADA'];

      $sql = "INSERT into PERSONA (nombre, primerApellido, segundoApellido,idPersona, direccion, DISTRITO_idDISTRITO, TIPO_PERSONA_idTIPO_PERSONA) values ('$nombre', '$primerApellido', '$segundoApellido','$cedula', '$direccion', $distrito, 1)";

      $sqlUsuario = "INSERT into USUARIO (nombreUsuario, contrasena, TIPO_USUARIO_idTIPO_USUARIO, PERSONA_cedula) values ('$correo', '$contrasena', 4, '$cedula')";

     $sqlAsada = "INSERT into USUARIO_X_ASADA (USUARIO_nombreUsuario, ASADA_idASADA) values ('$correo', '$asada')";

      if(mysqli_query($conn, $sql) && mysqli_query($conn, $sqlUsuario) && mysqli_query($conn, $sqlAsada)){
           echo "Records inserted successfully.";
           //echo "si";
      }
      else{
           echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
          //echo "no";
       }
  }
  else{
      echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
     //echo "no";
  }
}

if("resolverTramite" == $action) {
  $estado = $_POST['estado1'];

  $tramite = $_COOKIE["tramite"];

  $sql = "UPDATE FORMULARIO SET ESTADO_SOLICITUD_idESTADO_SOLICITUD='$estado' WHERE idFORMULARIO = '$tramite'";

  if(mysqli_query($conn, $sql)){
      echo "si";
  }
  else{
      echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
  }
}

if("verFontaneros" == $action) {
  $asada = $_COOKIE["asada"];

  $sth = mysqli_query($conn,"SELECT idPERSONA, PERSONA.nombre, primerApellido, segundoApellido, USUARIO.nombreUsuario, ASADA.nombre AS asada FROM PERSONA INNER JOIN USUARIO ON USUARIO.PERSONA_cedula = PERSONA.idPersona AND USUARIO.TIPO_USUARIO_idTIPO_USUARIO = 4 INNER JOIN USUARIO_X_ASADA ON USUARIO_X_ASADA.USUARIO_nombreUsuario = USUARIO.nombreUsuario INNER JOIN ASADA ON ASADA.idASADA = USUARIO_X_ASADA.ASADA_idASADA ORDER BY ASADA.nombre, PERSONA.nombre");
  $rows = array();

  while($r = mysqli_fetch_assoc($sth)) {
    $rows[] = $r;
  }
  echo json_encode($rows);
}

mysqli_close ($conn); // Connection Closed.

?>
