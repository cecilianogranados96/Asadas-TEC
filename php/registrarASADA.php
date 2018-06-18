<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
						echo "no1";
					}
					
				}else{
					echo "no2";
				}


			}else{
				echo "no3";
			}

		}else{
			echo "no4";
		}

	}else{
		echo "no5";
	}


}else{
	echo "no6";
}
mysqli_close ($conn); // Connection Closed.
?>