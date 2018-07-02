<div class="page-404 padding ptb-xs-40">
    <div class="container">
        <?php         
        if(isset($_GET['eliminar'])){ 
            mysqli_query($link,"DELETE FROM `producto` WHERE `id_producto` = '".$_GET['eliminar']."'");
            echo "<script>alert('Borrado con éxito');location.href='?pag=".$_GET['pag']."';</script>";
            
        }
        if(isset($_GET['nuevo'])){ 
                if(isset($_GET['nuevo1'])){
                    mysqli_query($link,"INSERT INTO `producto`(`nombre`, `id_asada`) VALUES ('".$_POST['nombre']."','".$_SESSION["asada"]."')");
                    echo "<script>alert('Insertado con éxito');location.href='?pag=".$_GET['pag']."';</script>";
                }
        ?>
        <center>
            <h1>Nuevo Item</h1>
        </center>
        <form method="post" action="?pag=<?php echo $_GET['pag']; ?>&nuevo=1&nuevo1=1" class="form-horizontal">
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Nombre</label>
                <div class="col-md-4">
                    <input name="nombre" type="text" placeholder="Nombre" class="form-control input-md" required>
                </div>
            </div>
            <center><button class="btn btn-success" type="submit">Guardar</button></center>
        </form>
        <?php }elseif(isset($_GET['editar'])){ 
                $sth = mysqli_query($link,"SELECT * FROM `producto` WHERE `id_producto` = '".$_GET['editar']."'");
                $datos = mysqli_fetch_assoc($sth);
                if(isset($_GET['editar1'])){
            
                    mysqli_query($link,"UPDATE `producto` SET `nombre`='".$_POST['nombre']."',`id_asada`='".$_SESSION["asada"]."' WHERE `id_producto`=  '".$_GET['editar']."' ");
                    echo "<script>alert('Actualizado con éxito');location.href='?pag=".$_GET['pag']."';</script>";
                } ?>
        <center>
            <h1>Editar Item</h1>
        </center>
        <form method="post" action="?pag=<?php echo $_GET['pag']; ?>&editar=<?php echo $_GET['editar']; ?>&editar1=1" class="form-horizontal">
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Nombre</label>
                <div class="col-md-4">
                    <input name="nombre" type="text" placeholder="Nombre" value="<?php echo $datos['nombre']; ?>" class="form-control input-md" required>
                </div>
            </div>
            <center><button class="btn btn-success" type="submit">Enviar</button></center>
        </form>
        <?php }else { ?>
        <center>
            <h1>Administracion de productos de inventario</h1>
        </center>
        <center><a href="?pag=<?php echo $_GET['pag']; ?>&nuevo=1" class="btn btn-success" href="#">Nuevo Item</a></center>
        <br>
        <table class="table">

            <tr class="warning">
                <th>
                    <center><b>Codigo producto</b></center>
                </th>
                <th>
                    <center><b>Nombre</b></center>
                </th>
                <th>
                    <center><b>Acciones</b></center>
                </th>
            </tr>
            <?php 
                    $sth = mysqli_query($link,"SELECT * FROM `producto` WHERE `id_asada` = '".$_SESSION["asada"]."'");
                    while($r = mysqli_fetch_assoc($sth)) {
                        echo '
                         <tr class="success">
                            <th> <center>   '.$r['id_producto'].'   </center></th>
                            <th> <center>   '.$r['nombre'].'        </center></th>
                             <th><center>
                                <a href="?pag='.$_GET['pag'].'&editar='.$r['id_producto'].'&cerrar=1"  class="btn btn-warning">Editar</a>
                                <a href="?pag='.$_GET['pag'].'&eliminar='.$r['id_producto'].'&cerrar=1" onclick="javascript: return confirm('."'".'¿Estas seguro?'."'".');"  class="btn btn-danger">Eliminar</a>
                                </center>
                            </th>
                          </tr>';
                    }
                ?>
        </table>
        <?php } ?>
    </div>
</div>
