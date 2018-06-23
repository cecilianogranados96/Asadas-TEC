<?php 

if(isset($_GET['recuperar'])){
    $user =$_POST['email'];
    $query = "SELECT * FROM User WHERE email = '$user' or username  = '$user' ";
    $result = $link->query($query);
    $usuario_datos = $result->fetch_array(MYSQLI_ASSOC);
 
	if ($result->num_rows != 0)
    {
                   
                enviar_email(
                    $usuario_datos['email'],
                    "Cambio de password",
                    "Ha solicitdado un cambio de contraseña para esto solamente has click en el enlace, si no fue usted el que pidio el cambio de contraseña, haga caso omiso de este email.",
                    "https://radar.pet/?pag=general/nuevo_pass&cod=".$usuario_datos['password']."&user=".$usuario_datos['username']."",
                    "Cambiar Password"
                );
                echo "<script languaje='JavaScript'>alert('Se envio un correo, verifica tu email.'); </script>";
        
                echo "<script>window.location='?pag=general/login&error_login=9'</script>";
        
        
                exit;
    }else{
     echo "<script>window.location='?pag=general/login&error_login=5'</script>";
    }
}

?>

<div class="container">
    <div class="row" style="margin-top:20px">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
        <?php if(isset($_GET['error_login'])){
            if ($_GET['error_login'] == 0)
                echo "<div class='btn btn-lg btn-danger btn-block'>Error en la base de datos</div>";
            if ($_GET['error_login'] == 1)
                echo "<div class='btn btn-lg btn-danger btn-block'>Error en el usuario</div>";
            if ($_GET['error_login'] == 2)
                echo "<div class='btn btn-lg btn-danger btn-block'>Error en la contraseña</div>";             
             if ($_GET['error_login'] == 5)
                echo "<div class='btn btn-lg btn-danger btn-block'>No autorizado</div>";    
            if ($_GET['error_login'] == 6)
                echo "<div class='btn btn-lg btn-success btn-block'>Inicia session - Registrado con éxito!</div>"; 
            if ($_GET['error_login'] == 7)
                echo "<div class='btn btn-lg btn-danger btn-block'>Usuario registrado con anterioridad - Recupera la contraseña!</div>"; 
            if ($_GET['error_login'] == 8)
                echo "<div class='btn btn-lg btn-info btn-block'>Registrate es simple y facil!</div>"; 
            if ($_GET['error_login'] == 9)
                echo "<div class='btn btn-lg btn-info btn-block'>Se envio un correo, verifica tu email.</div>"; 
            if ($_GET['error_login'] == 10)
                echo "<div class='btn btn-lg btn-success btn-block'>Contraseña Cambiada con éxito - Inicia sesión.</div>"; 
    
        }
        ?>
            <br><br>
            
            
            <?php if(!isset($_GET['olvido'])){ ?>
            <form role="form" action="?pag=general/aut_verifica" method="post">
                <fieldset>
                    <h2>Ingreso</h2>
                    <hr class="colorgraph">
                    <div class="form-group">
                        <input type="text" name="email" id="email" class="form-control input-lg" placeholder="Usuario" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Contraseña" required>
                    </div>
                    <span class="button-checkbox">
				</span>
                    <hr class="colorgraph">
                    <div class="row">

                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <a href="?pag=general/registro" class="btn btn-lg btn-primary btn-block">Registrarse</a>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <input type="submit" class="btn btn-lg btn-success btn-block" value="Ingresar">
                        </div>
                    </div>
                    <br>
                      <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3"></div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <center>
                            <a href="?pag=general/login&olvido=1" class="btn btn-lg btn-warning btn-block">Olvidé la contraseña</a>
                                </center>
                        </div>
                        
                    </div>
                </fieldset>
            </form>
            
             <?php }else{ ?>
            
            
            <form role="form" action="?pag=general/login&olvido=1&recuperar=1" method="post">
                <fieldset>
                    <h2>Olvido la contraseña</h2>
                    <hr class="colorgraph">
                    <div class="form-group">
                        <input type="text" name="email" id="email" class="form-control input-lg" placeholder="Nombre de usuario o email" required>
                    </div>
            
                    <span class="button-checkbox">
				</span>
                    <hr class="colorgraph">
                 
                    
                      <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3"></div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <center>
                            <input type="submit" class="btn btn-lg btn-warning btn-block" value="Recuperar contraseña">
                                </center>
                        </div>
                        
                    </div>
                </fieldset>
            </form>
            
            
            
            
              <?php } ?>
            
            
            
            <hr class="colorgraph">
            <div class="social-box">
                <div class="row mg-btm">
                    <div class="col-md-12">
                        <a href="<?php echo htmlspecialchars($loginUrl); ?>" class="btn btn-primary btn-block"><i class="icon-facebook"></i>Ingresar con Facebook</a>
                    </div>
                </div>
            </div>            
        </div>
        
        
        
        
    </div>
</div>
