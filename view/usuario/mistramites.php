<div class="page-404 padding ptb-xs-40">
    <div class="container">
        <center><h1>Mis Tramites</h1></center>
					<table class="table" >
					  <tr class="warning">
                        <td><center><b>Número</b></center></td>
                        <td><center><b>Fecha</b></center></td>
                        <td><center><b>Tipo</b></center></td>
                        <td><center><b>Estado</b></center></td>
                        <td><center><b>Consulta</b></center></td>
					  </tr>
				
                     <?php 
                        $consulta = "SELECT formulario.fecha,tramite.nombre as tramite, estado_solicitud.nombre as estado_solicitud, formulario.id_formulario, formulario.id_estado_solicitud FROM `formulario`,tramite,estado_solicitud WHERE formulario.id_tramite = tramite.id_tramite and estado_solicitud.id_estado_solicitud = formulario.id_estado_solicitud and formulario.id_usuario = '".$_SESSION["usuario"]."' ORDER by formulario.fecha DESC";
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
                            
                            if ($r['id_estado_solicitud'] == 1){
                                $clase = 'info';
                            }
                            if ($r['id_estado_solicitud'] == 2){
                                $clase = 'success';
                            }
                            if ($r['id_estado_solicitud'] == 3){
                                $clase = 'danger';
                            }
                            echo '<tr class="'.$clase.'">
                                    <th>'.$r['id_formulario'].'</th>
                                    <th>'.$r['fecha'].'</th>
                                    <th>'.$r['tramite'].'</th>
                                    <th>'.$r['estado_solicitud'].'</th>
                                    <th><a class="btn btn-success" href="?pag=usuario/vertramite&formulario='.$r['id_formulario'].'">Consultar</a> </th>
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
			