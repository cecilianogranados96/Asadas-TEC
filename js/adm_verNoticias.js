$(document).ready(function(){
    
    if (getCookie("tipoUsuario") != 1){
        history.go(-1);
    }
    
  var usuario = getCookie("usuario");
  document.getElementById('usuarioConectado').innerHTML = usuario;
  var nombreASADA = getCookie("nombreASADA");
  document.getElementById('headerASADA').innerHTML = "Está conectado a: " + nombreASADA;

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

});