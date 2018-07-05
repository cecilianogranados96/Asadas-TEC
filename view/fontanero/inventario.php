<div class="page-404 padding ptb-xs-40">
    <div class="container">
<center>
    <h1>Inventario</h1>
</center>

    <table class="table">
      
            <tr class="warning">
                <th>
                    <center><b>Código producto</b></center>
                </th>
                <th>
                    <center><b>Nombre</b></center>
                </th>
                
                <th>
                    <center><b>Cantidad</b></center>
                </th>   
            </tr>
                <?php 
                    $sth = mysqli_query($link,"SELECT inventario.id_inventario,inventario.id_usuario,inventario.cantidad,producto.nombre,producto.id_producto FROM inventario,producto WHERE inventario.codigo = producto.id_producto and inventario.id_usuario = '".$_SESSION["usuario"]."'");
                    while($r = mysqli_fetch_assoc($sth)) {
                        echo '
                         <tr class="success">
                            <th> <center>   '.$r['id_producto'].'   </center></th>
                            <th> <center>   '.$r['nombre'].'        </center></th>
                            <th> <center>   '.$r['cantidad'].'      </center></th>
                          </tr>';
                    }
                ?>

    </table>
    </div>
</div>



