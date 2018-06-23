<div class="page-404 padding ptb-xs-40">
    <div class="container">
        <center><h1>Seleccione el tramite que desea realizar</h1></center>
					<table class="table" >
					  <tr class="success">
                        <td><center><b>Número</b></center></td>
                        <td><center><b>Fecha</b></center></td>
                        <td><center><b>Tipo</b></center></td>
                        <td><center><b>Estado</b></center></td>
                        <td><center><b>Consulta</b></center></td>
					  </tr>
				
                     <?php 
                        $sth = mysqli_query($link,"
                        SELECT 
                            id_formulario, 
                            fecha, 
                            tramite.nombre AS nombre, 
                            estado_solicitud.nombre AS estado 
                        FROM 
                            formulario INNER JOIN TRAMITE ON formulario.id_usuario = '".$_SESSION["usuario"]."' 
                            AND tramite.id_tramite = formulario.id_tramite AND tramite.id_asada = '".$_SESSION["asada"]."' 
                            INNER JOIN estado_solicitud ON estado_solicitud.id_estado_solicitud = formulario.id_estado_solicitud 
                            ORDER BY fecha ASC");
                        while($r = mysqli_fetch_assoc($sth)) {
                            echo '<tr>
                                    <th>'.$r['id_formulario'].'</th>
                                    <th>'.$r['fecha'].'</th>
                                    <th>'.$r['nombre'].'</th>
                                    <th>'.$r['estado'].'</th>
                                    <th><a class="btn btn-success" href="?pag=usuario/vertramite&asada='.$_GET['pag'].'&tramite='.$r['id_formulario'].'">Consultar</a> </th>
                                   </tr> 
                                ';
                        }
                        ?>
	</table>
    </div>
</div>
			