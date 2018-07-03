<div class="page-404 padding ptb-xs-40">
    <div class="container">
        <?php 
        if(isset($_GET['eliminar'])){ 
            mysqli_query($link,"DELETE FROM `puesto_x_junta_directiva` WHERE `id_puesto_x_junta_directiva` = '".$_GET['eliminar']."'");
            echo "<script>alert('Borrado con éxito');location.href='?pag=".$_GET['pag']."';</script>";
            
        }
        if(isset($_GET['nuevo'])){ 
                if(isset($_GET['nuevo1'])){
                    mysqli_query($link,"
                    
                    INSERT INTO `puesto_x_junta_directiva`(`id_puesto`, `id_asada`, `nombre`) VALUES (
                     '".$_POST['id_puesto']."',
                      '".$_SESSION["asada"]."',
                       '".$_POST['nombre']."'
                    )");

                    echo "<script>alert('Insertado con éxito');location.href='?pag=".$_GET['pag']."';</script>";
                }
        ?>
                <center><h1>Registrar Junta Directiva</h1></center>
                <form method="post" action="?pag=<?php echo $_GET['pag']; ?>&nuevo=1&nuevo1=1" class="form-horizontal">       
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Nombre</label>  
                      <div class="col-md-4">
                          <input name="nombre" type="text" placeholder="Nombre" class="form-control input-md" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Puesto</label>  
                      <div class="col-md-4">
                          <select name="id_puesto" class="form-control"  required>
                            <option value="" selected>Seleccionar</option>
                            <?php 
                              $sth = mysqli_query($link,"SELECT * FROM `puesto`");
                                while($r = mysqli_fetch_assoc($sth)) {
                                    echo '<option value="'.$r['id_puesto'].'">'.$r['nombre'].'</option>';
                                }
                              ?>
                          </select>
                      </div>
                    </div>

                    <center><button class="btn btn-success" type="submit">Enviar</button></center>
                </form>
        <?php }elseif(isset($_GET['editar'])){ 
                $sth = mysqli_query($link,"
                
                SELECT puesto_x_junta_directiva.id_puesto_x_junta_directiva,puesto_x_junta_directiva.nombre, puesto.nombre as puesto,puesto_x_junta_directiva.id_puesto FROM `puesto_x_junta_directiva`,puesto WHERE puesto_x_junta_directiva.id_puesto = puesto.id_puesto and puesto_x_junta_directiva.id_asada = '".$_SESSION["asada"]."' AND puesto_x_junta_directiva.id_puesto_x_junta_directiva = '".$_GET['editar']."'");
                $datos = mysqli_fetch_assoc($sth);
                                                
                                                
    
                if(isset($_GET['editar1'])){

                  
                    mysqli_query($link,"
                    
                    UPDATE `puesto_x_junta_directiva` SET 
                    `id_puesto`='".$_POST['id_puesto']."',
                    `nombre`='".$_POST['nombre']."'
                    WHERE id_puesto_x_junta_directiva = '".$_GET['editar']."'");
                   
                    echo "<script>alert('Actualizado con éxito');location.href='?pag=".$_GET['pag']."';</script>";
                }
        ?>
                <center><h1>Editar Junta Directiva</h1></center>
                <form method="post" action="?pag=<?php echo $_GET['pag']; ?>&editar=<?php echo $_GET['editar']; ?>&editar1=1" class="form-horizontal">       
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Nombre</label>  
                      <div class="col-md-4">
                          <input name="nombre" type="text" placeholder="Nombre" value="<?php echo $datos['nombre']; ?>" class="form-control input-md" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Ubicacion</label>  
                      <div class="col-md-4">
                          <select name="id_puesto" class="form-control"  required>
                            <option value="" selected>Seleccionar</option>
                            <?php 
                             $sth = mysqli_query($link,"SELECT * FROM `puesto`");
                                while($r = mysqli_fetch_assoc($sth)) {
                                    if ($datos['id_puesto'] == $r['id_puesto']){
                                        echo '<option value="'.$r['id_puesto'].'" selected>'.$r['nombre'].'</option>';
                                    }else{
                                        echo '<option value="'.$r['id_puesto'].'">'.$r['nombre'].'</option>';
                                    }
                                }
                              ?>
                          </select>
                      </div>
                    </div>
                    <center><button class="btn btn-success" type="submit">Enviar</button></center>
                </form>
        <?php }else { ?>
                <center><h1>Junta Directiva</h1></center>
                <center><a href="?pag=<?php echo $_GET['pag']; ?>&nuevo=1"  class="btn btn-success" href="#">Nuevo Puesto </a></center>
                <br>
                <table class="table">
                  <tr class="success">
                    <th>Nombre completo</th>
                    <th>Posicion</th>
                    <th>Acciones</th>
                  </tr>
                <?php 
                    $sth = mysqli_query($link,"SELECT puesto_x_junta_directiva.id_puesto_x_junta_directiva,puesto_x_junta_directiva.nombre, puesto.nombre as puesto FROM `puesto_x_junta_directiva`,puesto WHERE puesto_x_junta_directiva.id_puesto = puesto.id_puesto and puesto_x_junta_directiva.id_asada = '".$_SESSION["asada"]."' order by puesto.id_puesto ");
                    while($r = mysqli_fetch_assoc($sth)) {
                        echo '
                         <tr>
                            <th>'.$r['nombre'].'</th>
                            <th>'.$r['puesto'].'</th>
                            <th>
                                <a href="?pag='.$_GET['pag'].'&editar='.$r['id_puesto_x_junta_directiva'].'&cerrar=1"  class="btn btn-warning" href="#">Editar</a>
                                <a href="?pag='.$_GET['pag'].'&eliminar='.$r['id_puesto_x_junta_directiva'].'&cerrar=1" onclick="javascript: return confirm('."'".'¿Estas seguro?'."'".');"  class="btn btn-danger" href="#">Eliminar</a>
                            </th>
                          </tr>';
                    }
                ?>
                </table>
        <?php } ?> 
    </div>
</div>