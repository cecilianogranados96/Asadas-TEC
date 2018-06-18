$(document).ready(function(){
  var usuario = getCookie("usuario");
  document.getElementById('usuarioConectado').innerHTML = usuario;
  var nombreASADA = getCookie("nombreASADA");
  document.getElementById('headerASADA').innerHTML = "Está conectado a: " + nombreASADA;
  
  $.getJSON("../php/llenartramite.php",function(data){
    $.each(data,function(index,item) 
    {
     document.getElementById("titulo").innerHTML = item.nombre;
     document.getElementById("descripcion").innerHTML = item.descripcion;
     document.getElementById("requisitos").innerHTML = item.requisitos;
  });
});


$.getJSON("../php/getCampos.php",function(data){
    $.each(data,function(index,item) 
    {
     document.getElementById("campos").innerHTML += "<input type='text' id=" + item.idCAMPO + " placeholder='" + item.nombre + "'/>";
  });

});

$("#guardar").click(function(){
    var tramite = getCookie("tramite");
    var usuario = getCookie("usuario");
    var input = [];
    var inputid = [];
    
    $('#campos').children('input').each(function () {
        inputid.push(this.id);
        input.push(this.value);
    });
    
    var valores = input.join(',');
    alert(valores);
    var ids = inputid.join(',');
    alert(ids);
    
    $.post("../php/guardarFormulario.php",{tramite1: tramite, usuario1: usuario, valores1: valores, ids1: ids}, function(data) {
        location.assign("http://asadacr.000webhostapp.com/mistramites.html");
    });
    
   //var nombre = $("#nombre").val();
   //alert(nombre);

});




});
