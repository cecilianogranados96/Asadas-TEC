<div class="page-404 padding ptb-xs-40">
    <div class="container">
        <center>
            <h1>Cerrar Orden</h1>
        </center>
<?php if($_GET['step'] == 1){ 
            $destino =  "uploads/ordenes/".$_GET['formulario'].'-antes.jpg';
             if (isset($_GET["anadir"])){
                foreach($_FILES as $file){
                    copy($file['tmp_name'],$destino);
                }
                echo "<script>alert('Guardado con éxito');</script>";
             }
            if (isset($_GET["eliminar"])){

                unlink($destino);
            }
        ?>
        <!--ANTES-->
        <hr>
        <h3>Imagenes anteriores</h3>
        <?php if (file_exists($destino)){ ?>
            <center>
                <img src='<?php echo $destino; ?>' style='width: 50%;'>
                <br><br>
                <a href="?pag=<?php echo $_GET['pag']; ?>&formulario=<?php echo $_GET['formulario']; ?>&step=<?php echo $_GET['step']; ?>&eliminar=1" class="btn btn-danger" onclick="javascript: return confirm('¿Estas seguro?');">Eliminar</a>
            </center>
        <?php }else{ ?>
            <form class="form-horizontal" action="?pag=<?php echo $_GET['pag']; ?>&formulario=<?php echo $_GET['formulario']; ?>&step=<?php echo $_GET['step']; ?>&anadir=1" method="post" enctype="multipart/form-data">
                <center>
                    <br>
                    <center><b>Subir Imagen</b></center>
                    <br><br>
                    <input name="nombre" type="file" class="form-control" style="width: 24%;" required/>
                    <br><br>
                    <button class="btn btn-success" type="submit" onclick="javascript: return confirm('¿Estas seguro?');">Guardar</button>
                </center>
            </form>
        <?php } ?>
<?php } if($_GET['step'] == 2){ 
        $destino =  "uploads/ordenes/".$_GET['formulario'].'-despues.jpg';
        if (isset($_GET["anadir"])){
            foreach($_FILES as $file){
                copy($file['tmp_name'],$destino);
            }
            echo "<script>alert('Guardado con éxito');</script>";
        }
        if (isset($_GET["eliminar"])){   
            unlink($destino);
        } ?>

        <hr>
        <h3>Imagenes posteriores</h3>
        <?php if (file_exists($destino)){ ?>
            <center>
                <img src='<?php echo $destino; ?>' style='width: 50%;'>
                <br><br>
                <a href="?pag=<?php echo $_GET['pag']; ?>&formulario=<?php echo $_GET['formulario']; ?>&step=<?php echo $_GET['step']; ?>&eliminar=1" class="btn btn-danger" onclick="javascript: return confirm('¿Estas seguro?');">Eliminar</a>
            </center>
        <?php }else{ ?>
            <form class="form-horizontal" action="?pag=<?php echo $_GET['pag']; ?>&formulario=<?php echo $_GET['formulario']; ?>&step=<?php echo $_GET['step']; ?>&anadir=1" method="post" enctype="multipart/form-data">
                <center>
                    <br>
                    <center><b>Subir Imagen</b></center>
                    <br><br>
                    <input name="nombre" type="file" class="form-control" style="width: 24%;" required/>
                    <br><br>
                    <button class="btn btn-success" type="submit" onclick="javascript: return confirm('¿Estas seguro?');">Guardar</button>
                </center>
            </form>
        <?php } ?>
<?php } if($_GET['step'] == 3){?>
        <!--Firma-->
        <hr>
        <h3>Firma</h3>
        <?php 
            $destino =  "uploads/ordenes/".$_GET['formulario'].'-firma.jpg';
            if (isset($_GET["eliminar"])){   
                unlink($destino);
            }
            $sth4 = mysqli_query($link,"SELECT CONCAT(persona.nombre,' ', persona.primerApellido, ' ',persona.segundoApellido) as nombre,persona.cedula FROM formulario,persona,usuario WHERE formulario.id_usuario = usuario.id_usuario and usuario.id_usuario = persona.id_persona and formulario.id_formulario = '".$_GET['formulario']."'");
            $usuario = mysqli_fetch_assoc($sth4);  
        ?>
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
        <script type="text/javascript" src="assets/js/signature_pad.umd.js"></script>
        <style type="text/css">
            body {
                padding-top: 2%;
            }
            .signature-pad {
                position: relative;
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                -ms-flex-direction: column;
                flex-direction: column;
                font-size: 10px;
                width: 100%;
                height: 100%;
                max-width: 700px;
                max-height: 460px;

                background-color: #fff;
                padding: 16px;
            }
            .signature-pad--body {
                border: 1px solid #000000;
                position: relative;
                -webkit-box-flex: 1;
                -ms-flex: 1;
                flex: 1;
                border: 1px solid #000000;
            }
            .signature-pad--body canvas {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                border-radius: 4px;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.02) inset;
            }
        </style>
        <center>
            <?php if(file_exists($destino)){?>
                <div class='wrapper'>
                    <img src='<?php echo $destino; ?>' width=400 height=200 class='signature-pad'>
                </div><br>
                <a href="?pag=<?php echo $_GET['pag']; ?>&formulario=<?php echo $_GET['formulario']; ?>&step=<?php echo $_GET['step']; ?>&eliminar=1" class="btn btn-danger" onclick="javascript: return confirm('¿Estas seguro?');">Eliminar</a>
            <?php }else{ ?>
                    <div id='signature-pad' class='signature-pad'>
                        <div class='signature-pad--body'>
                            <canvas></canvas>
                        </div>
                        <table class="table">
                            <tr>
                                <td>
                                    <center>
                                        <button type='button' class='btn btn-warning' data-action='clear'>Limpiar</button>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <button type='button' class='btn btn-success' data-action='save-png'>Guardar</button>
                                    </center>
                                </td>
                            </tr>
                        </table>
                    </div>
                    *Al firmar la orden se cierra.
                    <script>
                        var wrapper = document.getElementById("signature-pad");
                        var clearButton = wrapper.querySelector("[data-action=clear]");
                        var savePNGButton = wrapper.querySelector("[data-action=save-png]");
                        var canvas = wrapper.querySelector("canvas");
                        var signaturePad = new SignaturePad(canvas, {
                            backgroundColor: 'rgb(255, 255, 255)'
                        });

                        function resizeCanvas() {
                            var ratio = Math.max(window.devicePixelRatio || 1, 1);
                            canvas.width = canvas.offsetWidth * ratio;
                            canvas.height = canvas.offsetHeight * ratio;
                            canvas.getContext("2d").scale(ratio, ratio);
                        }
                        resizeCanvas();
                        clearButton.addEventListener("click", function(event) {
                            signaturePad.clear();
                        });
                        savePNGButton.addEventListener("click", function(event) {
                            var dataURL = signaturePad.toDataURL();
                            //console.log(dataURL);
                            var img_data = {
                                'cnvimg': dataURL,
                                'id': '<?php echo $destino; ?>',
                                'formulario': '<?php echo $_GET['
                                formulario ']; ?>'
                            };
                            ajaxSend(img_data, 'view/fontanero/image.php', 'post', function(resp) {
                                console.log(resp);
                                alert("Guardado con exito!");
                                window.location.href = "?pag=<?php echo $_GET['pag']; ?>&formulario=<?php echo $_GET['formulario']; ?>&step=<?php echo $_GET['step']; ?>";
                            });
                        });
                        var ctx = canvas.getContext("2d");
                        ctx.font = "bold 15px sans-serif";
                        ctx.fillText("<?php echo $usuario['nombre']; ?>", 30, 30);
                        ctx.fillText("<?php echo $usuario['cedula']; ?>", 30, 50);
                        ctx.fillText("<?php echo date('Y-m-d H:i:s'); ?>", 30, 70);
                        ctx.fillText("Firmar Aquí:___________________________________________________", 30, 290);

                        function ajaxSend(data, php, via, callback) {
                            var ob_ajax = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                            var str_data = '';
                            for (var k in data) {
                                str_data += k + '=' + data[k].replace(/\?/g, '?').replace(/=/g, '=').replace(/&/g, '&').replace(/[ ]+/g, ' ') + '&'
                            }
                            str_data = str_data.replace(/&$/, ''); //delete ending &
                            ob_ajax.open(via, php, true);
                            if (via == 'post') ob_ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                            ob_ajax.send(str_data);
                            ob_ajax.onreadystatechange = function() {
                                if (ob_ajax.readyState == 4) callback(ob_ajax.responseText);
                            }
                        }
                    </script>
        <?php } ?>
