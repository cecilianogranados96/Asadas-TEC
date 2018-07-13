<div class="page-404 padding ptb-xs-40">
    <div class="container">
        <?php 
            if (isset($_POST["nombre"])){
                $x = 0;
                $array_general = array();
                
                
                foreach($_FILES as $file){
                    $name = $file['name'];
                    $name = str_replace(' ', '', $name);
                    $name = explode('.', $name);
                    $destino =  "uploads/tramites/".substr($file['tmp_name'], -6).'.'.$name[1];
                    copy($file['tmp_name'],$destino);
                }
                
                
                foreach($_POST["nombre"] as $key=>$value)
                {
                    $array = array();
                    $array += [ "nombre" => $_POST["nombre"][$x] ];
                    $array += [ "tipo" => $_POST["tipo"][$x] ];
                    $array += [ "requerido" => $_POST["requerido"][$x] ];
                    if (isset($_POST["campo"][$x])){
                        $array += [ "campo" => $_POST["campo"][$x] ];
                    }else{
                        $array += [ "campo" => "ninguno" ];

                    }
                    if (isset($_POST["opciones"][$x])){
                        $array += [ "opciones" => explode(",", $_POST["opciones"][$x]) ];
                    }else{
                         $array += [ "opciones" => "ninguno" ];
                    }   

                    array_push ($array_general,$array );
                    $x++;
                }
                $querry = "
                INSERT INTO `tramite`(
                    `nombre`,
                    `descripcion`, 
                    `requisitos`, 
                    `plantilla`, 
                    `formulario`, 
                    `id_asada`
                )VALUES (
                    '".$_POST['nombre_tramite']."',
                    '".$_POST['descripcion']."',
                    '".$_POST['requisitos']."',
                    '$destino',
                    '".json_encode($array_general,JSON_UNESCAPED_UNICODE)."',
                    '".$_SESSION["asada"]."'
                )";
                mysqli_query($link,$querry);
                echo "<script>alert('Insertado con éxito');location.href='?pag=".$_GET['pag']."';</script>";
            }
        ?>
        
        <center>
            <h1>Crear formulario</h1>
        </center>
        <form class="form-horizontal" action="?pag=<?php echo $_GET['pag']; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Nombre</label>
                <div class="col-md-4">
                    <input name="nombre_tramite" type="text" placeholder="Nombre" class="form-control input-md" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Plantilla</label>
                <div class="col-md-4">
                    <input name="nombre_tramite" type="file" placeholder="Nombre" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Descripción</label>
                <div class="col-md-4">
                    <textarea name="descripcion" class="form-control input-md" placeholder="Descripción del formulario" required></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Requisitos</label>
                <div class="col-md-4">
                    <textarea name="requisitos" class="form-control input-md" placeholder="Requisitos" required></textarea>
                </div>
            </div>
            <table class="table" id="formulario">
                <tr>
                    <td>
                        <center><b>Nombre del campo</b></center>
                    </td>
                    <td>
                        <center><b>Tipo de campo</b></center>
                    </td>
                    <td>
                        <center><b>Opciones</b></center>
                    </td>
                    <td>
                        <center><b>Requerido</b></center>
                    </td>
                    <td>
                        <center><b>Añadir Campo </b></center>
                    </td>
                </tr>
                
                <tr id="clonedInput1" class="clonedInput">
                    <td>
                        <input id="nombre" name="nombre[]" type="text" placeholder="Nombre del Campo" class="form-control input-md" required/>
                    </td>
                    <td>
                        <select id="tipo1" name="tipo[]" class="tipo form-control input-md" onchange="verificar(this);" required>
                            <option value="">Seleccionar</option>
                            <option value="1">Campo de texto</option>
                            <option value="2">Seleccionable</option>
                            <option value="3">Texto</option>
                            <option value="4">Archivo</option>
                        </select>
                    </td>
                    <td>
                        <input readonly id="opciones1" name="opciones[]" type="text" placeholder="Separadas por comas" class="form-control input-md"/>
                    
                        <select readonly id="campo1" name="campo[]" class="form-control input-md" style="display: none;">
                           <option value="ninguno">Predeterminado: Ninguno</option>
                           <option value="nombre_completo">Predeterminado: Nombre Completo</option>
                           <option value="nombre">Predeterminado: Nombre</option>
                           <option value="primer_apellido">Predeterminado: Primer Apellido</option>
                           <option value="segundo_apellido">Predeterminado: Segundo Apellido</option>
                           <option value="direccion"> Predeterminado: Dirección </option>
                           <option value="distrito">Predeterminado: Distrito</option>
                           <option value="asada">Predeterminado: Nombre Asada por defecto</option>
                        </select>
                    </td>
                    
                    <td>
                        <select id="requerido1" name="requerido[]" class="form-control input-md" >
                           <option value="1">Sí</option>
                           <option value="2">No</option>
                        </select>
                    </td>
                    
                    <td>    
                        <button type="button" class="clone btn btn-success">Añadir Campo</button> 
                    </td>
                </tr>
            </table>
            <center><button class="btn btn-success" type="submit">Enviar</button></center>
        </form>  
    </div>
</div>
<script type="text/javascript" src="//code.jquery.com/jquery-1.6.4.js"></script>
<script type="text/javascript">  
    function verificar(att){
        var regex = /(\d+)/g;
        var name= $(att).attr("id");
        if($(att).val() == 1){ // Campo
            $('#campo'+name.match(regex)[0]).removeAttr("readonly");
            $('#opciones'+name.match(regex)[0]).attr("readonly","readonly");
       
            $('#campo'+name.match(regex)[0]).show();
            $('#opciones'+name.match(regex)[0]).hide();
        }
        if($(att).val() == 2){ //Seleccionable
            $('#opciones'+name.match(regex)[0]).removeAttr("readonly");
            $('#campo'+name.match(regex)[0]).attr("readonly","readonly");
       
            $('#campo'+name.match(regex)[0]).hide();
            $('#opciones'+name.match(regex)[0]).show();
        }
        if($(att).val() == 3){ // Texto
            $('#campo'+name.match(regex)[0]).removeAttr("readonly");
            $('#opciones'+name.match(regex)[0]).attr("readonly","readonly");
                   
            $('#campo'+name.match(regex)[0]).show();
            $('#opciones'+name.match(regex)[0]).hide();
        }
        if($(att).val() == 4){ // Archivo
            $('#campo'+name.match(regex)[0]).attr("readonly","readonly");
            $('#opciones'+name.match(regex)[0]).attr("readonly","readonly");
                   
            $('#campo'+name.match(regex)[0]).show();
            $('#opciones'+name.match(regex)[0]).hide();
        }        
    }

$(window).load(function(){       
    var regex = /^(.+?)(\d+)$/i;
    var cloneIndex = $(".clonedInput").length+1;
    function clone(){        
        $(this).parents(".clonedInput").clone()
            .appendTo("table")
            .attr("id", "clonedInput" +  cloneIndex)
            .find("*")
            .each(function() {
                var id = this.id || "";
                var match = id.match(regex) || [];
                if (match.length == 3) {
                    this.id = match[1] + (cloneIndex);
                }
            })
            .on('click', 'button.clone', clone);
        cloneIndex++;
    }
    function remove(){
        $(this).parents(".clonedInput").remove();
    }
    $("button.clone").on("click", clone);
});
</script>



