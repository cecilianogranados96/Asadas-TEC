<div class="page-404 padding ptb-xs-40">
    <div class="container">
        <?php 
            $sth = mysqli_query($link," CALL `Get_Asada`('".$_SESSION["asada"]."')");
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
    </div>
</div>