<?php } if($_GET['step'] == 4){
            if (isset($_GET["anadir"])){
                    $x = 0;
                    $array_general = array();        
                    foreach($_POST["codigos"] as $key=>$value)
                    {
                        $array = array();
                        $array += [ "codigo" => $_POST["codigos"][$x] ];
                        $array += [ "cantidad" => $_POST["cantidades"][$x] ];
                        
                        $inventario = "UPDATE `inventario` SET `cantidad`= (cantidad - '".$_POST["cantidades"][$x]."') WHERE `id_inventario`= '".$_POST["codigos"][$x]."'";
                        mysqli_query($link,$inventario);
                        array_push ($array_general,$array );
                        $x++;
                    }
            
                    $querry = "
                    UPDATE `ordenes_trabajo` SET `material`= '".json_encode($array_general,JSON_UNESCAPED_UNICODE)."'  WHERE `id_formulario` = '".$_GET['formulario']."'";
                    mysqli_query($link,$querry);
                    echo "<script>alert('Insertado con éxito');location.href='?pag=".$_GET['pag']."&formulario=".$_GET['formulario']."&step=".$_GET['step']."';</script>";
                }
            $sth2 = mysqli_query($link,"SELECT * FROM `ordenes_trabajo` WHERE `id_formulario` = '".$_GET['formulario']."'");
            $orden = mysqli_fetch_assoc($sth2);  ?>
            <!--MATERIALES-->
            <form class="form-horizontal" action="?pag=<?php echo $_GET['pag']; ?>&formulario=<?php echo $_GET['formulario']; ?>&step=<?php echo $_GET['step']; ?>&anadir=1" method="post" enctype="multipart/form-data">
                <center>
                    <table class="table" id="table-data">
                        <tr>
                            <td>
                                <center><b>Material</b></center>
                            </td>
                            <td>
                                <center><b>Cantidad</b></center>
                            </td>
                            <td>
                                <center><b>Opciones</b></center>
                            </td>
                        </tr>
                        <tr id="clonedInput1" class="clonedInput">
                            <td>
                                <select id="tipo1" name="codigos[]" class="tipo form-control input-md" required>
                            <option value="">Seleccionar</option>
                            <?php 
                                $sth = mysqli_query($link,"SELECT inventario.id_inventario,inventario.id_usuario,inventario.cantidad,producto.nombre,producto.id_producto FROM inventario,producto WHERE inventario.codigo = producto.id_producto and inventario.id_usuario = '".$_SESSION["usuario"]."'");
                                while($r = mysqli_fetch_assoc($sth)) {
                                    echo '<option value="'.$r['id_inventario'].'">'.$r['nombre'].'</option>';
                                }
                            ?>
                        </select>
                            </td>
                            <td>
                                <input id="nombre" name="cantidades[]" type="text" placeholder="Cantidad" class="form-control " required/>
                            </td>
                            <td>
                                <button class="clone btn btn-success">Añadir Nuevo</button>
                                <button class="remove btn btn-danger">Eliminar</button>
                            </td>
                        </tr>
                    </table>
                    <button class="btn btn-success" type="submit" onclick="javascript: return confirm('¿Estas seguro?');">Guardar materiales</button>
                </center>
            </form>
            <h3>Materiales actualmente:</h3>
            <table class="table">
                <tr class="success">
                    <td>
                        <center>
                            <b>Código</b>
                        </center>
                    </td>
                    <td>
                        <center>
                            <b>Nombre</b>
                        </center>
                    </td>
                    <td>
                        <center>
                            <b>Cantidad</b>
                        </center>
                    </td>
                </tr>
                <?php
                if($orden['material'] != ""){
                    $array = json_decode($orden['material'],true);
                    $identificador = 0;
                    foreach ($array as $i => $value) {
                        $identificador ++;
                        $sth2 = mysqli_query($link,"SELECT inventario.id_inventario, producto.nombre FROM `inventario`,producto WHERE inventario.codigo = producto.id_producto and inventario.id_inventario = '".$array[$i]["codigo"]."'");
                        $producto = mysqli_fetch_assoc($sth2);  
                            echo "<tr class='success'>
                                    <td><center>".$producto['id_inventario']."</center></td>
                                    <td><center>".$producto['nombre']."</center></td>
                                    <td><center>".$array[$i]["cantidad"]."</center></td>
                                </tr>";        
                    }
                }
                ?>
            </table>
            <script type="text/javascript" src="//code.jquery.com/jquery-1.6.4.js"></script>
            <script type="text/javascript">
                $(window).load(function() {
                    var regex = /^(.+?)(\d+)$/i;
                    var cloneIndex = $(".clonedInput").length + 1;
                    function clone() {
                        $(this).parents(".clonedInput").clone()
                            .appendTo("table")
                            .attr("id", "clonedInput" + cloneIndex)
                            .find("*")
                            .each(function() {
                                var id = this.id || "";
                                var match = id.match(regex) || [];
                                if (match.length == 3) {
                                    this.id = match[1] + (cloneIndex);
                                }
                            })
                            .on('click', 'button.clone', clone)
                            .on('click', 'button.remove', remove);
                        cloneIndex++;
                    }
                    function remove() {
                        $(this).parents(".clonedInput").remove();
                    }
                    $("button.clone").on("click", clone);

                    $("button.remove").on("click", remove);
                });

            </script>
<?php } ?>
        </center>
    </div>
</div>
