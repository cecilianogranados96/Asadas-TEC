<div class="page-404 padding ptb-xs-40">
    <div class="container">
        <?php 
                        $sth = mysqli_query($link,"
                        SELECT asada.logo,telefono, horario, red_social_x_asada.direccion AS link, correo.correo AS correo 
                        
                        FROM asada INNER JOIN telefono_x_asada ON asada.id_asada = '".$_SESSION["asada"]."' AND asada.id_asada = telefono_x_asada.id_asada INNER JOIN telefono ON telefono.id_telefono = telefono_x_asada.id_telefono INNER JOIN red_social_x_asada ON red_social_x_asada.id_red_social = 1 AND red_social_x_asada.id_asada = asada.id_asada INNER JOIN correo_x_asada ON correo_x_asada.id_asada = asada.id_asada INNER JOIN correo ON correo.id_correo = correo_x_asada.id_correo");


                      $r = mysqli_fetch_assoc($sth);
              
                        ?>
        <center>
            <h1>Contacto</h1>
        </center>
        <table class="table">
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
                                <?php echo $r['correo']; ?>
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
                        <a id="facebook" name="facebook" href="<?php echo $r['link']; ?>" class="fa fa-facebook"></a>
                    </center>
                </td>
            </tr>

        </table>





    </div>
</div>
