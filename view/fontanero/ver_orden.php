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
            $sth2 = mysqli_query($link,"SELECT COUNT(id_orden) as cantidad FROM `ordenes_trabajo` WHERE `id_formulario` =  '".$_GET['formulario']."'");
            $abrir_orden = mysqli_fetch_assoc($sth2);  

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




            <h1>
                <center>
                    <?php echo $tramite['nombre']; ?><br>
                </center>
            </h1><br>     
        
                  <table class="table">
                <tr class="danger">
                    <td>
                        <center>
                            <b><a class="btn btn-info" href="?pag=fontanero/cerrar_orden&formulario=<?php echo $_GET['formulario']; ?>&step=1">Antes</a></b>
                        </center>
                    </td>
                    <td>
                        <center>
                            <b><a class="btn btn-success" href="?pag=fontanero/cerrar_orden&formulario=<?php echo $_GET['formulario']; ?>&step=2">Despues</a></b>
                        </center>
                    </td>
                    <td>
                        <center>
                            <b><a class="btn btn-danger" href="?pag=fontanero/cerrar_orden&formulario=<?php echo $_GET['formulario']; ?>&step=3">Firma</a></b>
                        </center>
                    </td>
                    <td>
                        <center>
                            <b><a class="btn btn-primary" href="?pag=fontanero/cerrar_orden&formulario=<?php echo $_GET['formulario']; ?>&step=4">Añadir materiales</a></b>
                        </center>
                    </td>
                </tr>
            </table>
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

            <h3>Datos de la orden:</h3>
            <table class="table">
                <tr class="danger">
                    <td>
                        <center>
                            <b> Número </b>
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
                            <a class="btn btn-<?php echo $clase; ?>">
                                <?php echo $estado; ?>
                            </a>
                        </center>
                    </td>
                </tr>
            </table>
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
                    <td width="50%">
                        <center>
                            <?php echo $datos_orden['historial']; ?>
                        </center>
                    </td>
                    <td>
        <table class="table">
                <tr >
                    <td>
                        <center>
                            <b>Código</b>
                        </center>
                    </td>
                    <td>
                        <center>
                            <b>Nombre</b>
                        </center>
                    </td>
                    <td>
                        <center>
                            <b>Cantidad</b>
                        </center>
                    </td>
                </tr>
             <?php
                if($datos_orden['material'] != ""){
                    $array = json_decode($datos_orden['material'],true);
                    $identificador = 0;
                    foreach ($array as $i => $value) {
                        $identificador ++;
                        $sth2 = mysqli_query($link,"SELECT inventario.id_inventario, producto.nombre FROM `inventario`,producto WHERE inventario.codigo = producto.id_producto and inventario.id_inventario = '".$array[$i]["codigo"]."'");
                        $producto = mysqli_fetch_assoc($sth2);  
                            echo "<tr>
                                    <td><center>".$producto['id_inventario']."</center></td>
                                    <td><center>".$producto['nombre']."</center></td>
                                    <td><center>".$array[$i]["cantidad"]."</center></td>
                                </tr>";        
                    }
                }   
        ?>
        </table> 
                        
                        
                  
                    </td>
                </tr>
            </table>
        
        
        <center>
                      
              <b><a class="btn btn-danger" href="?pag=administrador/cerrar_orden&formulario=<?php echo $_GET['formulario']; ?>&step=5">Cerrar Manualmente</a></b>
                        </center>
    
       
    
    </div>
</div>
