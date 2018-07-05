<div class="page-404 padding ptb-xs-40">
    <div class="container">

        <?php 
        
            $consulta = "SELECT 
                persona.id_persona,
                persona.cedula,
                persona.email,
                persona.nombre,
                persona.telefono,
                persona.primerApellido,
                persona.segundoApellido,
                persona.direccion,
                persona.id_distrito,
                loc_distrito.nombre as nombre_ditristo, 
                usuario.usuario,
                usuario.id_usuario,
                usuario.id_asada 
            FROM 
                `persona`,loc_distrito,usuario 
            WHERE 
                persona.id_distrito = loc_distrito.id_distrito AND persona.id_persona = usuario.id_persona AND usuario.id_usuario =  '".$_SESSION["usuario"]."'  ";
        
        
            $sth = mysqli_query($link,$consulta);


            $datos = mysqli_fetch_assoc($sth);
        

        
        if(isset($_GET['actualizar'])){

            
            if($_POST['password'] != ""){
                $pass = "contrasena = '".md5($_POST['password'])."',";
            }else{
                $pass = "";
            }
                
                
            $querry = "
             UPDATE `persona` SET 
                `cedula`='".$_POST['cedula']."',
                `email`='".$_POST['email']."',
                `nombre`='".$_POST['nombre']."',
                `primerApellido`='".$_POST['primerApellido']."',
                `segundoApellido`='".$_POST['segundoApellido']."',
                `direccion`='".$_POST['direccion']."',
                `telefono`='".$_POST['telefono']."',
                `id_distrito`='".$_POST['id_distrito']."'
             WHERE `id_persona`= '".$_SESSION["persona"]."';";
            mysqli_query($link,$querry);
            if($_SESSION["tipo"] == 3){ 
                $asada = 'id_asada';
            }else{
                $asada = "'".$_POST['id_asada']."'";
            }
            $querry1 = "UPDATE `usuario` SET `usuario`='".$_POST['usuario']."', $pass `id_asada`= ".$asada." WHERE `id_usuario`= '".$_SESSION["usuario"]."' ";
            mysqli_query($link,$querry1);
            
            
            echo "<script>alert('Actualizado con éxito');location.href='?pag=".$_GET['pag']."';</script>";
        }
        ?>
        <center><h1>Perfil</h1></center>

                       <form method="post" action="?pag=<?php echo $_GET['pag']; ?>&actualizar=1" class="form-horizontal">       
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Cédula</label>  
                      <div class="col-md-4">
                          <input name="cedula" id="cedula" type="text" placeholder="Cédula"  value="<?php echo $datos['cedula']; ?>" class="form-control input-md" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Nombre</label>  
                      <div class="col-md-4">
                          <input name="nombre" type="text" placeholder="Nombre"  value="<?php echo $datos['nombre']; ?>" class="form-control input-md" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Primer apellido</label>  
                      <div class="col-md-4">
                          <input name="primerApellido" type="text" placeholder="Primer apellido" value="<?php echo $datos['primerApellido']; ?>" class="form-control input-md" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Segundo apellido</label>  
                      <div class="col-md-4">
                          <input name="segundoApellido" type="text" placeholder="Segundo apellido" value="<?php echo $datos['segundoApellido']; ?>" class="form-control input-md" required/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Email</label>  
                      <div class="col-md-4">
                          <input name="email" type="email" placeholder="Email" value="<?php echo $datos['email']; ?>" class="form-control input-md" required/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Usuario</label>  
                      <div class="col-md-4">
                          <input name="usuario" type="text" placeholder="Usuario" value="<?php echo $datos['usuario']; ?>" class="form-control input-md" required/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Contraseña</label>  
                      <div class="col-md-4">
                          <input name="password" type="password" placeholder="Nueva Contraseña" class="form-control input-md" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Teléfono</label>  
                      <div class="col-md-4">
                          <input name="telefono" type="text" placeholder="Teléfono" value="<?php echo $datos['telefono']; ?>" class="form-control input-md" required/>
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
                                    if ($datos['id_distrito'] ==  $r['codigo']){
                                        echo '<option value="'.$r['codigo'].'" selected>'.$r['ubicacion'].'</option>';
                                    }else{
                                        echo '<option value="'.$r['codigo'].'">'.$r['ubicacion'].'</option>';
                                    }
                                }
                              ?>
                          </select>
                      </div>
                    </div>
                    <?php if($_SESSION["tipo"] != 3){ ?>
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="textinput">Asada por defecto</label>  
                          <div class="col-md-4">
                              <select name="id_asada" class="form-control"  required>
                                <option value="" selected>Seleccionar</option>
                                <?php 
                                  $sth = mysqli_query($link,"SELECT * FROM `asada` where estado = 1");
                                    while($r = mysqli_fetch_assoc($sth)) {
                                        if ($datos['id_asada'] ==  $r['id_asada']){
                                            echo '<option value="'.$r['id_asada'].'" selected>'.$r['nombre'].'</option>';
                                        }else{
                                            echo '<option value="'.$r['id_asada'].'">'.$r['nombre'].'</option>';
                                        }
                                    }
                                  ?>
                              </select>
                          </div>
                        </div>
                    <?php } ?> 
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Dirección exacta</label>  
                      <div class="col-md-4">
                          <input name="direccion"  value="<?php echo $datos['direccion']; ?>" type="text" placeholder="Dirección" class="form-control input-md" required/>
                      </div>
                    </div>
                    <center><button class="btn btn-success" type="submit">Enviar</button></center>
                </form>
<script src="https://nosir.github.io/cleave.js/dist/cleave.min.js"></script>
    <script>
        var cleave = new Cleave('#cedula', {
            prefix: '',
            delimiter: '-',
            blocks: [1, 4, 4],
            uppercase: true
        });
        var cleave2 = new Cleave('#numero', {
            prefix: '',
            delimiter: '-',
            blocks: [4, 4],
            uppercase: true
        });
        var cleave3 = new Cleave('#fecha', {
            date: true,
            datePattern: ['d','m','Y']
        });
    </script>

    </div>
</div>
