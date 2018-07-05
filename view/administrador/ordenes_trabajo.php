<div class="page-404 padding ptb-xs-40">
    <div class="container">
            <center><h1>Ordenes de trabajo</h1></center>
          <table class="table">        
        
            <table class="table">
                <tr class="warning">
                    <td>
                        <center>
                            <a href="?pag=<?php echo $_GET['pag']; ?>&estado=1" class="btn btn-info">Pendientes</a>
                        </center>
                    </td>
                    <td>
                        <center>
                            <a href="?pag=<?php echo $_GET['pag']; ?>&estado=2" class="btn btn-success">Abiertas</a>
                        </center>
                    </td>
                    <td>
                        <center>
                            <a href="?pag=<?php echo $_GET['pag']; ?>&estado=3" class="btn btn-danger" >Cerradas</a>
                        </center>
                    </td>
                </tr>
            </table>
        
            <table class="table" >
              <tr class="warning">
                <td><center><b>Número</b></center></td>
                <td><center><b>Tipo</b></center></td>
                  
                <td><center><b>Usuario</b></center></td>
                <td><center><b>Encargado</b></center></td>
                  
 
                <td><center><b>Fecha</b></center></td>
                <td><center><b>Estado</b></center></td>
                <td><center><b>Consulta</b></center></td>
              </tr>
             <?php 
                if(isset($_GET['estado'])){
                    $consulta = "SELECT ordenes_trabajo.id_orden,ordenes_trabajo.id_formulario,ordenes_trabajo.id_usuario_apertura,ordenes_trabajo.historial,ordenes_trabajo.estado,ordenes_trabajo.fecha_apertura,CONCAT(persona.nombre,' ', persona.primerApellido, ' ',persona.segundoApellido) as encargado, tramite.nombre as tipo,DATEDIFF(NOW(),ordenes_trabajo.fecha_apertura) as dias_transcurridos,formulario.id_usuario as usuario FROM `ordenes_trabajo`,usuario,persona,tramite,formulario WHERE usuario.id_persona = persona.id_persona and ordenes_trabajo.id_formulario = formulario.id_formulario and formulario.id_tramite = tramite.id_tramite and ordenes_trabajo.id_encargado = usuario.id_usuario and usuario.id_asada = '".$_SESSION["asada"]."' and ordenes_trabajo.estado = '".$_GET['estado']."'  ORDER BY ordenes_trabajo.fecha_apertura ASC";
                }else{
                    $consulta = "SELECT ordenes_trabajo.id_orden,ordenes_trabajo.id_formulario,ordenes_trabajo.id_usuario_apertura,ordenes_trabajo.historial,ordenes_trabajo.estado,DATEDIFF(NOW(),ordenes_trabajo.fecha_apertura) as dias_transcurridos,ordenes_trabajo.fecha_apertura,CONCAT(persona.nombre,' ', persona.primerApellido, ' ',persona.segundoApellido) as encargado, tramite.nombre as tipo,formulario.id_usuario as usuario FROM `ordenes_trabajo`,usuario,persona,tramite,formulario WHERE usuario.id_persona = persona.id_persona and ordenes_trabajo.id_formulario = formulario.id_formulario and formulario.id_tramite = tramite.id_tramite and ordenes_trabajo.id_encargado = usuario.id_usuario and usuario.id_asada = '".$_SESSION["asada"]."' ORDER BY ordenes_trabajo.fecha_apertura ASC";
                }
                $sth = mysqli_query($link,$consulta);
                

                            
                while($r = mysqli_fetch_assoc($sth)) {
                    
                    
                    $sth1 = mysqli_query($link,"Call Get_nombre_ID_Usuario(".$r['usuario'].")");
                    $nombre_usuario = mysqli_fetch_assoc($sth1);
                    mysqli_next_result($link);
                    if ($r['estado'] == 1){
                        $clase = 'info';
                        $estado = 'Pendiente';
                    }
                    if ($r['estado'] == 2){
                        $clase = 'success';
                        $estado = 'Abierto';
                    }
                    if ($r['estado'] == 3){
                        $clase = 'danger';
                        $estado = 'Cerrado';
                    }
                    echo '<tr class="'.$clase.'">
                            <th>'.$r['id_orden'].'</th>
                            <th>'.$r['tipo'].'</th>
                            <th>'.$nombre_usuario['nombre'].'</th>
                            <th>'.$r['encargado'].'</th>
                            
                            <th><center>'.$r['fecha_apertura'].' <br> ('.$r['dias_transcurridos'].' días) </center></th>
                            <th>'.$estado.'</th>

                                                    
                            <th><a class="btn btn-success" href="?pag=administrador/ver_tramite&formulario='.$r['id_formulario'].'">Ver</a> </th>
                           </tr> 
                        ';
                }
                ?>
            </table>
            </div>
</div>