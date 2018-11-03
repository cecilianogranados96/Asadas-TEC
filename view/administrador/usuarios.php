<div class="page-404 padding ptb-xs-40">
    <div class="container">
        <?php 
        
        if(isset($_GET['tipo'])){ 
            if($_GET['tipo'] == 1){
                $nombre = "Usuario";
                $tipo = 1;
            }
            if($_GET['tipo'] == 2){
                $nombre = "Administrador";
                $tipo = 2;
            }
            if($_GET['tipo'] == 3){
                $nombre = "Master";
                $tipo = 3;
            }
            if($_GET['tipo'] == 4){
                $nombre = "Fontanero";
                $tipo = 4;
            }
        }
        
        if(isset($_GET['eliminar'])){ 
            mysqli_query($link,"DELETE FROM `persona` WHERE `id_persona` = '".$_GET['eliminar']."'");
            echo "<script>alert('Borrado con éxito');location.href='?pag=".$_GET['pag']."&tipo=".$_GET['tipo']."';</script>";
            
        }
        if(isset($_GET['nuevo'])){ 
                if(isset($_GET['nuevo1'])){
                    mysqli_query($link,"
                    INSERT INTO `persona`(
                        `nombre`, 
                        `primerApellido`, 
                        `segundoApellido`, 
                        `direccion`, 
                        `id_distrito`
                    )VALUES (
                        '".$_POST['nombre']."',
                        '".$_POST['primerApellido']."',
                        '".$_POST['segundoApellido']."',
                        '".$_POST['direccion']."',
                        '".$_POST['id_distrito']."'
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
                        '".md5($_POST['password'])."',
                        '".$tipo."',
                        '".$_SESSION["asada"]."'
                    )");
                    echo "<script>alert('Insertado con éxito');location.href='?pag=".$_GET['pag']."&tipo=".$_GET['tipo']."';</script>";
                }
        ?>
                <center><h1>Registrar <?php echo $nombre; ?></h1></center>
                <form method="post" action="?pag=<?php echo $_GET['pag']; ?>&tipo=<?php echo $_GET['tipo']; ?>&nuevo=1&nuevo1=1" class="form-horizontal">       
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
                          <select  id="select-beast" name="id_distrito" required>
                            <option value="" selected>Seleccionar</option>
                            <?php 
                              $sth = mysqli_query($link,"Call Get_Distritos()");
                                while($r = mysqli_fetch_assoc($sth)) {
                                    echo '<option value="'.$r['codigo'].'">'.$r['ubicacion'].'</option>';
                                }
             mysqli_next_result($link);
                              ?>
                          </select>
                          
                  <script>
                    $('#select-beast').selectize({
                        create: true,
                        sortField: 'text'
                    });
                  </script>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Dirección exacta</label>  
                      <div class="col-md-4">
                          <input name="direccion" type="text" placeholder="Teléfono" class="form-control input-md" required/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Asada</label>  
                      <div class="col-md-4">
                          <select id="select-beast" name="id_asada" class="form-control"  required>
                              <option value="" selected>Seleccionar</option>
                            <?php 
             mysqli_next_result($link);
                              $sth = mysqli_query($link,"SELECT id_asada,nombre FROM `asada` ");
                                            while($r = mysqli_fetch_assoc($sth)) {
                                                echo '<option value="'.$r['id_asada'].'">'.$r['nombre'].'</option>';
                                            }
                              ?>
                          </select>
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
                <center><h1>Editar <?php echo $nombre; ?></h1></center>
                <form method="post" action="?pag=<?php echo $_GET['pag']; ?>&tipo=<?php echo $_GET['tipo']; ?>&editar=<?php echo $_GET['editar']; ?>&editar1=1" class="form-horizontal">       
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
                          <select id="select-beast"  name="id_distrito"  required>
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
                          <script>
                            $('#select-beast').selectize({
                                create: false,
                                sortField: 'text'
                            });
                          </script>
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
                <center><h1><?php echo $nombre; ?></h1></center>
                <center><a href="?pag=<?php echo $_GET['pag']; ?>&tipo=<?php echo $_GET['tipo']; ?>&nuevo=1"  class="btn btn-success" href="#">Nuevo <?php echo $nombre; ?></a></center>
                <br>
                        
        <center>
            <form action="?pag=<?php echo $_GET['pag']; ?>&tipo=<?php echo $_GET['tipo']; ?>" class="form-horizontal" style="width: 50%;" method="post">
                    <div class="col-md-3">
                        Busqueda
                    </div>
                    <div class="col-md-7">
                    <input name="querry" type="text" placeholder="Busqueda"  <?php if(isset($_POST['querry'])){ echo 'value="'.$_POST['querry'].'"';} ?> class="form-control input-md" />
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-success" type="submit">Enviar</button>
                    </div>
            </form>
        </center>
        <br><br>
        
                <table class="table">
                  <tr class="success">
                    <th>Cédula</th>
                    <th>Nombre completo</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Acciones</th>
                      <?php 
                     if ($tipo == 4){
                        echo "<th>Inventario</th>";
                        }
                      ?>
                  </tr>
                <?php 
                    $querry = "";
                     if(isset($_POST['querry'])){
                         $querry =  " and 
                         (persona.cedula like '%".$_POST['querry']."%' or
                         persona.email like '%".$_POST['querry']."%' or
                         usuario.usuario like '%".$_POST['querry']."%' or
                         persona.nombre like '%".$_POST['querry']."%' or 
                         persona.primerApellido like '%".$_POST['querry']."%' or 
                         persona.segundoApellido like '%".$_POST['querry']."%') ";
                     }
                     
                    $consulta = "SELECT persona.nombre,persona.cedula,persona.email,primerApellido,segundoApellido,persona.id_persona,usuario.id_asada, asada.nombre as asada , usuario.usuario, usuario.id_usuario from persona,usuario,asada WHERE persona.id_persona = usuario.id_persona and asada.id_asada = usuario.id_asada and usuario.tipo_usuario_id = $tipo and usuario.id_asada = '".$_SESSION["asada"]."' $querry ";
                    $sth = mysqli_query($link,$consulta);
                     
                     
                     
                     
                    if (!isset($_GET["pagina"])) {
                       $inicio = 0;
                       $pagina = 1;
                    } else {
                       $inicio = ($_GET["pagina"] - 1) * $TAMANO_PAGINA;
                       $pagina = $_GET["pagina"];
                    }
                    $url= "?pag=".$_GET['pag']."&tipo=".$tipo."";
                    $total_paginas = ceil(mysqli_num_rows($sth) / $TAMANO_PAGINA);
                    $consulta .=  " LIMIT ".$inicio."," . $TAMANO_PAGINA;
                    $sth = mysqli_query($link,$consulta);
                     
                     
                     
                     
                     
                    while($r = mysqli_fetch_assoc($sth)) {
                        echo '
                         <tr>
                        <th>'.$r['cedula'].'</th>
                            
                            <th>'.$r['nombre'].' '.$r['primerApellido'].' '.$r['segundoApellido'].'</th>
                    
                            <th>'.$r['usuario'].'</th>
                            
                            <th>'.$r['email'].'</th>
                            
                            <th>
                                <a href="?pag='.$_GET['pag'].'&tipo='.$tipo.'&editar='.$r['id_usuario'].'&cerrar=1"  class="btn btn-warning" href="#">Editar</a>
                                <a href="?pag='.$_GET['pag'].'&tipo='.$tipo.'&eliminar='.$r['id_persona'].'&cerrar=1" onclick="javascript: return confirm('."'".'¿Estas seguro?'."'".');"  class="btn btn-danger" href="#">Eliminar</a>
                            </th>';
                           if ($tipo == 4){
                        echo '<th>
                        <a href="?pag=administrador/inventario&fontanero='.$r['id_usuario'].'"  class="btn btn-info" href="#">Manejar inventario</a>
                        </th>';
                        }
                        
                          echo ' 
                          </tr>';
                    }
                ?>
                </table>
                    <center>
            <ul class="pagination">
                <?php 
                if ($total_paginas > 1) {
                    if ($pagina != 1)
                      echo ' <li><a href="'.$url.'&pagina='.($pagina-1).'">«</a></li>';
                      for ($i=1;$i<=$total_paginas;$i++) {
                         if ($pagina == $i)
                          echo "<li class='active'><a href='".$url."&pagina=".$pagina."'>$pagina<span class='sr-only'>(current)</span></a></li>";
                         else
                            echo ' <li><a href="'.$url.'&pagina='.$i.'">'.$i.'</a></li>';
                      }
                      if ($pagina != $total_paginas)
                         echo '<li><a href="'.$url.'&pagina='.($pagina+1).'">»</a></li>';
                    }
                ?>
            </ul>
            </center>
        
        <?php } ?> 
    </div>
</div>                  <script>
                    $('#select-beast').selectize({
                        create: false,
                        sortField: 'text'
                    });
                  </script>