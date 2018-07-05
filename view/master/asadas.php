

<div class="page-404 padding ptb-xs-40">
    <div class="container">
        <?php 
        
        function generarCodigo($longitud) {
            $key = '';
            $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
            $max = strlen($pattern)-1;
            for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
            return $key;
        }
        
        
        
        if(isset($_GET['asada'])){ 
            mysqli_query($link,"UPDATE `asada` SET `estado`= '".$_GET['estado']."' WHERE `id_asada`= '".$_GET['asada']."'");
            echo "<script>alert('Modificado con éxito');location.href='?pag=".$_GET['pag']."';</script>";
            
        }
        if(isset($_GET['nuevo'])){ 
                if(isset($_GET['nuevo1'])){
                    foreach($_FILES as $file){
                        $name = $file['name'];
                        $name = str_replace(' ', '', $name);
                        $name = explode('.', $name);
                        $destino =  "uploads/logos_asadas/".generarCodigo(6).'.'.$name[1];
                        copy($file['tmp_name'],$destino);
                    }
                     $querry = "     
                     INSERT INTO `asada`(
                        `nombre`, 
                        `cedulaJuridica`, 
                        `fechaFundacion`,
                        `mision`, 
                        `vision`, 
                        `historia`, 
                        `direccion`,
                        `logo`,
                        `horario`,
                        `id_distrito`,
                        redes,
                        email,
                        telefono
                    ) VALUES (
                        '".$_POST['nombre']."',
                        '".$_POST['cedulaJuridica']."',
                        '".$_POST['fechaFundacion']."',
                        '".$_POST['mision']."',
                        '".$_POST['vision']."',
                        '".$_POST['historia']."',
                        '".$_POST['direccion']."',
                        '".$destino."',
                        '".$_POST['horario']."',
                        '".$_POST['id_distrito']."',
                        '".$_POST['facebook']."',
                        '".$_POST['email']."',
                        '".$_POST['telefono']."'
                    )
                    ";
                    mysqli_query($link,$querry);
                    echo "<script>alert('Insertado con éxito');location.href='?pag=master/asada';</script>";
                }
        ?>
        <center><h1>Nueva Asada </h1></center>
            <form method="post" action="?pag=<?php echo $_GET['pag']; ?>&nuevo=1&nuevo1=1" class="form-horizontal" enctype="multipart/form-data">       
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput"> Digité el nombre:</label>  
              <div class="col-md-4">
                  <input name="nombre" type="text" placeholder="Título" class="form-control input-md" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Logo:</label>  
              <div class="col-md-4">
                  <input name="nombre" type="file" placeholder="Título" class="form-control input-md" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Seleccione el distrito:</label>  
              <div class="col-md-4">
                  <select name="id_distrito"   id="select-beast"  required>
                    <option value="" selected>Seleccionar</option>
                    <?php 
                      $sth = mysqli_query($link,"SELECT CONCAT(loc_provincia.nombre,' -> ', loc_canton.nombre ,' -> ',loc_distrito.nombre) as ubicacion, loc_distrito.id_distrito as codigo FROM loc_canton,loc_distrito,loc_provincia WHERE loc_canton.id_provincia = loc_provincia.id_provincia and loc_distrito.id_canton = loc_canton.id_canton ORDER by loc_provincia.nombre, loc_canton.nombre, loc_distrito.nombre DESC");
                        while($r = mysqli_fetch_assoc($sth)) {
                            echo '<option value="'.$r['codigo'].'">'.$r['ubicacion'].'</option>';
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
              <label class="col-md-4 control-label" for="textinput">Digité la dirección exacta:</label>  
              <div class="col-md-4">
                  <textarea name="direccion" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité la cédula jurídica:</label>  
              <div class="col-md-4">
                  <input name="cedulaJuridica" id="cedula" type="text" placeholder="Cédula jurídica" class="form-control input-md" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité el correo:</label>  
              <div class="col-md-4">
                  <input name="email" type="email" placeholder="Correo electrónico" class="form-control input-md" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Seleccione la fecha de fundación:</label>  
              <div class="col-md-4">
                  <input name="fechaFundacion" id="fecha" type="text" placeholder="DD/MM/AA" class="form-control input-md" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité el número de teléfono:</label>  
              <div class="col-md-4">
                  <input name="telefono" id="numero" type="text" placeholder="Número de teléfono" class="form-control input-md" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité el horario:</label>  
              <div class="col-md-4">
                  <textarea name="horario" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité el link de la página de Facebook:</label>  
              <div class="col-md-4">
                  <input name="facebook" type="text" placeholder="Link" class="form-control input-md">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité la historia:</label>  
              <div class="col-md-4">
                  <textarea name="historia" class="form-control"></textarea>
              </div>
            </div>    
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité la misión:</label>  
              <div class="col-md-4">
                  <textarea name="mision" class="form-control"></textarea>
              </div>
            </div>               
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité la visión:</label>  
              <div class="col-md-4">
                  <textarea name="vision" class="form-control"></textarea>
                  
              </div>
            </div>  
          <center><button class="btn btn-success" type="submit">Crear</button></center>
        </form>
        <?php }elseif(isset($_GET['editar'])){ 
                $sth = mysqli_query($link,"SELECT * from asada where id_asada = '".$_GET['editar']."'");
                $datos = mysqli_fetch_assoc($sth);
            
                if(isset($_GET['editar1'])){
                   
              
                    foreach($_FILES as $file){
                        if($file['name'] != ""){
                            $name = $file['name'];
                            $name = str_replace(' ', '', $name);
                            $name = explode('.', $name);
                            $destino =  "uploads/logos_asadas/".generarCodigo(6).'.'.$name[1];
                            copy($file['tmp_name'],$destino);
                            $logo = "`logo`='$destino',";
                        }else{
                            $logo = "";
                        }
                    }
                    
                    $consulta = "UPDATE `asada` SET 
                        `nombre`        ='".$_POST['nombre']."',
                        `cedulaJuridica`='".$_POST['cedulaJuridica']."',
                        `fechaFundacion`='".$_POST['fechaFundacion']."',
                        `mision`        ='".$_POST['mision']."',
                        `vision`        ='".$_POST['vision']."',
                        `historia`      ='".$_POST['historia']."',
                        `direccion`     ='".$_POST['direccion']."',
                        $logo
                        `horario`       ='".$_POST['horario']."',
                        `redes`         ='".$_POST['redes']."',
                        `email`         ='".$_POST['email']."',
                        `telefono`      ='".$_POST['telefono']."',
                        `id_distrito`   ='".$_POST['id_distrito']."'
                    WHERE 
                    `id_asada`='".$_GET['editar']."'";
                    
                    
                    
                    mysqli_query($link,$consulta);
                    echo "<script>alert('Actualizado con éxito');location.href='?pag=".$_GET['pag']."&editar=".$_GET['editar']."';</script>";
                }
        ?>
                <center><h1>Editar Asada</h1></center>
                <form method="post" action="?pag=<?php echo $_GET['pag']; ?>&editar=<?php echo $_GET['editar']; ?>&editar1=1" class="form-horizontal" enctype="multipart/form-data">   
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité el nombre:</label>  
              <div class="col-md-4">
                  <input name="nombre" type="text" placeholder="Título" value="<?php echo $datos['nombre']; ?>" class="form-control input-md" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Nuevo logo:</label>  
              <div class="col-md-4">
                  <input name="logo" type="file" placeholder="Título" class="form-control input-md">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Seleccione el distrito:</label>  
              <div class="col-md-4">
                  <select name="id_distrito"   id="select-beast"  required>
                    <option value="" selected>Seleccionar</option>
                    <?php 
                      $sth = mysqli_query($link,"SELECT CONCAT(loc_provincia.nombre,' -> ', loc_canton.nombre ,' -> ',loc_distrito.nombre) as ubicacion, loc_distrito.id_distrito as codigo FROM loc_canton,loc_distrito,loc_provincia WHERE loc_canton.id_provincia = loc_provincia.id_provincia and loc_distrito.id_canton = loc_canton.id_canton ORDER by loc_provincia.nombre, loc_canton.nombre, loc_distrito.nombre DESC");
                        while($r = mysqli_fetch_assoc($sth)) {
                            if ($datos['id_distrito'] == $r['codigo']){
                                echo '<option value="'.$r['codigo'].'" selected>'.$r['ubicacion'].'</option>';
                            }else{
                                echo '<option value="'.$r['codigo'].'" >'.$r['ubicacion'].'</option>';
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
              <label class="col-md-4 control-label" for="textinput">Digité la dirección exacta:</label>  
              <div class="col-md-4">
                  <textarea name="direccion" class="form-control"><?php echo $datos['direccion']; ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité la cédula jurídica:</label>  
              <div class="col-md-4">
                  <input name="cedulaJuridica" id="cedula" type="text"  value="<?php echo $datos['cedulaJuridica']; ?>" placeholder="Cédula jurídica" class="form-control input-md" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité el correo:</label>  
              <div class="col-md-4">
                  <input name="email" type="email" placeholder="Correo electrónico" value="<?php echo $datos['email']; ?>" class="form-control input-md" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Seleccione la fecha de fundación:</label>  
              <div class="col-md-4">
                  <input name="fechaFundacion" id="fecha" type="text"  value="<?php echo $datos['fechaFundacion']; ?>" placeholder="DD/MM/AA" class="form-control input-md" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité el número de teléfono:</label>  
              <div class="col-md-4">
                  <input name="telefono" id="numero" type="text" value="<?php echo $datos['telefono']; ?>" placeholder="Número de teléfono" class="form-control input-md" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité el horario:</label>  
              <div class="col-md-4">
                  <textarea name="horario" class="form-control"><?php echo $datos['horario']; ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité el link de la página de Facebook:</label>  
              <div class="col-md-4">
                  <input name="redes" type="text" placeholder="Link"  value="<?php echo $datos['redes']; ?>"class="form-control input-md">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité la historia:</label>  
              <div class="col-md-4">
                  <textarea name="historia" class="form-control"><?php echo $datos['historia']; ?></textarea>
              </div>
            </div>    
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité la misión:</label>  
              <div class="col-md-4">
                  <textarea name="mision" class="form-control"><?php echo $datos['mision']; ?></textarea>
              </div>
            </div>               
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité la visión:</label>  
              <div class="col-md-4">
                  <textarea name="vision" class="form-control"><?php echo $datos['vision']; ?></textarea>
                  
              </div>
            </div>  
          <center><button class="btn btn-success" type="submit">Guardar</button></center>
        </form>
        <?php }else { ?>
                <center><h1>Asadas</h1></center>
                <center><a href="?pag=<?php echo $_GET['pag']; ?>&nuevo=1"  class="btn btn-success" href="#">Nueva Asada</a></center>
                <br>
                <table class="table">
            <tr class="warning">
                <th>
                    <center><b>Imagen</b></center>
                </th>
                <th>
                    <center><b>Nombre</b></center>
                </th>
                
                <th>
                    <center><b>Dirección</b></center>
                </th>
                <th>
                    <center><b>Estado</b></center>
                </th> 
                <th>
                    <center><b>Acciones</b></center>
                </th>   
            </tr>
                <?php 
                    $sth = mysqli_query($link,"SELECT * FROM `asada` where id_asada != 0 order by estado DESC");
                    while($r = mysqli_fetch_assoc($sth)) {
                        if($r['estado'] == 1){
                            $estado = "Activo";
                        }else{
                            $estado = "Desactivado";
                        }
                        
                    if ($r['estado'] == 1){
                        $accion = '<a href="?pag='.$_GET['pag'].'&asada='.$r['id_asada'].'&estado=0" 
                onclick="javascript: return confirm('."'".'¿Estas seguro?'."'".');"  class="btn btn-danger" href="#">Deshabilitar</a>';
                        $clase = 'class="success"';
                    }else{
                        $accion = '<a href="?pag='.$_GET['pag'].'&asada='.$r['id_asada'].'&estado=1" 
                onclick="javascript: return confirm('."'".'¿Estas seguro?'."'".');"  class="btn btn-success" href="#">Habilitar</a>';
                        $clase = 'class="danger"';
                    }
                        
                        
                        
                        
                        echo '
                         <tr '.$clase.'>
                         <th> <center>   <img src="'.$r['logo'].'" style="width: 140px">   </center></th>
                            <th> <center>   '.$r['nombre'].'   </center></th>
                            <th> <center>   '.$r['direccion'].'        </center></th>
                            <th> <center>   '.$estado.'        </center></th>
                             <th>
                                <a href="?pag='.$_GET['pag'].'&editar='.$r['id_asada'].'&cerrar=1"  class="btn btn-warning">Editar</a>
                                '.$accion.'
                            </th>
                            
                            
                          </tr>';
                    }
                ?>
                </table>
        <?php } ?> 
    </div>
</div>

<script src="https://nosir.github.io/cleave.js/dist/cleave.min.js"></script>
<script>
    var cleave = new Cleave('#cedula', {
        prefix: '',
        delimiter: '-',
        blocks: [1, 3, 6],
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
