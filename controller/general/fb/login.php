<?php
/**
* Facebook Access
* Author: evilnapsis
**/

session_start();
require_once "fbsdk4-5.1.2/src/Facebook/autoload.php";
require_once "credentials.php";

$fb = new Facebook\Facebook([
  'app_id' => $app_id, // Replace {app-id} with your app id
  'app_secret' => $app_secret,
  'default_graph_version' => 'v2.2'
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // permisos
$loginUrl = $helper->getLoginUrl($login_url, $permissions);

//echo '<a href="' . htmlspecialchars($loginUrl) . '">Entrar con Facebook!</a>';

?>