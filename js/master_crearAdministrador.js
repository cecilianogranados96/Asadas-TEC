$(document).ready(function(){

    if (getCookie("tipoUsuario") != 2){
        history.go(-1);
    }

  var items="";

  $.getJSON("../php/getASADAS.php",function(data){

    items+="<option value='0' disable selected>ASADA asociada:</option>";
    $.each(data,function(index,item)
    {
      items+="<option value='"+item.idASADA+"'>"+item.nombre+"</option>";
    });

    $("#asadas").html(items);
  });
  var items2 = "";
  $.getJSON("../php/getProvincias.php",function(data){
    items2+="<option value='0' disable selected>Provincia</option>";
    $.each(data,function(index,item)
    {
      items2+="<option value='"+item.idProvincia+"'>"+item.nombre+"</option>";
    });

    $("#provincia").html(items2);
  });

$("#Guardar").click(function(){
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
   alert("nombre: " + nombre);
   alert("primerApellido: " + primerApellido);
   alert("segundoApellido: " + segundoApellido);
   alert("correo: " + correo);
   alert("contraseÃ±a: " + contrasena);
   alert("cedula: " + cedula);
   alert("telefono: " + telefono);
   alert("direccionExacta: " + direccionExacta);
   alert("distrito: " + distrito);
   alert("asada: " + asada);
*/

  $.ajax({
     url : "../php/master_functions.php", // the resource where youre request will go throw
     type : "POST", // HTTP verb
     data : { action: 'crearAdministrador', nombre1: nombre, primerApellido1: primerApellido, segundoApellido1: segundoApellido, correo1: correo, contrasena1: contrasena, cedula1: cedula, telefono1: telefono, direccionExacta1: direccionExacta, distrito1:distrito, asada1: asada},
     dataType: "json",
     success: function(data){
       alert("Administrador creado de forma exitosa.");
       location.assign("http://asadacr.000webhostapp.com/master_admins.html");
  },
      error: function (data){
          console.log(data.responseText);
          alert("Se ha creado exitosamente");
          location.assign("http://asadacr.000webhostapp.com/master_admins.html");
      }
  });

  /*
  $.post("../php/master_crearAdministrador.php",{nombre1: nombre, primerApellido1: primerApellido, segundoApellido1: segundoApellido, correo1: correo, contrasena1: contrasena, cedula1: cedula, telefono1: telefono, direccionExacta1: direccionExacta, distrito1:distrito, asada1: asada}, function(data, status) {
   alert(data);
     alert("Administrador creado de forma exitosa.");
     location.assign("http://asadacr.000webhostapp.com/master_admins.html");
}).fail(function(err, status) {
     location.assign("http://asadacr.000webhostapp.com/master_admins.html");
});
  */

});

});
