<div class="page-404 padding ptb-xs-40">
    <div class="container" >
        <center><h1>Seleccione el tramite que desea realizar</h1></center>
        <br>
        <table class="table table-striped">
          <tr class="warning">
              <td><center><b>Nombre</b></center></td>
            <td><center><b>Descripción</b></center></td>
            <td><center><b>Acciones</b></center></td>
          </tr>
            <?php 
        if(isset($_GET['tramite'])){ 
            mysqli_query($link,"UPDATE `tramite` SET `estado_tramite`='".$_GET['estado']."' WHERE `id_tramite`='".$_GET['tramite']."' ");
            echo "<script>location.href='?pag=".$_GET['pag']."';</script>";
        }
                $sth = mysqli_query($link,"SELECT tramite.id_tramite, tramite.nombre, tramite.descripcion, tramite.plantilla, asada.nombre as asada,tramite.estado_tramite  FROM tramite,asada WHERE asada.id_asada = tramite.id_asada  ORDER BY id_tramite,estado_tramite ASC");
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
                            <td width="50%">'.$r['descripcion'].'</th>
                            <td width="10%">'.$accion.'</td>
                        </tr> 
                        ';
                }
            ?>
        </table>

    </div>
</div>