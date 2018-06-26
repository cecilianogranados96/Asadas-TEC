<div class="page-404 padding ptb-xs-40">
    <div class="container">
        <?php 
        $sth = mysqli_query($link,"CALL `Get_Formulario_ID_Formulario`('".$_GET['formulario']."')");
        $tramite = mysqli_fetch_assoc($sth);
       ?>
       <h1><center><?php echo $tramite['nombre']; ?></center></h1><br>          
          <table class="table">
                <tr>
                    <td>Fecha de la solicitud</td>
                    <td><b><?php echo $tramite['fecha']; ?></b></td>
                </tr>
                <?php 
                $datos = mysqli_fetch_assoc($sth);
                $array = json_decode($tramite['formulario'],true);
                $respuesta = json_decode($tramite['respuesta'],true);
                $identificador = 0;
                foreach ($array as $i => $value) {
                    $identificador ++;
                        echo "<tr><td>".$array[$i]["nombre"]."</td><td>".$respuesta[$i+1]."</td></tr>";
                }
                ?>
                <tr class="info">
                  <td>Estado</td>
                  <td><?php echo $tramite['estado']; ?></td>
                </tr>
             </table>
    </div>
</div>