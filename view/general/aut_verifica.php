<?php

$redir = "?pag=general/login";
$con = new mysqli("$host", "$usuario", "$contrasena", "$base");

if ($con->connect_errno)
{
	echo '<script>location.href = "'.$redir.'&error_login=0"</script>';
    echo "Fallo al conectar a MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
    exit();
}

@mysqli_query($con, "SET NAMES 'utf8'");


if (isset($_POST['email']) && isset($_POST['password'])) 
{
    $user = mysqli_real_escape_string($con, $_POST['email']);
    $pass = (mysqli_real_escape_string($con, $_POST['password']));
    
	$consulta_sql = "SELECT * FROM usuario WHERE usuario = '$user' ";
    $consulta = mysqli_query($con, $consulta_sql);
	$usuario_datos = mysqli_fetch_array($consulta);
	
    
    if ($usuario_datos['usuario'] != $user){
		session_destroy();
		echo "<script languaje='JavaScript'>location.href='$redir&error_login=1';</script>";
		exit;
	}
    
    
	if ($usuario_datos['contrasena'] != md5($pass)){
		session_destroy();
		echo "<script languaje='JavaScript'>location.href='$redir&error_login=2';</script>";
		exit;
	}

	if (mysqli_num_rows($consulta) > 0)
    {
				$_SESSION["usuario"] = $usuario_datos['id_usuario'];
                if (isset($_SESSION['usuario'])){
                    $query = "SELECT * FROM `usuario` WHERE `id_usuario` = '".$_SESSION['usuario']."' ";
                    $result = mysqli_query($con,$query);
                    $datos = mysqli_fetch_array($result);
                    $tipo = $datos['tipo_usuario_id'];    
                    $_SESSION["persona"] = $datos['id_persona'];
                    $_SESSION["tipo"] = $datos['tipo_usuario_id'];
                    $_SESSION["asada"] = $datos['id_asada'];
                    
                    $_SESSION["usuario_master"] = $usuario_datos['id_usuario'];
                    
                    if ($tipo == 2 ){
                        echo "<script languaje='JavaScript'>location.href='?pag=administrador/solicitudes';</script>";
                        exit;
                    }
                    if ($tipo == 3 ){
                        echo "<script languaje='JavaScript'>location.href='?pag=master/usuarios&tipo=2';</script>";
                        exit;
                    }
                    if ($tipo == 4 ){
                        echo "<script languaje='JavaScript'>location.href='?pag=fontanero/ordenes&estado=1';</script>";
                        exit;
                    }
                   
                    echo "<script languaje='JavaScript'>location.href='?pag=usuario/noticias';</script>";
                    exit;
                    
                }        
    }
    else
    {
			echo "<script languaje='JavaScript'>location.href='$redir&error_login=5';</script>";
			exit;
    }
}else {
	if (!isset($_SESSION['usuario'])){
		//session_destroy();
		echo "<script languaje='JavaScript'>location.href='$redir&error_login=5';</script>  ";
		exit;
	}
}

echo "<script languaje='JavaScript'>location.href='$redir&error_login=5';</script>";
?>
