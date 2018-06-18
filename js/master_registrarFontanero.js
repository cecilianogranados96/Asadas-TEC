$(document).ready(function(){

    if (getCookie("tipoUsuario") != 2){
        history.go(-1);
    }

  var items2="";
  $.getJSON("../php/getASADAS.php",function(data){

    items2+="<option value='0' disabled selected>ASADA asociada:</option>";
    $.each(data,function(index,item)
    {
      items2+="<option value='"+item.idASADA+"'>"+item.nombre+"</option>";
    });

    $("#asadas").html(items2);
  });

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
   var asada = $('#asadas').find(":selected").text();

   /*
   $.ajax({
      url : "../php/master_functions.php", // the resource where youre request will go throw
      type : "POST", // HTTP verb
      data : { action: 'registrarFontanero', nombre1: nombre, primerApellido1: primerApellido, segundoApellido1: segundoApellido, correo1: correo, contrasena1: contrasena, cedula1: cedula, telefono1: telefono, direccionExacta1: direccionExacta, distrito1:distrito, asada1:asada },
      dataType: "json",
      success: function(data){
          window.location.replace("http://asadacr.000webhostapp.com/master_verFontaneros.html");
 },
       error: function (data){
           console.log(data.responseText);
           alert("Se ha registrado exitosamente");
           window.location.replace("http://asadacr.000webhostapp.com/master_verFontaneros.html");
       }
   });
   */

  $.post("../php/master_registrarFontanero.php",{nombre1: nombre, primerApellido1: primerApellido, segundoApellido1: segundoApellido, correo1: correo, contrasena1: contrasena, cedula1: cedula, telefono1: telefono, direccionExacta1: direccionExacta, distrito1:distrito, asada1:asada}, function(data, status) {
   window.location.replace("http://asadacr.000webhostapp.com/master_verFontaneros.html");
    }).fail(function(err, status) {
   alert("Se registró el fontanero de forma exitosa.");
   window.location.replace("http://asadacr.000webhostapp.com/master_verFontaneros.html");
  });

window.location.replace("http://asadacr.000webhostapp.com/master_verFontaneros.html");

});
});
