<div class="page-404 padding ptb-xs-40">
    <div class="container">

        <?php 
        
        
            $sth = mysqli_query($link,"select * from asada where id_asada = '".$_SESSION["asada"]."'");


            $datos = mysqli_fetch_assoc($sth);
        
        
        
        function generarCodigo($longitud) {
            $key = '';
            $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
            $max = strlen($pattern)-1;
            for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
            return $key;
        }

        
        if(isset($_GET['actualizar'])){
            if ($_FILES['logo']['name'] != ""){    
                $name = $_FILES['logo']['name'];
                $name = str_replace(' ', '', $name);
                $name = explode('.', $name);
                $destino =  "uploads/logos_asadas/".generarCodigo(6).'.'.$name[1];
                copy($_FILES['logo']['tmp_name'],$destino);
                
                $logo = "`logo`='".$destino."',";
            }else{
                $logo = ""; 
            }
            
            
            $querry = "
             
            UPDATE `asada` SET 
             `nombre`='".$_POST['nombre']."',
             `cedulaJuridica`='".$_POST['cedulaJuridica']."',
             `fechaFundacion`='".$_POST['fechaFundacion']."',
             `mision`='".$_POST['mision']."',
             `vision`='".$_POST['vision']."',
             `historia`='".$_POST['historia']."',
             `direccion`='".$_POST['direccion']."',
             $logo
             `horario`='".$_POST['horario']."',
             `redes`='".$_POST['redes']."',
             `email`='".$_POST['email']."',
             `telefono`='".$_POST['telefono']."',
             `id_distrito`='".$_POST['id_distrito']."'
             WHERE `id_asada`= '".$_SESSION["asada"]."'

            ";
            mysqli_query($link,$querry);
           echo "<script>alert('Actualizado con éxito');location.href='?pag=".$_GET['pag']."';</script>";
        }
        ?>
        <center><h1>Crear Asada</h1></center>
        <br>
        <center>
            <img src="<?php echo $datos['logo']; ?>"  width="20%">
        </center>
        <br>
        <form method="post" action="?pag=<?php echo $_GET['pag']; ?>&actualizar=1" class="form-horizontal" enctype="multipart/form-data">       
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité el nombre:</label>  
              <div class="col-md-4">
                  <input name="nombre" value="<?php echo $datos['nombre']; ?>" type="text" placeholder="Título" class="form-control input-md" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Logo:</label>  
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
                            if ($datos['id_distrito'] == $r['codigo'] ){
                                echo '<option value="'.$r['codigo'].'" selected>'.$r['ubicacion'].'</option>';
                            }else{
                                echo '<option value="'.$r['codigo'].'">'.$r['ubicacion'].'</option>';
                            }
                            
                        }
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
              <label class="col-md-4 control-label" for="textinput">Digité la dirección exacta:</label>  
              <div class="col-md-4">
                  <textarea name="direccion" class="form-control"><?php echo $datos['direccion']; ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité la cédula jurídica:</label>  
              <div class="col-md-4">
                  <input name="cedulaJuridica" value="<?php echo $datos['cedulaJuridica']; ?>" id="cedula" type="text" placeholder="Cédula jurídica" class="form-control input-md" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité el correo:</label>  
              <div class="col-md-4">
                  <input name="email"  value="<?php echo $datos['email']; ?>" type="email" placeholder="Correo electrónico" class="form-control input-md" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Seleccione la fecha de fundación:</label>  
              <div class="col-md-4">
                  <input name="fechaFundacion" value="<?php echo $datos['fechaFundacion']; ?>" id="fecha" type="text" placeholder="DD/MM/AA" class="form-control input-md" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="textinput">Digité el número de teléfono:</label>  
              <div class="col-md-4">
                  <input name="telefono"  value="<?php echo $datos['telefono']; ?>" id="numero" type="text" placeholder="Número de teléfono" class="form-control input-md" required>
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
                  <input name="redes" value="<?php echo $datos['redes']; ?>" type="text" placeholder="Link" class="form-control input-md">
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

    
          <center><button class="btn btn-success" type="submit">Actualizar</button></center>
        </form>
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

    </div>
</div>
