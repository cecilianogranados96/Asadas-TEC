<?php
include("dbconnection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$email=$_POST['email1']; // Fetching Values from URL.
$password= $_POST['password1']; // Password Encryption, If you like you can also leave sha1.
//$email="jorgeandresbm22@gmail.com";
//$password="lafourcade";
// check if e-mail address syntax is valid or not
$email = filter_var($email, FILTER_SANITIZE_EMAIL); // sanitizing email(Remove unexpected symbol like <,>,?,#,!, etc.)
if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "inv";
}else{
    // Matching user input email and password with stored email and password in database.
    $result = mysqli_query($conn, "SELECT nombreUsuario FROM USUARIO WHERE nombreUsuario='$email' AND contrasena='$password'");
    $data = mysqli_num_rows($result);
    $result2 = mysqli_query($conn, "SELECT TIPO_USUARIO_idTIPO_USUARIO FROM USUARIO WHERE nombreUsuario='$email' AND contrasena='$password'");
    /*
    while ($row = mysqli_fetch_assoc($result2)) {
         print_r ($row[0]);
    }
    */
    $row = mysqli_fetch_object($result2);
    //$tipo = $row->TIPO_USUARIO_idTIPO_USUARIO;
    if($data==1){
        //$row = mysqli_fetch_object($result2);
        //print $row->TIPO_USUARIO_idTIPO_USUARIO;
        //echo $row->TIPO_USUARIO_idTIPO_USUARIO;
        setcookie("tipoUsuario", $row->TIPO_USUARIO_idTIPO_USUARIO, time() + (86400 * 30), "/");
        $result2 = mysqli_query($conn, "SELECT ASADA_idASADA FROM USUARIO_X_ASADA WHERE USUARIO_nombreUsuario = '$email'");
        $row = mysqli_fetch_object($result2);
        setcookie("asada", $row->ASADA_idASADA, time() + (86400 * 30), "/");
        $asada = $row->ASADA_idASADA;
        $result2 = mysqli_query($conn, "SELECT nombre FROM ASADA WHERE idASADA = '$asada'");
        $row = mysqli_fetch_object($result2);
        $nombreASADA = $row->nombre;
        setcookie("nombreASADA", (string)$nombreASADA, time() + (86400 * 30), "/");
        echo "si";
    }else{
        echo "no";
    }
}



mysqli_close ($conn); // Connection Closed.
?>