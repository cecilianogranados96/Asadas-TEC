$(document).ready(function(){

    if (getCookie("tipoUsuario") != 2){
        history.go(-1);
    }

  var items="";

  $.getJSON("../php/getProvincias.php",function(data){

items+="<option value='0' disabled>Provincia</option>";
    $.each(data,function(index,item)
    {
      items+="<option value='"+item.idProvincia+"'>"+item.nombre+"</option>";
    });

    $("#provincia").html(items);
  });

$("#guardar").click(function(){
   var titulo = $("#titulo").val();
   var historia = $("#historia").val();
   var mision = $("#mision").val();
   var vision = $("#vision").val();
   var fotoNoticia = $("#foto").val().split(/(\\|\/)/g).pop();
   var telefono = $("#telefono").val();
   var horario = $("#horario").val();
   var facebook = $("#facebook").val();
   var correo = $("#correo").val();
   var distrito = $('#distrito').find(":selected").text();
   var cedula = $("#cedula").val();
   var direccion = $("#direccion").val();
   var fecha = $("#fecha").val();

   submitForm();

   /*
   $.ajax({
      url : "../php/master_functions.php", // the resource where youre request will go throw
      type : "POST", // HTTP verb
      data : { action: 'registrarASADA', titulo1: titulo, historia1: historia, mision1: mision, vision1: vision, fotoNoticia1: fotoNoticia, telefono1: telefono, horario1: horario, facebook1: facebook, correo1: correo, distrito1: distrito, cedula1: cedula, direccion1: direccion, fecha1: fecha },
      dataType: "json",
      success: function(data){
        alert("La ASADA se ha creado de forma exitosa.");
        location.assign("http://asadacr.000webhostapp.com/master-inicio.html");
 },
       error: function (data){
           console.log(data.responseText);
           alert("La ASADA se ha creado de forma exitosa.");
           location.assign("http://asadacr.000webhostapp.com/master-inicio.html");
       }
   });
   */

  $.post("../php/registrarASADA.php",{titulo1: titulo, historia1: historia, mision1: mision, vision1: vision, fotoNoticia1: fotoNoticia, telefono1: telefono, horario1: horario, facebook1: facebook, correo1: correo, distrito1: distrito, cedula1: cedula, direccion1: direccion, fecha1: fecha},
  function(data)
  {
     if(data == "si"){
          alert("La ASADA se ha creado de forma exitosa.");
          location.assign("http://asadacr.000webhostapp.com/master-inicio.html");
     }
     else{
          alert("La ASADA no se ha podido registrar. Revise los datos.");
     }
  });

});

});

function submitForm() {
    alert("starting");
    console.log("submit event");
    var fd = new FormData(document.getElementById("fileinfo"));
    fd.append("label", "WEBUPLOAD");
    $.ajax({
      url: "../php/upload.php",
      type: "POST",
      data: fd,
      processData: false,  // tell jQuery not to process the data
      contentType: false   // tell jQuery not to set contentType
    }).done(function( data ) {
        alert("done");
        console.log("PHP Output:");
        console.log( data );
        result = data;
        alert(result);
    });
    alert("officially done");
    return false;
}
