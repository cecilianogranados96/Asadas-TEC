<div class="page-404 padding ptb-xs-40">
    <div class="container">
        <?php 
        
        if(isset($_GET['nuevo'])){
            $json = json_encode($_POST,JSON_UNESCAPED_UNICODE);
            echo $querry = "INSERT INTO `formulario`(`id_tramite`, `id_usuario`, `respuesta`) VALUES ('".$_GET['tramite']."','".$_SESSION["usuario"]."','".$json."')";
            mysqli_query($link,$querry);
            echo "<script>alert('Tramite guardado con éxito');location.href='?pag=usuario/mistramites';</script>";
        }
        
        
        
            $sth = mysqli_query($link,"SELECT id_tramite, nombre, descripcion, plantilla, requisitos,formulario FROM tramite WHERE id_tramite= '".$_GET['tramite']."' ");
            $tramite = mysqli_fetch_assoc($sth);
        ?>
       <h1><center><?php echo $tramite['nombre']; ?></center></h1><br>
       <h4><?php echo $tramite['descripcion']; ?></h4>
      <form class="form-horizontal" action="?pag=<?php echo $_GET['pag']; ?>&tramite=<?php echo $_GET['tramite']; ?>&nuevo=1" method="post" enctype="multipart/form-data">
            <?php 
                $sth = mysqli_query($link,"SELECT CONCAT(persona.nombre,' ',persona.primerApellido,' ',persona.segundoApellido) as nombre_completo, persona.nombre,persona.primerApellido,persona.segundoApellido,persona.direccion, asada.nombre as asada, loc_distrito.nombre as distrito from persona,asada,loc_distrito,usuario WHERE persona.id_distrito = loc_distrito.id_distrito and usuario.id_persona = persona.id_persona and asada.id_asada = usuario.id_asada and usuario.id_usuario = '".$_SESSION["usuario"]."'");
                $datos = mysqli_fetch_assoc($sth);
                $array = json_decode($tramite['formulario'],true);
                $identificador = 0;
                foreach ($array as $i => $value) {
                    $identificador ++;
                    if ($array[$i]["tipo"] == 1){
                        if ($array[$i]["campo"] != "ninguno"){
                            $value = "value = '".$datos[$array[$i]["campo"]]."'";
                        }else{
                            $value = "";
                        }
                        echo "
                            <div class='form-group'>
                                <label class='col-md-4 control-label'>".$array[$i]["nombre"]."</label>
                                <div class='col-md-4'>
                                    <input type='text' name='".$identificador."' class='form-control input-md'  $value >
                                </div>
                            </div>";
                    }else{
                        echo "
                            <div class='form-group'>
                                <label class='col-md-4 control-label'>".$array[$i]["nombre"]."</label>
                                <div class='col-md-4'> <select  name='".$identificador."' class='form-control'>
                                <option value=''>Seleccionar</option>
                                ";
                        foreach ($array[$i]["opciones"] as $valor) {
                                echo "<option value='$valor'>$valor</option>";
                        }                           
                        echo " </select></div></div>";
                    }
                }
          ?>
          <center><input type='submit' value='Enviar' class="btn btn-success"/></center>
        </form>
        <h4>Los requisitos para este trámite son: <br></h4>
        <?php echo $tramite['requisitos']; ?>
    </div>
</div>
