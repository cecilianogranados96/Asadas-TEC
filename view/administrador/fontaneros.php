<div class="page-404 padding ptb-xs-40">
    <div class="container">
        <?php 
        if(isset($_GET['eliminar'])){ 
            mysqli_query($link,"DELETE FROM `persona` WHERE `id_persona` = '".$_GET['eliminar']."'");
            echo "<script>alert('Borrado con éxito');location.href='?pag=master/fontaneros';</script>";
            
        }
        
        if(isset($_GET['nuevo'])){ 
                if(isset($_GET['nuevo1'])){
                    mysqli_query($link,"
                    INSERT INTO `persona`(
                        `nombre`, 
                        `primerApellido`, 
                        `segundoApellido`, 
                        `direccion`, 
                        `id_distrito`, 
                        `tipo_persona_id`
                    )VALUES (
                        '".$_POST['nombre']."',
                        '".$_POST['primerApellido']."',
                        '".$_POST['segundoApellido']."',
                        '".$_POST['direccion']."',
                        '".$_POST['id_distrito']."',
                        '4'
                    )");
                    mysqli_query($link,"
                    INSERT INTO `usuario`(
                        `id_persona`, 
                        `usuario`, 
                        `contrasena`, 
                        `tipo_usuario_id`, 
                        `id_asada`
                    ) VALUES (
                        '".mysqli_insert_id ($link)."',
                        '".$_POST['usuario']."',
                        '".$_POST['password']."',
                        4,
                        '".$_SESSION["asada"]."'
                    )");
                    echo "<script>alert('Insertado con éxito');location.href='?pag=master/fontaneros';</script>";
                }
        ?>
                <center><h1>Registrar Fontanero</h1></center>
                <form method="post" action="?pag=<?php echo $_GET['pag']; ?>&nuevo=1&nuevo1=1" class="form-horizontal">       
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Nombre</label>  
                      <div class="col-md-4">
                          <input name="nombre" type="text" placeholder="Nombre" class="form-control input-md" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Primer apellido</label>  
                      <div class="col-md-4">
                          <input name="primerApellido" type="text" placeholder="Primer apellido" class="form-control input-md" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Segundo apellido</label>  
                      <div class="col-md-4">
                          <input name="segundoApellido" type="text" placeholder="Segundo apellido" class="form-control input-md" required/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Usuario</label>  
                      <div class="col-md-4">
                          <input name="usuario" type="text" placeholder="Usuario" class="form-control input-md" required/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Contraseña</label>  
                      <div class="col-md-4">
                          <input name="password" type="password" placeholder="Contraseña" class="form-control input-md" required/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Teléfono</label>  
                      <div class="col-md-4">
                          <input name="telefono" type="text" placeholder="Teléfono" class="form-control input-md" required/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Ubicación</label>  
                      <div class="col-md-4">
                          <select name="id_distrito" class="form-control"  required>
                            <option value="" selected>Seleccionar</option>
                            <?php 
                              $sth = mysqli_query($link,"SELECT CONCAT(loc_provincia.nombre,' -> ', loc_canton.nombre ,' -> ',loc_distrito.nombre) as ubicacion, loc_distrito.id_distrito as codigo FROM loc_canton,loc_distrito,loc_provincia WHERE loc_canton.id_provincia = loc_provincia.id_provincia and loc_distrito.id_canton = loc_canton.id_canton ORDER by loc_provincia.nombre, loc_canton.nombre, loc_distrito.nombre DESC");
                                while($r = mysqli_fetch_assoc($sth)) {
                                    echo '<option value="'.$r['codigo'].'">'.$r['ubicacion'].'</option>';
                                }
                              ?>
                          </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Dirección exacta</label>  
                      <div class="col-md-4">
                          <input name="direccion" type="text" placeholder="Teléfono" class="form-control input-md" required/>
                      </div>
                    </div>
 
                    <center><button class="btn btn-success" type="submit">Enviar</button></center>
                </form>
        <?php }elseif(isset($_GET['editar'])){ 
                $sth = mysqli_query($link,"SELECT * FROM persona,usuario WHERE persona.id_persona = usuario.id_persona  and usuario.id_usuario = '".$_GET['editar']."'");
                $datos = mysqli_fetch_assoc($sth);
                                                
                                                
    
                if(isset($_GET['editar1'])){
                    
                    if ($_POST['password'] != ""){
                        $pass = "`contrasena`= '".md5($_POST['password'])."',  ";
                    }else{
                        $pass = "";
                    }
                  
                    mysqli_query($link,"
                    UPDATE `persona` SET 
                    `nombre`='".$_POST['nombre']."',
                    `primerApellido`='".$_POST['primerApellido']."',
                    `segundoApellido`='".$_POST['segundoApellido']."',
                    `direccion`='".$_POST['direccion']."',
                    `id_distrito`='".$_POST['id_distrito']."'
                    WHERE  
                    id_persona= '".$datos['id_persona']."'");
                    mysqli_query($link,"
                    UPDATE `usuario` SET `usuario`= '".$_POST['usuario']."',".$pass." `id_asada`='".$_SESSION["asada"]."' WHERE id_usuario = '".$_GET['editar']."'");
                
                    echo "<script>alert('Actualizado con éxito');location.href='?pag=master/fontaneros';</script>";
                }
        ?>
                <center><h1>Editar Fontanero</h1></center>
                <form method="post" action="?pag=<?php echo $_GET['pag']; ?>&editar=<?php echo $_GET['editar']; ?>&editar1=1" class="form-horizontal">       
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Nombre</label>  
                      <div class="col-md-4">
                          <input name="nombre" type="text" placeholder="Nombre" value="<?php echo $datos['nombre']; ?>" class="form-control input-md" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Primer apellido</label>  
                      <div class="col-md-4">
                          <input name="primerApellido" type="text" placeholder="Primer apellido" value="<?php echo $datos['primerApellido']; ?>"  class="form-control input-md" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Segundo apellido</label>  
                      <div class="col-md-4">
                          <input name="segundoApellido" type="text" placeholder="Segundo apellido" value="<?php echo $datos['segundoApellido']; ?>"  class="form-control input-md" required/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Usuario</label>  
                      <div class="col-md-4">
                          <input name="usuario" type="text" placeholder="Usuario" value="<?php echo $datos['usuario']; ?>"  class="form-control input-md" required/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Nuevo Pass</label>  
                      <div class="col-md-4">
                          <input name="password" type="password" placeholder="Dejar en blanco para mantener" class="form-control input-md"/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Teléfono</label>  
                      <div class="col-md-4">
                          <input name="telefono" type="text" placeholder="Teléfono" value="<?php echo $datos['nombre']; ?>"  class="form-control input-md" required/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Ubicación</label>  
                      <div class="col-md-4">
                          <select name="id_distrito" class="form-control"  required>
                            <option value="" selected>Seleccionar</option>
                            <?php 
                              $sth = mysqli_query($link,"SELECT CONCAT(loc_provincia.nombre,' -> ', loc_canton.nombre ,' -> ',loc_distrito.nombre) as ubicacion, loc_distrito.id_distrito as codigo FROM loc_canton,loc_distrito,loc_provincia WHERE loc_canton.id_provincia = loc_provincia.id_provincia and loc_distrito.id_canton = loc_canton.id_canton ORDER by loc_provincia.nombre, loc_canton.nombre, loc_distrito.nombre DESC");
                                while($r = mysqli_fetch_assoc($sth)) {
                                    if ($datos['id_distrito'] == $r['codigo']){
                                        echo '<option value="'.$r['codigo'].'" selected>'.$r['ubicacion'].'</option>';
                                    }else{
                                        echo '<option value="'.$r['codigo'].'">'.$r['ubicacion'].'</option>';
                                    }
                                }
                              ?>
                          </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Dirección exacta</label>  
                      <div class="col-md-4">
                          <input name="direccion" type="text" placeholder="Dirección"  value="<?php echo $datos['direccion']; ?>" class="form-control input-md" required/>
                      </div>
                    </div>

                    <center><button class="btn btn-success" type="submit">Enviar</button></center>
                </form>
        <?php }else { ?>
                <center><h1>Fontaneros</h1></center>
                <center><a href="?pag=<?php echo $_GET['pag']; ?>&nuevo=1"  class="btn btn-success" href="#">Nuevo Fontanero</a></center>
                <br>
                <table class="table">
                  <tr class="success">
                    <th>Nombre completo</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                  </tr>
                <?php 
                    $sth = mysqli_query($link,"SELECT persona.nombre,primerApellido,segundoApellido,persona.id_persona,usuario.id_asada, asada.nombre as asada , usuario.usuario, usuario.id_usuario from persona,usuario,asada WHERE persona.id_persona = usuario.id_persona and asada.id_asada = usuario.id_asada and usuario.tipo_usuario_id = 4 and usuario.id_asada = '".$_SESSION["asada"]."'");
                    while($r = mysqli_fetch_assoc($sth)) {
                        echo '
                         <tr>
                            <th>'.$r['nombre'].' '.$r['primerApellido'].' '.$r['segundoApellido'].'</th>
                            <th>'.$r['usuario'].'</th>
                            <th>
                                <a href="?pag='.$_GET['pag'].'&editar='.$r['id_usuario'].'&cerrar=1"  class="btn btn-warning" href="#">Editar</a>
                                <a href="?pag='.$_GET['pag'].'&eliminar='.$r['id_persona'].'&cerrar=1" onclick="javascript: return confirm('."'".'¿Estas seguro?'."'".');"  class="btn btn-danger" href="#">Eliminar</a>
                            </th>
                          </tr>';
                    }
                ?>
                </table>
        <?php } ?> 
    </div>
</div>