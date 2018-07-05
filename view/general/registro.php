<div class="page-404 padding ptb-xs-40">
    <div class="container">
        <?php 


                if(isset($_GET['nuevo'])){
                    mysqli_query($link,"
                    INSERT INTO `persona`(
                    cedula,
                    email,
                        `nombre`, 
                        `primerApellido`, 
                        `segundoApellido`, 
                        `direccion`, 
                        `id_distrito`
                    )VALUES (
                        '".$_POST['cedula']."',
                        '".$_POST['email']."',
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
                        `contrasena`
                        `id_asada`
                    ) VALUES (
                        '".mysqli_insert_id ($link)."',
                        '".$_POST['usuario']."',
                        '".md5($_POST['password'])."'
                        '".$_POST['id_asada']."'
                    )");
                    echo "<script>alert('Registro con éxito');location.href='?pag=general/login';</script>";
                }
        ?>
                <center><h1>Registrarse </h1></center>
                <form action="?pag=<?php echo $_GET['pag']; ?>&nuevo=1" method="POST" class="form-horizontal">
                    
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Cédula</label>  
                      <div class="col-md-4">
                          <input name="cedula" id='cedula' type="text" placeholder="Cédula"  onchange="datos(this.value);" class="form-control input-md" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Nombre</label>  
                      <div class="col-md-4">
                          <input name="nombre" id="nombre" type="text" placeholder="Nombre" class="form-control input-md" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Primer apellido</label>  
                      <div class="col-md-4">
                          <input name="primerApellido" id="primerApellido" type="text" placeholder="Primer apellido" class="form-control input-md" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Segundo apellido</label>  
                      <div class="col-md-4">
                          <input name="segundoApellido" id="segundoApellido" type="text" placeholder="Segundo apellido" class="form-control input-md" required/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Email</label>  
                      <div class="col-md-4">
                          <input name="email" type="text" placeholder="Email" class="form-control input-md" required/>
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
                          <input name="telefono" id='telefono' type="text" placeholder="Teléfono" class="form-control input-md" required/>
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
                              mysqli_free_result($link);
                              
                              
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
                          <input name="direccion" type="text" placeholder="Dirección exacta" class="form-control input-md" required/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Asada</label>  
                      <div class="col-md-4">
                          <select  name="id_asada" class="form-control"  required>
                              <option value="" selected>Seleccionar</option>
                            <?php 
                              $sth = mysqli_query($link,"SELECT id_asada,nombre FROM `asada` ");
                                            while($r = mysqli_fetch_assoc($sth)) {
                                                echo '<option value="'.$r['id_asada'].'">'.$r['nombre'].'</option>';
                                            }
                              ?>
                          </select>
                 
                      </div>
                    </div>
                    <center><button class="btn btn-success" type="submit">Registrarse</button></center>
                </form>
        
    </div>
</div>          
<script src="https://nosir.github.io/cleave.js/dist/cleave.min.js"></script>
    
    <script src="assets/js/fss.min.js"></script>
    <script src="https://nosir.github.io/cleave.js/dist/cleave.min.js"></script>
    <script src="assets/js/firebase.js"></script>
    <script>
        var config = {
            apiKey: "AIzaSyAYOuDY8ylH0RbQyTPOpyuQoNH3oEJpfk8",
            authDomain: "padron-79f32.firebaseapp.com",
            databaseURL: "https://padron-79f32.firebaseio.com",
            projectId: "padron-79f32",
            storageBucket: "padron-79f32.appspot.com",
            messagingSenderId: "859813990886"
        };
        firebase.initializeApp(config);
        var db = firebase.database();
        function ucwords(str) {
            return (str + '')
                .replace(/^([a-z\u00E0-\u00FC])|\s+([a-z\u00E0-\u00FC])/g, function($1) {
                    return $1.toUpperCase();
                });
        }
        function datos(cedula) {
            var refe = db.ref("app/datos/padron/" + cedula.replace("-", "").replace("-", ""));
            refe.on("value", function(snapshot) {
                var snap = snapshot.val();
                if (snap) {
                    db.ref("app/datos/code/" + snap.code).on("value", function(snapshot) {
                        var code = snapshot.val();
                        sum = $.extend(snap, code);
                        console.log(sum);
                        
                        var nombre = sum.nombre;
                        var apellido1 = sum.apellido;
                        var apellido2 = sum.apellid;

                        document.getElementById('nombre').value = ucwords(nombre.trim().toLowerCase());
                        document.getElementById('primerApellido').value = ucwords(apellido1.trim().toLowerCase());
                        document.getElementById('segundoApellido').value = ucwords(apellido2.trim().toLowerCase());
                        
                        $('#nombre').prop('readonly', true);
                        $('#primerApellido').prop('readonly', true);
                        $('#segundoApellido').prop('readonly', true);

                    });
                } else {
                    //NO SE ENCUENTR    
                }
            });
        }

        var cleave = new Cleave('#cedula', {
            prefix: '',
            delimiter: '-',
            blocks: [1, 4, 4],
            uppercase: true
        });
        var cleave2 = new Cleave('#telefono', {
            prefix: '',
            delimiter: '-',
            blocks: [4, 4],
            uppercase: true
        });
             </script>