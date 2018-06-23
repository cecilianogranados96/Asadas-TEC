<div class="page-404 padding ptb-xs-40">
    <div class="container">
        <!--Footer Info -->
        <div class="row text-center">
            <div class="col-sm-6 col-sm-offset-3">

                <h1><b>¿A cuál ASADA se desea conectar?</b></h1>
                <select onchange="window.location.href = '?pag=usuario/inicio&asada='+ this.value ;" class="form-control" required>
                            
                           <option value=''>Seleccionar</option>
                          <?php 
                            if (isset($_GET['asada'])){
                                $_SESSION["asada"] = $_GET['asada'];
                                echo "<script>window.location.href = '?pag=usuario/mistramites';</script>";
                            }            
                    
                              $sth = mysqli_query($link,"SELECT id_asada, nombre FROM asada");
                                while($r = mysqli_fetch_assoc($sth)) {
                                    echo "<option value='".$r['id_asada']."'>".$r['nombre']."</option>";
                                }
                          ?>
                      </select>

            </div>
        </div>
    </div>

</div>
