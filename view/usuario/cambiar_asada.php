<div class="page-404 padding ptb-xs-40">
    <div class="container">
        <?php 


                if(isset($_GET['nuevo'])){
                    $_SESSION["asada"] = $_POST['id_asada'];
                    echo "<script>alert('Cambiado con éxito');location.href='?pag=".$_GET['pag']."';</script>";
                }
                $sth1 = mysqli_query($link,"Call Get_Asada('".$_SESSION["asada"]."')");
                $nombre = mysqli_fetch_assoc($sth1); 
                mysqli_next_result($link);
            
        ?>
                <center><h1>Cambiar Asada </h1></center><br>
        <h3>Asada actual: <?php echo $nombre['nombre']; ?></h3><br><br>
                <form action="?pag=<?php echo $_GET['pag']; ?>&nuevo=1" method="POST" class="form-horizontal">
                    
                    
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Seleccione una nueva asada</label>  
                      <div class="col-md-4">
                          <select  name="id_asada" id="select-beast" required>
                              <option value="" >Seleccionar</option>
                            <?php 
                              $sth = mysqli_query($link,"SELECT id_asada,nombre FROM `asada` where estado = 1 ");
                                while($r = mysqli_fetch_assoc($sth)) {
                                    if ( $_SESSION["asada"] == $r['id_asada']){
                                        echo '<option value="'.$r['id_asada'].'">'.$r['nombre'].'</option>';
                                    }else{
                                        echo '<option value="'.$r['id_asada'].'" selected>'.$r['nombre'].'</option>';
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
                    </div><br><br>
                    <center><button class="btn btn-success" type="submit">Cambiar</button></center>
                </form>
        
    </div>
</div>    