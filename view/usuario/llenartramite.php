<div class="page-404 padding ptb-xs-40">
    <div class="container">
 <?php 
        $sth = mysqli_query($link,"SELECT id_tramite, nombre, descripcion, plantilla, requisitos FROM tramite WHERE id_tramite= '".$_GET['tramite']."' ");
        $tramite = mysqli_fetch_assoc($sth);
?>
                        
        

                <div id="titulo" class="texto-titulo"><?php echo $tramite['nombre']; ?></div>
                <br>
                <div id="descripcion" class="texto-descripcion"><?php echo $tramite['descripcion']; ?></div>
                <br>
                <div id="campos">
                <?php 
                        $sth = mysqli_query($link,"SELECT id_campo, nombre FROM campo WHERE campo.id_tramite = '".$_GET['tramite']."' ORDER BY id_campo ASC");
                        while($r = mysqli_fetch_assoc($sth)) {
                            echo '<input type="text" id="'.$r['id_campo'].'" placeholder="'.$r['nombre'].'"/><br>';
                        }
                ?>
                        
                </div>
                <dl>
                    <dt>Los requisitos para este trámite son: </dt>
                    <dt id="requisitos"><?php echo $tramite['requisitos']; ?></dt>
                </dl>

                <br>
                <div class="formulario-buttons">
                    <a id="guardar" href="mistramites.html" class="azul-bttn-little">Enviar Formulario</a>
                </div>
                <br>
                <br>
    </div>
</div>
