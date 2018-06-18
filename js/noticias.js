$(document).ready(function(){
  var usuario = getCookie("usuario");
  document.getElementById('usuarioConectado').innerHTML = usuario;
  var nombreASADA = getCookie("nombreASADA");
  document.getElementById('headerASADA').innerHTML = "Está conectado a: " + nombreASADA;

  $.ajax({
     url : "../php/general_functions.php", // the resource where youre request will go throw
     type : "POST", // HTTP verb
     data : { action: 'noticia' },
     dataType: "json",
     success: function(data){
       $.each(data,function(index,item)
       {
           var div = document.createElement('div');
           div.className = 'specific-new';

           div.innerHTML = '<h1 class="noticias-titulo">' + item.titulo + '</h1> \
                            <div class="espacio-foto-noticias"> \
                            <img src='+ item.imagen +' class="foto-noticia"> \
                            <span class="fechahora-foto-noticia"> Fecha de publicación: '+ this.fechaPublicacion +'</span> \
                            </div> \
                            <div class="texto-noticia">'+ item.contenido +'</div>';

           document.getElementById('noticia-container').appendChild(div);
       });
       if(data.length === 0){
           document.getElementById('noticia-container').innerHTML = "<br><br><div class='texto-descripcion'>No hay noticias publicadas.</div>";
       }
     },
      error: function (data){
          console.log(data.responseText);
          alert("Ha ocurrido un error.");
      }
  });

  /*
  $.getJSON("../php/noticias.php",function(data){
    $.each(data,function(index,item)
    {
        var div = document.createElement('div');
        div.className = 'specific-new';

        div.innerHTML = '<h1 class="noticias-titulo">' + item.titulo + '</h1> \
                         <div class="espacio-foto-noticias"> \
                         <img src='+ item.imagen +' class="foto-noticia"> \
                         <span class="fechahora-foto-noticia"> Fecha de publicación: '+ this.fechaPublicacion +'</span> \
</div> \
<div class="texto-noticia">'+ item.contenido +'</div>';

        document.getElementById('noticia-container').appendChild(div);
    });
    if(data.length === 0){
        document.getElementById('noticia-container').innerHTML = "<br><br><div class='texto-descripcion'>No hay noticias publicadas.</div>";
    }
  });
  */

$("#noticia").click(function(){
   alert("bye");
});

});
