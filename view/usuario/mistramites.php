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
                        $sth = mysqli_query($link,"call Get_Formulario_Usuario('".$_SESSION["usuario"]."')");
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
    </div>
</div>
			