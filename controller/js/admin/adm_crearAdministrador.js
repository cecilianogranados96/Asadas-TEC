$(document).ready(function(){
    
    if (getCookie("tipoUsuario") != 1){
        history.go(-1);
    }
    
  var items="";
  
  $.getJSON("php/getProvincias.php",function(data){

    items+="<option value='0' disable selected>Provincia</option>";
    $.each(data,function(index,item) 
    {
      items+="<option value='"+item.idProvincia+"'>"+item.nombre+"</option>";
    });

    $("#provincia").html(items); 
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
    
    $.ajax({
       url : "php/adm_functions.php", // the resource where youre request will go throw
       type : "POST", // HTTP verb
       data : { action: 'crearAdministrador', nombre1: nombre, primerApellido1: primerApellido, segundoApellido1: segundoApellido, correo1: correo, contrasena1: contrasena, cedula1: cedula, telefono1: telefono, direccionExacta1: direccionExacta, distrito1:distrito },
       dataType: "json",
       success: function(data){
           alert("Se insertó exitosamente");
           location.assign("http://asadacr.000webhostapp.com/adm_admins.html");
        },
        error: function (data){
            console.log(JSON.stringify(data));
            alert("Se insertó exitosamente");
        }
    });
    
    /*
  $.post("php/adm_crearAdministrador.php",{nombre1: nombre, primerApellido1: primerApellido, segundoApellido1: segundoApellido, correo1: correo, contrasena1: contrasena, cedula1: cedula, telefono1: telefono, direccionExacta1: direccionExacta, distrito1:distrito}, function(data, status) {
   alert(data);
    }).fail(function(err, status) {
       alert(data);
    });
    */

});
});