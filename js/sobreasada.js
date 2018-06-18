$(document).ready(function(){
  var usuario = getCookie("usuario");
  document.getElementById('usuarioConectado').innerHTML = usuario;
  var nombreASADA = getCookie("nombreASADA");
  document.getElementById('headerASADA').innerHTML = "Está conectado a: " + nombreASADA;

  var table = document.getElementById("noticias");
  $.getJSON("../php/sobreasada.php",function(data){
    $.each(data,function(index,item) 
    {
     document.getElementById("titulo").innerHTML = item.nombre;
     document.getElementById("historia").innerHTML = item.historia;
     document.getElementById("mision").innerHTML = item.mision;
     document.getElementById("vision").innerHTML = item.vision;
     var pic = document.getElementById('foto');
     pic.src = item.logo;
  });
});

});