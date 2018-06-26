<div class="page-404 padding ptb-xs-40">
    <div class="container" >
        <center><h1>Seleccione el tramite que desea realizar</h1></center>
        <br>
        <table class="table table-striped">
          <tr class="success">
              <td><center><b>Nombre</b></center></td>
            <td><center><b>Descripción</b></center></td>
            <td><center><b>Realizar</b></center></td>
            <td><center><b>Descargar</b></center></td>
          </tr>
            <?php 
                $sth = mysqli_query($link,"SELECT id_tramite, nombre, descripcion, plantilla FROM tramite WHERE id_asada = '".$_SESSION["asada"]."' and estado_tramite = 1 ORDER BY id_tramite ASC");
                while($r = mysqli_fetch_assoc($sth)) {
                    echo '<tr>
                            <td width="30%">'.$r['nombre'].'</th>
                            <td width="50%">'.$r['descripcion'].'</th>
                            <td width="10%">
                                <a class="btn btn-success" href="?pag=usuario/llenartramite&tramite='.$r['id_tramite'].'">Realizar</a> 
                            </td>
                            <td width="10%">
                                <a class="btn btn-info" href="?pag=usuario/seleccionartramite&des='.$r['plantilla'].'">Descargar</a> 
                            </td>
                        </tr> 
                        ';
                }
            ?>
        </table>

    </div>
</div>