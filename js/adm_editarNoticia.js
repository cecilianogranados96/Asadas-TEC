$(document).ready(function(){
    
    if (getCookie("tipoUsuario") != 1){
        history.go(-1);
    }
    
  var usuario = getCookie("usuario");
  document.getElementById('usuarioConectado').innerHTML = usuario;
  var nombreASADA = getCookie("nombreASADA");
  document.getElementById('headerASADA').innerHTML = "Está conectado a: " + nombreASADA;
  
  var table = document.getElementById("noticias");
    
    $.ajax({
       url : "../php/adm_functions.php", // the resource where youre request will go throw
       type : "POST", // HTTP verb
       data : { action: 'getEditarNoticia' },
       dataType: "json",
       success: function(data){
        $.each(data,function(index,item) {
            $.each(data,function(index,item) 
            {
             document.getElementById("titulo").value = item.titulo;
             document.getElementById("contenido").value = item.contenido;
            });
        })
       },
        error: function (data){
            console.log(JSON.stringify(data));
            alert("Ha ocurrido un error.");
        }
    });
    
    /*
  $.getJSON("../php/adm_editarNoticia.php",function(data){
    $.each(data,function(index,item) 
    {
     document.getElementById("titulo").value = item.titulo;
     document.getElementById("contenido").value = item.contenido;
    });
  });
    */

$("#guardar").click(function(){
   var titulo = $("#titulo").val();
   var contenido = $("#contenido").val();
   var fotoNoticia = $("#foto").val().split(/(\\|\/)/g).pop();

   if(fotoNoticia != ""){
      submitForm();
   }

    $.ajax({
       url : "../php/adm_functions.php", // the resource where youre request will go throw
       type : "POST", // HTTP verb
       data : { action: 'editarNoticia', titulo1: titulo, contenido1: contenido, fotoNoticia1: fotoNoticia },
       dataType: "json",
       success: function(data){
           alert("Se ha editado exitosamente");
           location.assign("http://asadacr.000webhostapp.com/adm_noticias.html");
        },
        error: function (data){
            console.log(data);
            alert("Se ha editado exitosamente");
        }
    });
    
    /*
  $.post("../php/editarNoticia.php",{titulo1: titulo, contenido1: contenido, fotoNoticia1: fotoNoticia},
  function(data)
  {
      if(data == "si"){
          //alert("La noticia fue editada exitosamente.")
          console.log("La noticia fue editada exitosamente.");
      }
      else{
          //alert(data);
          console.log(data);
      }
    
  });
    */

});

});

function submitForm() {
    var fd = new FormData(document.getElementById("fileinfo"));
    fd.append("label", "WEBUPLOAD");
    $.ajax({
      url: "../php/upload.php",
      type: "POST",
      data: fd,
      processData: false,  // tell jQuery not to process the data
      contentType: false   // tell jQuery not to set contentType
    }).done(function( data ) {
        /*console.log("PHP Output:");
        console.log( data );
        result = data;
        alert(result);*/
        alert("La noticia fue editada exitosamente.");
        location.assign("http://asadacr.000webhostapp.com/adm_noticias.html");
        return false;
    });
}