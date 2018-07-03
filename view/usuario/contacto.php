<div class="page-404 padding ptb-xs-40">
    <div class="container">
        <?php 
            $sth = mysqli_query($link," CALL `Get_Asada`('".$_SESSION["asada"]."')");
            $r = mysqli_fetch_assoc($sth);
        ?>
        <center>
            <h1>Contacto</h1>
        </center><hr><br>
        <table>
            <tr>

                <td>
                    <table class="table" border="0">
                        <tr>
                            <th scope="row">Teléfono</th>
                            <td>
                                <?php echo $r['telefono']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Correo electrónico</th>
                            <td>
                                <?php echo $r['email']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Horario de oficinas</th>
                            <td>
                                <?php echo $r['horario']; ?>
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <center>
                        <img src="<?php echo $r['logo']; ?>" width="65%"><br><br> Redes sociales<br>
                        <a id="facebook" name="facebook" href="<?php echo $r['redes']; ?>" class="fa fa-facebook"></a>
                    </center>
                </td>
            </tr>
        </table>
        <div class="row">
            <div class="col-sm-6 pb-xs-30">
                <h4>Misión</h4>
                <ul class="list">
                    <li>
                        <?php echo $r['mision']; ?>
                    </li>
                </ul>
            </div>
            <div class="col-sm-6">
                <h4>Visión</h4>
                <ul class="list">
                    <li>
                        <?php echo $r['vision']; ?>
                    </li>
                </ul>
            </div>
            <div class="col-sm-12">
                <h4>Historia</h4>
                <ul class="list">
                    <li>
                        <?php echo $r['historia']; ?>
                    </li>
                </ul>
            </div>
        </div>
        
        <br><hr><br>
        
        <center><h1>Junta Directiva</h1></center><br>
         <div class="row">
            <?php 
                 mysqli_next_result($link);
                $sth = mysqli_query($link,"SELECT puesto_x_junta_directiva.id_puesto_x_junta_directiva,puesto_x_junta_directiva.nombre, puesto.nombre as puesto FROM `puesto_x_junta_directiva`,puesto WHERE puesto_x_junta_directiva.id_puesto = puesto.id_puesto and puesto_x_junta_directiva.id_asada = '".$_SESSION["asada"]."' order by puesto.id_puesto ");
                while($r = mysqli_fetch_assoc($sth)) {
                    echo '<div class="col-sm-4"><h4>'.$r['puesto'].'</h4>
                    <ul class="list">
                        <li>'.$r['nombre'].'</li>
                    </ul>
                    </div>';
                }
            ?>
        </div>
        
        
        
        
        
    </div>
</div>