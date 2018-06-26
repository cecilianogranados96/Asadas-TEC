<?php
session_start();
require_once "fbsdk4-5.1.2/src/Facebook/autoload.php";
require_once "../../../config.php";

$fb = new Facebook\Facebook([
  'app_id' => $app_id,
  'app_secret' => $app_secret,
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken($login_url); 
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
    session_destroy();
  echo "<script languaje='JavaScript'>location.href='../../../index.php?pag=general/login&error_login=0';</script>";
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
    session_destroy();
  echo "<script languaje='JavaScript'>location.href='../../../index.php?pag=general/login&error_login=0';</script>";
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
    echo "<script languaje='JavaScript'>location.href='../../../index.php?pag=general/login&error_login=0';</script>";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
    echo "<script languaje='JavaScript'>location.href='../../../index.php?pag=general/login&error_login=0';</script>";
  }
  exit;
}

$oAuth2Client = $fb->getOAuth2Client();
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
$tokenMetadata->validateAppId($app_id);
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
    exit;
  }
}




$accessToken = (string) $accessToken;

if(isset($accessToken)){
    
    $fb->setDefaultAccessToken($accessToken);
    try {
      $response = $fb->get('/me?locale=en_US&fields=name,email,picture.width(555).height(365),first_name,last_name');
      $userNode = $response->getGraphUser();
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }
    
    


    $query = "SELECT usuario.id_usuario,persona.email FROM `persona`,usuario WHERE usuario.id_persona = persona.id_persona and persona.email = '".$userNode->getEmail()."' limit 1";
    $result = $link->query($query);
    $usuario_datos = $result->fetch_array(MYSQLI_ASSOC);

 
	if ($result->num_rows != 0)
    {
                if ($usuario_datos['email'] != $userNode->getEmail()){
                    session_destroy();
                    echo "<script languaje='JavaScript'>location.href='../../../index.php?pag=general/registro';</script>";
                    exit;
                }
				$_SESSION["usuario"] = $usuario_datos['id_usuario'];
                if (isset($_SESSION['usuario'])){

                    
                    $query = "SELECT * FROM `usuario` WHERE `id_usuario` = '".$_SESSION['usuario']."' ";
                    $result = mysqli_query($link,$query);
                    $datos = mysqli_fetch_array($result);
                    
                    $tipo = $datos['tipo_usuario_id'];   
                    
                    $_SESSION["persona"] = $datos['id_persona'];
                    $_SESSION["tipo"] = $datos['tipo_usuario_id'];
                    $_SESSION["asada"] = $datos['id_asada'];
           
 
                    if ($tipo == 2 ){
                        echo "<script languaje='JavaScript'>location.href='../../../index.php?pag=administrador/solicitudes';</script>";
                        exit;
                    }
                    if ($tipo == 3 ){
                        echo "<script languaje='JavaScript'>location.href='../../../index.php?pag=master/master';</script>";
                        exit;
                    }
                    if ($tipo == 4 ){
                        echo "<script languaje='JavaScript'>location.href='../../../index.php?pag=fontanero/inicio';</script>";
                        exit;
                    }
                    echo "<script languaje='JavaScript'>location.href='../../../index.php?pag=usuario/noticias';</script>";
                    exit;
                }        
    }
    
    

    echo "<script languaje='JavaScript'>location.href='../../../index.php?pag=general/registro&fb=1';</script>";
    
    
    
    
    
}

echo "<script languaje='JavaScript'>location.href='../../../index.php&error_login=5';</script>";


?>