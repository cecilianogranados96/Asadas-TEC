<div class="page-404 padding ptb-xs-40">
    <div class="container">
        <?php 
        if(isset($_GET['eliminar'])){ 
            mysqli_query($link,"DELETE FROM `noticia` WHERE `id_noticia`  = '".$_GET['eliminar']."'");
            echo "<script>alert('Borrado con éxito');location.href='?pag=".$_GET['pag']."';</script>";
            
        }
        function generarCodigo($longitud) {
            $key = '';
            $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
            $max = strlen($pattern)-1;
            for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
            return $key;
        }
        if(isset($_GET['nuevo'])){ 
                if(isset($_GET['nuevo1'])){
                    $name = $_FILES['logo']['name'];
                    $name = str_replace(' ', '', $name);
                    $name = explode('.', $name);
                    $destino =  "uploads/noticias/".generarCodigo(6).'.'.$name[1];
                    copy($_FILES['logo']['tmp_name'],$destino);


                    mysqli_query($link,"INSERT INTO `noticia`(`titulo`, `contenido`, `imagen`, `id_asada`) VALUES ('".$_POST['titulo']."','".$_POST['contenido']."','".$destino."','".$_SESSION["asada"]."')");

                   echo "<script>alert('Insertado con éxito');location.href='?pag=".$_GET['pag']."';</script>";
                }
        ?>
                <center><h1>Nueva Noticia</h1></center>
                <form method="post" action="?pag=<?php echo $_GET['pag']; ?>&nuevo=1&nuevo1=1" class="form-horizontal" enctype="multipart/form-data">       
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Titulo</label>  
                      <div class="col-md-4">
                          <input name="titulo" type="text" placeholder="Nombre" class="form-control input-md" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Imagen</label>  
                      <div class="col-md-4">
                          <input name="logo" type="file" class="form-control input-md" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Contenido</label>  
                      <div class="col-md-4">
                          <textarea name="contenido" class="form-control"></textarea>
                      </div>
                    </div>
                    <center><button class="btn btn-success" type="submit">Enviar</button></center>
                </form>
        <?php }elseif(isset($_GET['editar'])){ 
                $sth = mysqli_query($link,"
                SELECT * FROM `noticia` where id_noticia = '".$_GET['editar']."'");
                $datos = mysqli_fetch_assoc($sth);
                                                
                                                
    
                if(isset($_GET['editar1'])){

                    if ($_FILES['logo']['name'] != ""){    
                        $name = $_FILES['logo']['name'];
                        $name = str_replace(' ', '', $name);
                        $name = explode('.', $name);
                        $destino =  "uploads/noticias/".generarCodigo(6).'.'.$name[1];
                        copy($_FILES['logo']['tmp_name'],$destino);
                        $logo = "`imagen`='".$destino."',";
                    }else{
                        $logo = ""; 
                    }
                    
                    $querry = "
                    UPDATE `noticia` SET `titulo`='".$_POST['titulo']."',$logo `contenido`=' ".$_POST['contenido']."'
                    WHERE `id_noticia`='".$_GET['editar']."'";
                    mysqli_query($link,$querry);
                    echo "<script>alert('Actualizado con éxito');location.href='?pag=".$_GET['pag']."&editar=".$_GET['editar']."';</script>";
                }
        ?>
                <center><h1>Editar Noticia</h1></center>
                <br>
                <center>
                    <img src="<?php echo $datos['imagen']; ?>"  width="20%">
                </center>
                <br>
                <form method="post" action="?pag=<?php echo $_GET['pag']; ?>&editar=<?php echo $_GET['editar']; ?>&editar1=1" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Titulo</label>  
                      <div class="col-md-4">
                          <input name="titulo" type="text" value="<?php echo $datos['titulo']; ?>" class="form-control input-md" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Imagen</label>  
                      <div class="col-md-4">
                          <input name="logo" type="file" class="form-control input-md" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="textinput">Contenido</label>  
                      <div class="col-md-4">
                          <textarea name="contenido" class="form-control"><?php echo $datos['contenido']; ?></textarea>
                      </div>
                    </div>
                    

                    <center><button class="btn btn-success" type="submit">Enviar</button></center>
                </form>
        <?php }else { ?>
                <center><h1>Noticias </h1></center>
                <center><a href="?pag=<?php echo $_GET['pag']; ?>&nuevo=1"  class="btn btn-success" href="#">Nueva Noticia </a></center>
                <br>
                <table class="table">
                  <tr class="success">
                    <th>Fecha</th>
                    <th>Titulo</th>
                    <th>Acciones</th>
                  </tr>
                <?php 
                    $consulta = "SELECT * FROM `noticia` where id_asada = '".$_SESSION["asada"]."' ORDER by `fecha` DESC";
                     
                    $sth = mysqli_query($link,$consulta);
                    
                     if (!isset($_GET["pagina"])) {
                       $inicio = 0;
                       $pagina = 1;
                    } else {
                       $inicio = ($_GET["pagina"] - 1) * $TAMANO_PAGINA;
                       $pagina = $_GET["pagina"];
                    }
                    $url= "?pag=".$_GET['pag']."";
                    $total_paginas = ceil(mysqli_num_rows($sth) / $TAMANO_PAGINA);
                    $consulta .=  " LIMIT ".$inicio."," . $TAMANO_PAGINA;
                    $sth = mysqli_query($link,$consulta);
                     
                     
                     
                     
                     
                     while($r = mysqli_fetch_assoc($sth)) {
                        echo '
                         <tr>
                            <th>'.$r['fecha'].'</th>
                            <th>'.$r['titulo'].'</th>
                            <th>
                                <a href="?pag='.$_GET['pag'].'&editar='.$r['id_noticia'].'&cerrar=1"  class="btn btn-warning" href="#">Editar</a>
                                <a href="?pag='.$_GET['pag'].'&eliminar='.$r['id_noticia'].'&cerrar=1" onclick="javascript: return confirm('."'".'¿Estas seguro?'."'".');"  class="btn btn-danger" href="#">Eliminar</a>
                            </th>
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
</div>