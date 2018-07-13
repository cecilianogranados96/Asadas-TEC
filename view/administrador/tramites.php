<div class="page-404 padding ptb-xs-40">
    <div class="container" >
        <center><h1>Visualizacion de tramites</h1></center>
        <br>
        <table class="table table-striped">
          <tr class="warning">
              <td><center><b>Nombre</b></center></td>
              <td><center><b>Asada</b></center></td>
            <td><center><b>Descripción</b></center></td>
            <td><center><b>Acciones</b></center></td>
              <td><center><b>Visualizar</b></center></td>
          </tr>
            <?php 
        if(isset($_GET['tramite'])){ 
            mysqli_query($link,"UPDATE `tramite` SET `estado_tramite`='".$_GET['estado']."' WHERE `id_tramite`='".$_GET['tramite']."' ");
            echo "<script>location.href='?pag=".$_GET['pag']."';</script>";
        }
                $consulta = "SELECT tramite.id_tramite, tramite.nombre, tramite.descripcion, tramite.plantilla,asada.nombre as asada,tramite.estado_tramite FROM tramite,asada WHERE (tramite.id_asada = '".$_SESSION["asada"]."' or tramite.id_asada = 0) and tramite.estado_tramite = 1 and tramite.id_asada = asada.id_asada ORDER BY tramite.id_asada, tramite.id_tramite ASC
                
                
                ";
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
                    
                    
                    
                    if ($r['estado_tramite'] == 1){
                        $accion = '<a href="?pag='.$_GET['pag'].'&tramite='.$r['id_tramite'].'&estado=0" 
                onclick="javascript: return confirm('."'".'¿Estas seguro?'."'".');"  class="btn btn-danger" href="#">Deshabilitar</a>';
                        $clase = 'class="success"';
                    }else{
                        $accion = '<a href="?pag='.$_GET['pag'].'&tramite='.$r['id_tramite'].'&estado=1" 
                onclick="javascript: return confirm('."'".'¿Estas seguro?'."'".');"  class="btn btn-success" href="#">Habilitar</a>';
                        $clase = 'class="danger"';
                    }
                    echo '<tr '.$clase.'>
                            <td width="30%">'.$r['nombre'].'</th>
                            <td width="30%"><center><b>'.$r['asada'].'</b></center></th>
                            <td width="50%">'.$r['descripcion'].'</th>
                            <td width="10%">'.$accion.'</td>
                            <td width="10%"><a href="?pag=usuario/llenartramite&tramite='.$r['id_tramite'].'&paso=2" class="btn btn-info">Visualizar</a></td>
                            
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