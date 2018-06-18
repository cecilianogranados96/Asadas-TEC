$(document).ready(function(){
    alert("Datos cargados");
  var usuario = getCookie("usuario");
  document.getElementById('usuarioConectado').innerHTML = usuario;
  var nombreASADA = getCookie("nombreASADA");
  document.getElementById('headerASADA').innerHTML = "Está conectado a: " + nombreASADA;

  var campo = document.getElementById("2");
  $.getJSON("../php/getNombreUsuario.php",function(data){
    $.each(data,function(index,item) 
    {
     var nombreCompleto = item.nombre + " " + item.primerApellido + " " + item.segundoApellido;
    
     campo.setAttribute("value", nombreCompleto);
    });
  });
  
  $.getJSON("../php/getCedulaUsuario.php",function(data){
    $.each(data,function(index,item) 
    {
     var direccion = item.provincia + "; " + item.canton + "; " + item.distrito + "; " + item.direccion;
     document.getElementById("3").setAttribute("value", direccion);
    });
  });
  
  var campoTel = document.getElementById("4");
  $.getJSON("../php/getTelefonoUsuario.php",function(data){
    $.each(data,function(index,item) 
    {
     campoTel.setAttribute("value", item.telefono);
    });
  });
  
  $("#guardar").click(function(){
    var tramite = getCookie("tramite");
    var usuario = getCookie("usuario");
    var input = [];
    var inputid = [];
    
    $('#campos').children().each(function () {
        inputid.push(this.id);
        input.push(this.value);
    });
    
    var valores = input.join(',');
    //alert(valores);
    var ids = inputid.join(',');
    //alert(ids);
    
    $.post("../php/guardarFormulario.php",{tramite1: tramite, usuario1: usuario, valores1: valores, ids1: ids}, function(data) {
        location.assign("http://asadacr.000webhostapp.com/mistramites.html");
    });
    
   //var nombre = $("#nombre").val();
   //alert(nombre);

    });
  
});