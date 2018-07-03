<?php



if(isset($_SESSION["masterizado"])){
    if($_SESSION["masterizado"] == 1){
        $query = "SELECT * FROM `usuario` WHERE `id_usuario` = '".$_SESSION["usuario_master"]."' ";
        $result = mysqli_query($link,$query);
        $datos = mysqli_fetch_array($result);
        $tipo = $datos['tipo_usuario_id'];    
        $_SESSION["persona"] = $datos['id_persona'];
        $_SESSION["tipo"] = $datos['tipo_usuario_id'];
        $_SESSION["asada"] = $datos['id_asada'];
        $_SESSION["usuario"] = $_SESSION["usuario_master"];
        $_SESSION["masterizado"] = 2;

        if ($tipo == 3 ){
            echo "<script languaje='JavaScript'>location.href='?pag=master/usuarios&tipo=2';</script>";
            exit;
        }
    }else{
         session_destroy();
    }
    
}else{
    session_destroy();
}


echo "<script languaje='JavaScript'>location.href='?pag=general/login';</script>";


?>

