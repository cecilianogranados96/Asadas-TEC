

<div class="page-404 padding ptb-xs-40">
    <div class="container">
        <?php 
            $sth = mysqli_query($link,"SELECT CONCAT(persona.nombre, ' ',persona.primerApellido,' ',persona.segundoApellido ) as nombre FROM `usuario`,persona WHERE usuario.id_persona = persona.id_persona and usuario.id_usuario = '".$_GET['fontanero']."'");
            $datos = mysqli_fetch_assoc($sth);
            $nombre = $datos['nombre'];
        
        if(isset($_GET['eliminar'])){ 
            mysqli_query($link,"DELETE FROM `inventario` WHERE `id_inventario` = '".$_GET['eliminar']."'");
            echo "<script>alert('Borrado con éxito');location.href='?pag=".$_GET['pag']."&fontanero=".$_GET['fontanero']."';</script>";
            
        }
        if(isset($_GET['nuevo'])){ 
                if(isset($_GET['nuevo1'])){
                    mysqli_query($link,"INSERT INTO `inventario`(`id_usuario`, `codigo`, `cantidad`) VALUES ('".$_GET['fontanero']."','".$_POST['codigo']."', '".$_POST['cantidad']."')");
                    echo "<script>alert('Insertado con éxito');location.href='?pag=".$_GET['pag']."&fontanero=".$_GET['fontanero']."';</script>";
                }
        ?>
                <center><h1>Nuevo Item de Inventario</h1><h5><?php echo $nombre; ?></h5></center>
                <form method="post" action="?pag=<?php echo $_GET['pag']; ?>&fontanero=<?php echo $_GET['fontanero']; ?>&nuevo=1&nuevo1=1" class="form-horizontal">        
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Item</label>  
                      <div class="col-md-4">
                          <select  id="select-beast" name="codigo" required>
                            <option value="" selected>Seleccionar</option>
                            <?php 
                              $sth = mysqli_query($link,"SELECT * FROM `producto` WHERE `id_asada` = '".$_SESSION["asada"]."'");
                                while($r = mysqli_fetch_assoc($sth)) {
                                    echo '<option value="'.$r['id_producto'].'">'.$r['nombre'].'</option>';
                                }
                              ?>
                          </select>
                          <script>
                            $('#select-beast').selectize({ create: true, sortField: 'text' });
                          </script>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Cantidad</label>  
                      <div class="col-md-4">
                          <input name="cantidad" type="text" placeholder="Cantidad" class="form-control input-md" required>
                      </div>
                    </div>
              
                    <center><button class="btn btn-success" type="submit">Guardar</button></center>
                </form>
        <?php }elseif(isset($_GET['editar'])){ 
                $sth = mysqli_query($link,"SELECT inventario.id_inventario,inventario.id_usuario,inventario.cantidad,producto.nombre,producto.id_producto FROM inventario,producto WHERE inventario.codigo = producto.id_producto and inventario.id_inventario = '".$_GET['editar']."'");
                $datos = mysqli_fetch_assoc($sth);
                if(isset($_GET['editar1'])){
                    mysqli_query($link,"UPDATE `inventario` SET `cantidad`='".$_POST['cantidad']."' WHERE `id_inventario`='".$_POST['id_inventario']."' ");
                    echo "<script>alert('Actualizado con éxito');location.href='?pag=".$_GET['pag']."&fontanero=".$_GET['fontanero']."';</script>";
                }
        ?>
                <center><h1>Editar Inventario</h1><h5><?php echo $nombre; ?></h5></center>
                <form method="post" action="?pag=<?php echo $_GET['pag']; ?>&fontanero=<?php echo $_GET['fontanero']; ?>&editar=<?php echo $_GET['editar']; ?>&editar1=1" class="form-horizontal">       
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Código</label>  
                      <div class="col-md-4">
                          <input name="id_inventario" type="text" placeholder="ID Producto" value="<?php echo $datos['id_inventario']; ?>" class="form-control input-md" required readonly>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Nombre</label>  
                      <div class="col-md-4">
                          <input name="nombre" type="text" placeholder="Nombre" value="<?php echo $datos['nombre']; ?>" class="form-control input-md" required disabled>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Cantidad</label>  
                      <div class="col-md-4">
                          <input name="cantidad" type="text" placeholder="Cantidad" value="<?php echo $datos['cantidad']; ?>"  class="form-control input-md" required>
                      </div>
                    </div>
                   
    
                    <center><button class="btn btn-success" type="submit">Enviar</button></center>
                </form>
        <?php }else { ?>
                <center><h1>Inventario</h1><h5><?php echo $nombre; ?></h5></center>
                <center><a href="?pag=<?php echo $_GET['pag']; ?>&fontanero=<?php echo $_GET['fontanero']; ?>&nuevo=1"  class="btn btn-success" href="#">Nuevo Item</a></center>
                <br>
                <table class="table">
      
            <tr class="warning">
                <th>
                    <center><b>Código producto</b></center>
                </th>
                <th>
                    <center><b>Nombre</b></center>
                </th>
                
                <th>
                    <center><b>Cantidad</b></center>
                </th>
                <th>
                    <center><b>Acciones</b></center>
                </th>   
            </tr>
                <?php 
                    $sth = mysqli_query($link,"SELECT inventario.id_inventario,inventario.id_usuario,inventario.cantidad,producto.nombre,producto.id_producto FROM inventario,producto WHERE inventario.codigo = producto.id_producto and inventario.id_usuario = '".$_GET["fontanero"]."'");
                    while($r = mysqli_fetch_assoc($sth)) {
                        echo '
                         <tr class="success">
                            <th> <center>   '.$r['id_producto'].'   </center></th>
                            <th> <center>   '.$r['nombre'].'        </center></th>
                            <th> <center>   '.$r['cantidad'].'      </center></th>
                             <th>
                                <a href="?pag='.$_GET['pag'].'&fontanero='.$_GET['fontanero'].'&editar='.$r['id_inventario'].'&cerrar=1"  class="btn btn-warning">Editar</a>
                                <a href="?pag='.$_GET['pag'].'&fontanero='.$_GET['fontanero'].'&eliminar='.$r['id_inventario'].'&cerrar=1" onclick="javascript: return confirm('."'".'¿Estas seguro?'."'".');"  class="btn btn-danger">Eliminar</a>
                            </th>
                            
                            
                          </tr>';
                    }
                ?>
                </table>
        <?php } ?> 
    </div>
</div>


