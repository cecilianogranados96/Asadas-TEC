<?php
session_start();



if(isset($_SESSION["fb_access_token"])){
require_once "fbsdk4-5.1.2/src/Facebook/autoload.php";
require_once "../../../config.php";


$fb = new Facebook\Facebook([
  'app_id' => $app_id,
  'app_secret' => $app_secret,
  'default_graph_version' => 'v2.2',
  ]);

$accessToken = $_SESSION['fb_access_token'] ;

if(isset($accessToken)){
$fb->setDefaultAccessToken($accessToken);

try {
  $response = $fb->get('/me?locale=en_US&fields=name,email');
  $userNode = $response->getGraphUser();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
    
    
	$consulta_sql = "SELECT * FROM User WHERE email = '".$userNode->getEmail()."' ";
    $consulta = mysqli_query($link, $consulta_sql) or die (mysqli_error($link));
	$usuario_datos = mysqli_fetch_array($consulta) or die (mysqli_error($link));
    print_r($usuario_datos);
    if ($usuario_datos['email'] != $userNode->getEmail()){
		session_destroy();
		echo "<script languaje='JavaScript'>location.href='$redir&error_login=1';</script>";
		exit;
	}
    
    
	if (mysqli_num_rows($consulta) > 0)
    {
				$_SESSION["usuario"] = $usuario_datos['id_person'];
                if (isset($_SESSION['usuario'])){
                    $query = "SELECT User.user_id,User.id_person,Person.person_id,Person.cat_person_id FROM `User`,Person WHERE User.id_person = Person.person_id and User.user_id = '".$_SESSION['usuario']."' ";
                    $result = mysqli_query($link,$query);
                    $datos = mysqli_fetch_array($result);
                    $tipo = $datos['cat_person_id'];    
                    $_SESSION["tipo"] = $datos['cat_person_id'];
                    if ($tipo == 4 ){
                        echo "<script languaje='JavaScript'>location.href='$redir?pag=admin/perfil';</script>";
                        exit;
                    }else {
                        echo "<script languaje='JavaScript'>location.href='$redir?pag=usuarios/perfil';</script>";
                        exit;
                    }
                }        
    }
    else
    {
			echo "<script languaje='JavaScript'>location.href='$redir&error_login=5';</script>";
			exit;
    }
    
	
}

}else{
  echo "<script languaje='JavaScript'>location.href='http://radar.pet/?pag=general/login&error_login=5';</script>";

}

?>
