$(document).ready(function(){
    
    if (getCookie("tipoUsuario") != 1){
        history.go(-1);
    }
    
  var items="";
  
  $.getJSON("../php/getProvincias.php",function(data){

    items+="<option value='0' disable selected>Provincia</option>";
    $.each(data,function(index,item) 
    {
      items+="<option value='"+item.idProvincia+"'>"+item.nombre+"</option>";
    });

    $("#provincia").html(items); 
  });

$("#Guardar").click(function(){
   //alert("estoy entranda");
   var nombre = $("#nombre").val();
   var primerApellido = $("#primerApellido").val();
   var segundoApellido = $("#segundoApellido").val();
   var correo = $("#correo").val();
   var contrasena = $("#contrasena").val();
   var cedula = $("#cedula").val();
   var telefono = $("#telefono").val();
   var direccionExacta = $("#direccionExacta").val();
   var distrito = $('#distrito').find(":selected").text();
   //alert("ya asigne las variables");
  /* 
   alert("nombre: " + nombre);
   alert("primerApellido: " + primerApellido);
   alert("segundoApellido: " + segundoApellido);
   alert("correo: " + correo);
   alert("contraseña: " + contrasena);
   alert("cedula: " + cedula);
   alert("telefono: " + telefono);
   alert("direccionExacta: " + direccionExacta);
   alert("distrito: " + distrito);
*/
    
    $.ajax({
       url : "../php/adm_functions.php", // the resource where youre request will go throw
       type : "POST", // HTTP verb
       data : { action: 'registrarFontanero', nombre1: nombre, primerApellido1: primerApellido, segundoApellido1: segundoApellido, correo1: correo, contrasena1: contrasena, cedula1: cedula, telefono1: telefono, direccionExacta1: direccionExacta, distrito1:distrito },
       dataType: "json",
       success: function(data){
           alert("Se registró el fontanero de forma exitosa.");
           location.assign("http://asadacr.000webhostapp.com/adm_fontaneros.html");
        },
        error: function (data){
            console.log(data.responseText);
            alert("Se registró el fontanero de forma exitosa.");
        }
    });
   
    /*
  $.post("../php/adm_registrarFontanero.php",{nombre1: nombre, primerApellido1: primerApellido, segundoApellido1: segundoApellido, correo1: correo, contrasena1: contrasena, cedula1: cedula, telefono1: telefono, direccionExacta1: direccionExacta, distrito1:distrito}, function(data, status) {
   alert("No se pudo registrar el fontanero.");
}).fail(function(err, status) {
   alert("Se registró el fontanero de forma exitosa.");
   window.location.replace("http://asadacr.000webhostapp.com/adm_fontaneros.html");
});
    */

window.location.replace("http://asadacr.000webhostapp.com/adm_fontaneros.html");

});
});