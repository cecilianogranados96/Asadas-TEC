<div class="page-404 padding ptb-xs-40">
    <div class="container">
        <?php
            if (isset($_GET["abrir_orden"])){
                $querry = "INSERT INTO `ordenes_trabajo`(`id_formulario`, `id_encargado`, `id_usuario_apertura`) VALUES (
                '".$_GET['formulario']."',
                '".$_POST['encargado']."',
                '".$_SESSION["usuario"]."')";
                mysqli_query($link,$querry);
                echo "<script>alert('Orden creada con éxito');location.href='?pag=".$_GET['pag']."&formulario=".$_GET['formulario']."';</script>";
            }
        
        
        
            if (isset($_GET["actualizar"])){
                $querry = "UPDATE `formulario` SET `id_estado_solicitud`='".$_GET['actualizar']."' WHERE `id_formulario`='".$_GET['formulario']."'";
                mysqli_query($link,$querry);
                $querry = "UPDATE `ordenes_trabajo` SET `estado`='".$_GET['actualizar']."' WHERE `id_formulario`='".$_GET['formulario']."'";
                mysqli_query($link,$querry);
                echo "<script>alert('Actualizado con éxito');</script>";
                echo "<script>location.href='?pag=".$_GET['pag']."&formulario=".$_GET['formulario']."';</script>";
            }
                $sth1 = mysqli_query($link,"SELECT formulario.fecha, formulario.id_tramite,formulario.respuesta, tramite.nombre,tramite.formulario,formulario.id_estado_solicitud as id_estado, estado_solicitud.nombre as estado from formulario,tramite,estado_solicitud where formulario.id_tramite = tramite.id_tramite and formulario.id_estado_solicitud = estado_solicitud.id_estado_solicitud and formulario.id_formulario = '".$_GET['formulario']."'");
                $tramite = mysqli_fetch_assoc($sth1);        
            ?>
            <h1>
                <center>
                    <?php echo $tramite['nombre']; ?><br>
                </center>
            </h1><br>
            <?php                 
        $sth2 = mysqli_query($link,"SELECT COUNT(id_orden) as cantidad FROM `ordenes_trabajo` WHERE `id_formulario` =  '".$_GET['formulario']."'");
        $abrir_orden = mysqli_fetch_assoc($sth2);  
        if ($abrir_orden['cantidad'] == 1){
            
            $sth3 = mysqli_query($link,"SELECT  CONCAT(persona.nombre,' ', persona.primerApellido, ' ',persona.segundoApellido) as encargado,ordenes_trabajo.fecha_apertura,ordenes_trabajo.estado,ordenes_trabajo.id_orden, ordenes_trabajo.historial, ordenes_trabajo.material FROM `ordenes_trabajo`,persona,usuario WHERE usuario.id_persona = persona.id_persona and usuario.id_usuario = ordenes_trabajo.id_encargado and ordenes_trabajo.id_formulario = '".$_GET['formulario']."' ");
            $datos_orden = mysqli_fetch_assoc($sth3); 
                    if ($datos_orden['estado'] == 1){
                        $clase = 'info';
                        $estado = 'Pendiente';
                    }
                    if ($datos_orden['estado'] == 2){
                        $clase = 'success';
                        $estado = 'Abierto';
                    }
                    if ($datos_orden['estado'] == 3){
                        $clase = 'danger';
                        $estado = 'Cerrado';
                    }
            
        ?>
            <h3>Orden de abierta</h3>
            <table class="table">
                <tr class="danger">
                    <td>
                        <center>
                            <b>Número</b>
                        </center>
                    </td>
                    <td>
                        <center>
                            <b>Tipo</b>
                        </center>
                    </td>
                    <td>
                        <center>
                            <b>Encargado</b>
                        </center>
                    </td>
                    <td>
                        <center>
                            <b>Fecha apertura</b>
                        </center>
                    </td>
                    <td>
                        <center>
                            <b>Autorizo</b>
                        </center>
                    </td>
                    <td>
                        <center>
                            <b>Estado</b>
                        </center>
                    </td>
                    <td>
                        <center>
                            <b>Cambiar estado</b>
                        </center>
                    </td>
                </tr>
                <tr class="<?php echo $clase; ?>">
                    <td>
                        <center>
                            <?php echo $datos_orden['id_orden']; ?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php echo $tramite['nombre']; ?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php echo $datos_orden['encargado']; ?>
                        </center>
                    </td>

                    <td>
                        <center>
                            <?php echo $datos_orden['fecha_apertura']; ?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php echo $datos_orden['encargado']; ?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <a class="btn btn-<?php echo $clase; ?>"><?php echo $estado; ?></a>
                        </center>
                    </td>

                    <td>

                        <table>
                            <tr>
                                <?php if($datos_orden['estado'] != 1){ ?>
                                <td>
                                    <center>
                                        <a href="?pag=<?php echo $_GET['pag']; ?>&formulario=<?php echo $_GET['formulario']; ?>&actualizar=1" onclick="javascript: return confirm('¿Estas seguro?');" class="btn btn-info">Pendiente</a>
                                    </center>
                                </td>
                                <?php } if($datos_orden['estado'] != 2){ ?>
                                <td>
                                    <center>
                                        <a href="?pag=<?php echo $_GET['pag']; ?>&formulario=<?php echo $_GET['formulario']; ?>&actualizar=2" onclick="javascript: return confirm('¿Estas seguro?');" class="btn btn-success">Abierta</a>
                                    </center>
                                </td>
                                <?php } if($datos_orden['estado'] != 3){ ?>
                                <td>
                                    <center>
                                        <a href="?pag=<?php echo $_GET['pag']; ?>&formulario=<?php echo $_GET['formulario']; ?>&actualizar=3" onclick="javascript: return confirm('¿Estas seguro?');" class="btn btn-danger">Cerrada</a>
                                    </center>
                                </td>
                                <?php } ?>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <?php if($datos_orden['historial'] != ""){ ?>
            <table class="table">
                <tr class="success">
                    <td>
                        <center>
                            <b>Historial</b>
                        </center>
                    </td>
                    <td>
                        <center>
                            <b>Materiales</b>
                        </center>
                    </td>
                 
                    
                </tr>
                <tr class="success">
                    <td>
                        <center>
                            <?php echo $datos_orden['historial']; ?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php echo $datos_orden['material']; ?>
                        </center>
                    </td>
                </tr>
            </table>
        <?php } ?>
        
        

            <?php    
        }else{
        ?>
            <h3>Cambiar estado de la Solicitud</h3>
            <table class="table">
                <tr class="warning">
                    <?php
                $querry = mysqli_query($link,"Call Get_Estado_Solicitud()");

                while($datos = mysqli_fetch_assoc($querry)) {
                    if ($datos['id_estado_solicitud'] == 1){
                        $clase = 'info';
                    }
                    if ($datos['id_estado_solicitud'] == 2){
                        $clase = 'success';
                    }
                    if ($datos['id_estado_solicitud'] == 3){
                        $clase = 'danger';
                    }
                    
                echo '
                <td><center>
                <a href="?pag='.$_GET['pag'].'&formulario='.$_GET['formulario'].'&actualizar='.$datos['id_estado_solicitud'].'" 
                onclick="javascript: return confirm('."'".'¿Estas seguro?'."'".');"  class="btn btn-'.$clase.'" href="#">'.$datos['nombre'].'</a>
                </center>
                </td>';
                }
                    if ($tramite['id_estado']  == 1){
                        $clase = 'info';
                    }
                    if ($tramite['id_estado']  == 2){
                        $clase = 'success';
                    }
                    if ($tramite['id_estado']  == 3){
                        $clase = 'danger';
                    }
                            mysqli_next_result($link);
                     
                 ?>
                </tr>
            </table>
            <h3>Abrir orden de trabajo</h3>
            <form action="?pag=<?php echo $_GET['pag']; ?>&formulario=<?php echo $_GET['formulario']; ?>&abrir_orden=1" method="post">
                <table class="table">
                    <tr class="danger">
                        <td>
                            <center>
                                Encargado
                            </center>
                        </td>
                        <td>
                            <select id="select-beast" name="encargado" required>
                                <option value="" selected>Seleccionar</option>
                                <?php 
                                  $sth = mysqli_query($link,"SELECT usuario.id_usuario, CONCAT(persona.nombre,' ', persona.primerApellido, ' ',persona.segundoApellido) as nombre FROM `usuario`,persona WHERE usuario.id_persona = persona.id_persona and usuario.tipo_usuario_id = 4");
                                    while($r = mysqli_fetch_assoc($sth)) {
                                        echo '<option value="'.$r['id_usuario'].'">'.$r['nombre'].'</option>';
                                    }
                                  ?>
                              </select>
                            <script>
                                $('#select-beast').selectize({
                                    create: true,
                                    sortField: 'text'
                                });

                            </script>
                        </td>
                        <td>
                            <center><button class="btn btn-success" type="submit">Abrir</button></center>
                        </td>
                    </tr>
                </table>
            </form>
            <?php    
        }
        ?>

            <h3>Datos del formulario:</h3>
            <table class="table">
                <tr class="<?php echo $clase;?>">
                    <td><b>Fecha de la solicitud</b></td>
                    <td><b><?php echo $tramite['fecha']; ?></b></td>
                </tr>
                <tr class="<?php echo $clase;?>">
                    <td><b>Estado</b></td>
                    <td><b><?php echo $tramite['estado']; ?></b></td>
                </tr>
                <?php 
                $array = json_decode($tramite['formulario'],true);
                $respuesta = json_decode($tramite['respuesta'],true);
                $identificador = 0;
                foreach ($array as $i => $value) {
                    $identificador ++;
                    if ($array[$i]["tipo"] == 4 ){
                        echo "<tr><td>".$array[$i]["nombre"]."</td><td>
                        <center><a href='".$respuesta[$i+1]."' class='btn btn-success' target='_blank'>Ver/Descargar</a></center></td></tr>";
                    }else{
                        echo "<tr><td>".$array[$i]["nombre"]."</td><td>".$respuesta[$i+1]."</td></tr>";
                    }
                    
                } 
                ?>


            </table>


    </div>
</div>
