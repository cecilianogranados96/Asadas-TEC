$(document).ready(function(){
  var usuario = getCookie("usuario");
  document.getElementById('usuarioConectado').innerHTML = usuario;
  var nombreASADA = getCookie("nombreASADA");
  nombreASADA = nombreASADA.replace(/\+/g,' ');
  setCookie("nombreASADA", nombreASADA, 1);
  document.getElementById('headerASADA').innerHTML = "Está conectado a: " + nombreASADA;
});