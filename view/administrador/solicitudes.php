<div class="page-404 padding ptb-xs-40">
    <div class="container">
            <center><h1>Solicitudes</h1></center>
            <table class="table" >
              <tr class="warning">
                <td><center><b>Número</b></center></td>
                  <td><center><b>Persona</b></center></td>
                <td><center><b>Fecha</b></center></td>
                <td><center><b>Tipo</b></center></td>
                <td><center><b>Estado</b></center></td>
                <td><center><b>Consulta</b></center></td>
              </tr>
             <?php 
                if(isset($_GET['estado'])){
                    $consulta = "Call Get_Formulario_ID_Asada_ID_Estado('".$_SESSION["asada"]."','".$_GET['estado']."') ";
                }else{
                    $consulta = "Call Get_Formulario_ID_Asada('".$_SESSION["asada"]."') ";
                }
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
                            <th>'.$r['nombre_completo'].'</th>
                            <th>'.$r['fecha'].'</th>
                            <th>'.$r['nombre'].'</th>
                            <th>'.$r['estado'].'</th>
                            <th><a class="btn btn-success" href="?pag=administrador/ver_tramite&formulario='.$r['id_formulario'].'">Consultar</a> </th>
                           </tr> 
                        ';
                }
                ?>
            </table>
            </div>
</div>
			

