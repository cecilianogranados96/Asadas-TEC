$(document).ready(function(){
    
    if (getCookie("tipoUsuario") != 1){
        history.go(-1);
    }
    
  var table = document.getElementById("noticias");
    
    $.ajax({
       url : "../php/adm_functions.php", // the resource where youre request will go throw
       type : "POST", // HTTP verb
       data : { action: 'getEstaAsociacion' },
       dataType: "json",
       success: function(data){
        $.each(data,function(index,item) {
            document.getElementById("titulo").value = item.nombre;
             document.getElementById("historia").value = item.historia;
             document.getElementById("mision").value = item.mision;
             document.getElementById("vision").value = item.vision;
             document.getElementById("telefono").value = item.telefono;
             document.getElementById("horario").value = item.horario;
             document.getElementById("facebook").value = item.link;
             document.getElementById("correo").value = item.correo;
        })
       },
        error: function (data){
            console.log(data.responseText);
            alert("Ha ocurrido un error.");
        }
    });
    
    /*
  $.getJSON("../php/adm_estaAsociacion.php",function(data){
    $.each(data,function(index,item) {
     document.getElementById("titulo").value = item.nombre;
     document.getElementById("historia").value = item.historia;
     document.getElementById("mision").value = item.mision;
     document.getElementById("vision").value = item.vision;
     document.getElementById("telefono").value = item.telefono;
     document.getElementById("horario").value = item.horario;
     document.getElementById("facebook").value = item.link;
     document.getElementById("correo").value = item.correo;
  });
  });
    */

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

   if(fotoNoticia != ""){
      submitForm();
   }
    
    $.ajax({
       url : "../php/adm_functions.php", // the resource where youre request will go throw
       type : "POST", // HTTP verb
       data : { action: 'estaAsociacion', titulo1: titulo, historia1: historia, mision1: mision, vision1: vision, fotoNoticia1: fotoNoticia, telefono1: telefono, horario1: horario, facebook1: facebook, correo1: correo },
       dataType: "json",
       success: function(data){
           alert("Se ha editado exitosamente");
           location.assign("http://asadacr.000webhostapp.com/adm_estaAsociacion.html");
        },
        error: function (data){
            console.log(data);
            alert("Se ha editado exitosamente");
        }
    });

    /*
  $.post("../php/editarASADA.php",{titulo1: titulo, historia1: historia, mision1: mision, vision1: vision, fotoNoticia1: fotoNoticia, telefono1: telefono, horario1: horario, facebook1: facebook, correo1: correo},
  function(data)
  {
    alert(data);
  });
    */

});

});

function submitForm() {
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
        console.log("PHP Output:");
        console.log( data );
        result = data;
    });
    return false;
}