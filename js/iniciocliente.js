$(document).ready(function(){
  var usuario = getCookie("usuario");
  document.getElementById('usuarioConectado').innerHTML = usuario;
  var nombreASADA = getCookie("nombreASADA");
  document.getElementById('headerASADA').innerHTML = "Está conectado a: " + nombreASADA;

    /*
  $.getJSON("../php/adm_inicio.php",function(data){
    var contador = 1;
    $.each(data,function(index,item) 
    {
        //alert("super");
        var nombre = "foto" + contador;
        var noticia = "noticia" + contador;
        contador = contador + 1;
        var l = document.getElementById(nombre);
        l.setAttribute("alt", item.titulo);
        l.setAttribute("src", item.imagen);
    }); 
  });
    */
    
    $.ajax({
       url : "../php/adm_functions.php", // the resource where youre request will go throw
       type : "POST", // HTTP verb
       data : { action: 'inicio' },
       dataType: "json",
       success: function(data){
        var contador = 1;
        $.each(data,function(index,item) {
            var nombre = "foto" + contador;
            var noticia = "noticia" + contador;
            contador = contador + 1;
            var l = document.getElementById(nombre);
            l.setAttribute("alt", item.titulo);
            l.setAttribute("src", item.imagen);
        })
       },
        error: function (data){
            console.log(data.responseText);
            alert("Ha ocurrido un error.");
        }
    });
    
});