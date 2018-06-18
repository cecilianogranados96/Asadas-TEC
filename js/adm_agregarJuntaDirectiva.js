$(document).ready(function(){

    if (getCookie("tipoUsuario") != 1){
        history.go(-1);
    }

  var usuario = getCookie("usuario");
  document.getElementById('usuarioConectado').innerHTML = usuario;
  var nombreASADA = getCookie("nombreASADA");
  document.getElementById('headerASADA').innerHTML = "Está conectado a: " + nombreASADA;

  var items="";

  $.getJSON("../php/getPosicion.php",function(data){

    items+="<option value='' disabled>Posición:</option>";
    $.each(data,function(index,item)
    {
      items+="<option value='"+item.idPUESTO+"'>"+item.nombre+"</option>";
    });

    $("#posicion").html(items);
  });

    $("#guardar").click(function(){
        var nombre = $("#nombre").val();
        var posicion = $('#posicion').find(":selected").text();


        $.ajax({
           url : "../php/adm_functions.php", // the resource where youre request will go throw
           type : "POST", // HTTP verb
           data : { action: 'agregarJuntaDirectiva', nombre1 : nombre, posicion1: posicion },
           dataType: "json",
           success: function(data){
               location.assign("http://asadacr.000webhostapp.com/adm_juntaDirectiva.html");
			},
            error: function (data){
                console.log(data.responseText);
                alert("Se ha insertado exitosamente");
            }
        });


        /*
        $.post("../php/adm_agregarJuntaDirectiva.php",{nombre1: nombre, posicion1: posicion}, function(data) {
            location.assign("http://asadacr.000webhostapp.com/adm_juntaDirectiva.html");
        });*/
    });

});
