<?php 


if(isset($_POST['pass1'])){
    $pass =$_POST['pass1'];
    
    
               $sth = mysqli_query($link,"Call Get_Distritos()");
                    
                                  
                                while($r = mysqli_fetch_assoc($sth)) {
                                    echo '<option value="'.$r['codigo'].'">'.$r['ubicacion'].'</option>';
                                }
                              mysqli_next_result($link);
                              mysqli_free_result($link);
    
    
    
    
    $query = "UPDATE `User` SET `password`='".md5($pass)."' WHERE `password`='".$_GET['cod']."' and username = '".$_GET['user']."'  ";
    $result = $link->query($query);

        echo "<script>window.location='?pag=general/login&error_login=10'</script>";
        exit;


}
if(!isset($_GET['cod'])){
    echo "<script>window.location='?pag=general/login&error_login=5'</script>";
}

?>

<div class="container">
    <div class="row" style="margin-top:20px">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
            <br><br>
            <form role="form" action="?pag=general/nuevo_pass&cod=<?php echo $_GET['cod']; ?>&email=<?php echo $_GET['user']; ?>" method="post">
                <fieldset>
                    <h2>Cambio la contraseña</h2>
                    <hr class="colorgraph">
                    <div class="form-group">
                        <input type="password" name="pass1" class="form-control input-lg" placeholder="Nueva contraseña" required>
                    </div>
                    <span class="button-checkbox">
				</span>
                    <hr class="colorgraph">
    
                    <br>
                      <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-3"></div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <center>
                            <a href="?pag=general/login&olvido=1" class="btn btn-lg btn-warning btn-block">Cambiar</a>
                                </center>
                        </div>
                        
                    </div>
                </fieldset>
            </form>         
        </div>
    </div>
</div>
