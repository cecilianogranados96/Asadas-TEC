<div class="page-404 padding ptb-xs-40">
    <div class="container">
            <center><h1>Solicitudes</h1></center>
            <table class="table">
                <tr class="warning">
                    <td>
                        <center>
                            <a href="?pag=<?php echo $_GET['pag']; ?>" class="btn btn-warning">Todas</a>
                        </center>
                    </td>
                    <td>
                        <center>
                            <a href="?pag=<?php echo $_GET['pag']; ?>&estado=1" class="btn btn-info">Pendientes</a>
                        </center>
                    </td>
                    <td>
                        <center>
                            <a href="?pag=<?php echo $_GET['pag']; ?>&estado=2" class="btn btn-success">Aceptadas</a>
                        </center>
                    </td>
                    <td>
                        <center>
                            <a href="?pag=<?php echo $_GET['pag']; ?>&estado=3" class="btn btn-danger" >Rechazadas</a>
                        </center>
                    </td>
                </tr>
            </table>
        <?php 
        if (isset($_GET['estado'])){    
            if ($_GET['estado'] == 1){
                $estado = 'Pendientes';
            }
            if ($_GET['estado'] == 2){
                $estado = 'Aceptadas';
            }
            if ($_GET['estado'] == 3){
                $estado = 'Rechazadas';
            }
        }else{
             $estado = 'Todas';
        }
                    
        
        ?>
            <center><h3><?php echo $estado; ?></h3></center>
            <table class="table" >
              <tr class="warning">
                <td><center><b>Número</b></center></td>
                <td><center><b>Cédula</b></center></td>
                <td><center><b>Persona</b></center></td>
                <td><center><b>Fecha</b></center></td>
                <td><center><b>Tipo</b></center></td>
                <td><center><b>Estado</b></center></td>
                <td><center><b>Consulta</b></center></td>
              </tr>
             <?php
                if(isset($_GET['estado'])){
                    $consulta = "SELECT CONCAT(persona.nombre,' ',persona.primerApellido,' ',persona.segundoApellido) as nombre_completo,persona.cedula,formulario.fecha,DATEDIFF(NOW(),formulario.fecha) as dias_transcurridos, formulario.id_tramite,formulario.respuesta,formulario.id_formulario, tramite.nombre,tramite.formulario,formulario.id_estado_solicitud as id_estado, estado_solicitud.nombre as estado from formulario,tramite,estado_solicitud ,usuario,persona
                    where formulario.id_tramite = tramite.id_tramite and formulario.id_estado_solicitud = estado_solicitud.id_estado_solicitud and formulario.id_usuario = usuario.id_usuario and persona.id_persona = usuario.id_persona and tramite.id_asada = '".$_SESSION["asada"]."' and formulario.id_estado_solicitud = '".$_GET['estado']."' ORDER by formulario.id_estado_solicitud ASC";
                }else{
                    $consulta = "SELECT CONCAT(persona.nombre,' ',persona.primerApellido,' ',persona.segundoApellido) as nombre_completo,persona.cedula,DATEDIFF(NOW(),formulario.fecha) as dias_transcurridos,formulario.fecha, formulario.id_tramite,formulario.respuesta,formulario.id_formulario, tramite.nombre,tramite.formulario,formulario.id_estado_solicitud as id_estado, estado_solicitud.nombre as estado from formulario,tramite,estado_solicitud ,usuario,persona
                    where formulario.id_tramite = tramite.id_tramite and formulario.id_estado_solicitud = estado_solicitud.id_estado_solicitud and formulario.id_usuario = usuario.id_usuario and persona.id_persona = usuario.id_persona and tramite.id_asada = '".$_SESSION["asada"]."' ORDER by formulario.id_estado_solicitud ASC";
                }
                $sth = mysqli_query($link,$consulta);
                

                if (!isset($_GET["pagina"])) {
                   $inicio = 0;
                   $pagina = 1;
                } else {
                   $inicio = ($_GET["pagina"] - 1) * $TAMANO_PAGINA;
                   $pagina = $_GET["pagina"];
                }
                $url= "?pag=".$_GET['pag']."";
                $total_paginas = ceil(mysqli_num_rows($sth) / $TAMANO_PAGINA);
                $consulta .=  " LIMIT ".$inicio."," . $TAMANO_PAGINA;
                $sth = mysqli_query($link,$consulta);        
                
    
                           
                while($r = mysqli_fetch_assoc($sth)) {
                    
                    
                    if ($r['id_estado']  == 1){
                        $clase = 'info';
                    }
                    if ($r['id_estado']  == 2){
                        $clase = 'success';
                    }
                    if ($r['id_estado']  == 3){
                        $clase = 'danger';
                    } 
                    echo '<tr class="'.$clase.'">
                            <th>'.$r['id_formulario'].'</th>
                            <th>'.$r['cedula'].'</th>
                            <th>'.$r['nombre_completo'].'</th>
                            <th><center>'.$r['fecha'].' <br> ('.$r['dias_transcurridos'].' días) </center></th>
                            <th>'.$r['nombre'].'</th>
                            <th>'.$r['estado'].'</th>
                            <th><a class="btn btn-success" href="?pag=administrador/ver_tramite&formulario='.$r['id_formulario'].'">Consultar</a> </th>
                           </tr> 
                        ';
                }
                ?>
            </table>
        
        
            <center>
            <ul class="pagination">
                <?php 
                if ($total_paginas > 1) {
                    if ($pagina != 1)
                      echo ' <li><a href="'.$url.'&pagina='.($pagina-1).'">«</a></li>';
                      for ($i=1;$i<=$total_paginas;$i++) {
                         if ($pagina == $i)
                          echo "<li class='active'><a href='".$url."&pagina=".$pagina."'>$pagina<span class='sr-only'>(current)</span></a></li>";
                         else
                            echo ' <li><a href="'.$url.'&pagina='.$i.'">'.$i.'</a></li>';
                      }
                      if ($pagina != $total_paginas)
                         echo '<li><a href="'.$url.'&pagina='.($pagina+1).'">»</a></li>';
                    }
                ?>
            </ul>
            </center>
        
        
        
            </div>
</div>