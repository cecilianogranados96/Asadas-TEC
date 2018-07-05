<div class="page-404 padding ptb-xs-40">
    <div class="container">
        <?php 
        if(isset($_GET['nuevo'])){        
            if(isset($_FILES)){
                foreach($_FILES as $file){
                    $name = $file['name'];
                    $name = str_replace(' ', '', $name);
                    $name = explode('.', $name);
                    $destino =  "uploads/formulario/".substr($file['tmp_name'], -6).'.'.$name[1];
                    copy($file['tmp_name'],$destino);
                }
            }
            $x = 1;
            $array = array();
            foreach($_POST as $file){
                if($file == "file"){
                    $name = $_FILES[$x]['name'];
                    $name = str_replace(' ', '', $name);
                    $name = explode('.', $name);
                    $array += [$x => "uploads/formulario/".substr($_FILES[$x]['tmp_name'], -6).'.'.$name[1] ];
                }else{
                     $array += [$x => $file];
                }
                $x++;
            }
            $json = json_encode($array,JSON_UNESCAPED_UNICODE);
            $querry = "INSERT INTO `formulario`(`id_tramite`, `id_usuario`, `respuesta`) VALUES ('".$_GET['tramite']."','".$_SESSION["usuario"]."','".$json."')";
            mysqli_query($link,$querry);
            echo "<script>alert('Tramite guardado con éxito');location.href='?pag=usuario/mistramites';</script>";
        }
            $sth = mysqli_query($link,"SELECT id_tramite, nombre, descripcion, plantilla, requisitos,formulario FROM tramite WHERE id_tramite= '".$_GET['tramite']."' ");
            $tramite = mysqli_fetch_assoc($sth);
        ?>


<?php if(!isset($_GET['paso'])){?>
        <h1>
            <center>
                <?php echo $tramite['nombre']; ?>
            </center>
        </h1>
        <hr>
        <h4>Descripción del tramite:</h4><br>
        <?php echo $tramite['descripcion']; ?>
        <br><hr><br>
        <h4>Los requisitos para este trámite son:</h4><br>
        <?php echo $tramite['requisitos']; ?>
<br><hr><br>
        <center>
            <a href="?pag=<?php echo $_GET['pag']; ?>&tramite=<?php echo $_GET['tramite']; ?>&paso=2" class="btn btn-danger btn-lg">Siguiente</a>
        </center>
<?php }else{ ?>

        <h1>
            <center>
                <?php echo $tramite['nombre']; ?>
            </center>
        </h1><br><br>


        <form class="form-horizontal" action="?pag=<?php echo $_GET['pag']; ?>&tramite=<?php echo $_GET['tramite']; ?>&nuevo=1" method="post" enctype="multipart/form-data">
            <?php 
                $sth = mysqli_query($link,"SELECT CONCAT(persona.nombre,' ',persona.primerApellido,' ',persona.segundoApellido) as nombre_completo, persona.nombre,persona.primerApellido,persona.segundoApellido,persona.direccion, asada.nombre as asada, loc_distrito.nombre as distrito from persona,asada,loc_distrito,usuario WHERE persona.id_distrito = loc_distrito.id_distrito and usuario.id_persona = persona.id_persona and asada.id_asada = usuario.id_asada and usuario.id_usuario = '".$_SESSION["usuario"]."'");
                $datos = mysqli_fetch_assoc($sth);
                $array = json_decode($tramite['formulario'],true);
                $identificador = 0;
                foreach ($array as $i => $value) {
                    $identificador ++;
                    $value= "";
                    $requerido= "";
                    if ($array[$i]["requerido"] == 1){
                            $requerido = "required";
                    }
                    
                    
                    echo "<div class='form-group'> \n
                                <label class='col-md-4 control-label'>".$array[$i]["nombre"]."</label> \n
                                <div class='col-md-4'> \n";
                    
                    if ($array[$i]["tipo"] == 1){ //CAMPO DE TEXTO
                        if ($array[$i]["campo"] != "ninguno"){
                            $value = "value = '".$datos[$array[$i]["campo"]]."'";
                        }
                        echo "<input type='text' name='".$identificador."' class='form-control input-md'  $value  $requerido> \n";
                    }
                    
                    if ($array[$i]["tipo"] == 2){ //Seleccionable
                        echo "<select  name='".$identificador."' class='form-control' $requerido >\n<option value=''>Seleccionar</option>\n";
                        foreach ($array[$i]["opciones"] as $valor) {
                                echo "<option value='$valor'>$valor</option>\n";
                        }                           
                        echo " </select>";
                    }
                    
                    if ($array[$i]["tipo"] == 3){ //Texto
                        if ($array[$i]["campo"] != "ninguno"){
                            $value = "".$datos[$array[$i]["campo"]]."";
                        }
                        echo "<textarea name='".$identificador."' class='form-control' $requerido >$value</textarea>\n";
                    }
                    
                    if ($array[$i]["tipo"] == 4){ //Archivo
                        echo "<input type='file' name='".$identificador."' class='form-control input-md' $requerido>\n";
                        echo "<input type='text' name='".$identificador."' style='display:none;' value='file' >\n";
                    }
                    
                    echo "</div>\n
                    </div>\n\n";
                    
                    
                }
          ?>
            <center><input type='submit' value='Enviar' class="btn btn-success" <?php if($_SESSION[ "usuario"] !=1 ){ echo "disabled";} ?>/></center>
        </form>

<?php } ?>
    </div>
</div>
