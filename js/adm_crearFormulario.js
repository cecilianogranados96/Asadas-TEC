$(document).ready(function(){
    
    if (getCookie("tipoUsuario") != 1){
        history.go(-1);
    }
    
    setCookie("campos", 1, 1);
    
    $("#guardar").click(function(){
        var nombre = $("#nombre").val();
        var descripcion = $("#descripcion").val();
        var requisitos = $("#requisitos").val();
        
        //alert("hourglass " + $("#campo2").val());
    
        var campos = parseInt(getCookie("campos"));
        var arrayCampos = [];
        
        for(var i = 1; i <= campos; i++){
            var nombreCampo = "campo"+i;
            var contenido = document.getElementById(nombreCampo);
            arrayCampos.push(contenido.value);
        }
        var pCampos = arrayCampos.join();
        
        //alert(pCampos);
  
        $.post("../php/adm_crearFormulario.php",{nombre1: nombre, descripcion1: descripcion, requisitos1: requisitos, campos1: pCampos}, function(data)
        {
            alert(data);
        });
        
        location.assign("http://asadacr.000webhostapp.com/adm_plantillas.html");

    });
});
