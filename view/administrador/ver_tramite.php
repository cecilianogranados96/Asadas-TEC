<div class="page-404 padding ptb-xs-40">
    <div class="container">
        

            <?php
        
                  if (isset($_GET["actualizar"])){
     



                $querry = "UPDATE `formulario` SET `id_estado_solicitud`='".$_GET['actualizar']."' WHERE `id_formulario`='".$_GET['formulario']."'";
                mysqli_query($link,$querry);
                echo "<script>alert('Actualizado con éxito');location.href='?pag=".$_GET['pag']."&formulario=".$_GET['formulario']."';</script>";
            }
        
        
                $sth1 = mysqli_query($link,"SELECT formulario.fecha, formulario.id_tramite,formulario.respuesta, tramite.nombre,tramite.formulario,formulario.id_estado_solicitud as id_estado, estado_solicitud.nombre as estado from formulario,tramite,estado_solicitud where formulario.id_tramite = tramite.id_tramite and formulario.id_estado_solicitud = estado_solicitud.id_estado_solicitud and formulario.id_formulario = '".$_GET['formulario']."'");
                $tramite = mysqli_fetch_assoc($sth1);        
            ?>
            <h1><center><?php echo $tramite['nombre']; ?></center></h1><br>  

        <h3>Cambiar estado de la Solicitud</h3>
         <table class="table">
             
                <tr class="warning">        
       <?php
                $querry = mysqli_query($link,"Call Get_Estado_Solicitud()");

                while($datos = mysqli_fetch_assoc($querry)) {
                    if ($datos['id_estado_solicitud'] == 1){
                        $clase = 'info';
                    }
                    if ($datos['id_estado_solicitud'] == 2){
                        $clase = 'success';
                    }
                    if ($datos['id_estado_solicitud'] == 3){
                        $clase = 'danger';
                    }
                    
                echo '
                <td><center>
                <a href="?pag='.$_GET['pag'].'&formulario='.$_GET['formulario'].'&actualizar='.$datos['id_estado_solicitud'].'" 
                onclick="javascript: return confirm('."'".'¿Estas seguro?'."'".');"  class="btn btn-'.$clase.'" href="#">'.$datos['nombre'].'</a>
                </center>
                </td>';
                }
                    if ($tramite['id_estado']  == 1){
                        $clase = 'info';
                    }
                    if ($tramite['id_estado']  == 2){
                        $clase = 'success';
                    }
                    if ($tramite['id_estado']  == 3){
                        $clase = 'danger';
                    }  
                 ?>
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
                        echo "<tr><td>".$array[$i]["nombre"]."</td><td>".$respuesta[$i+1]."</td></tr>";
                } 
                ?>
                

            </table>
        
     
    </div>
</div>
			

