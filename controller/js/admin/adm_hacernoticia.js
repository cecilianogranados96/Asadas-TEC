$(document).ready(function(){
    
    if (getCookie("tipoUsuario") != 1){
        history.go(-1);
    }
    
    
$("#publicarNoticia").click(function(){
    
   var tituloNoticia = $("#tituloNoticia").val();
   var contenidoNoticia = $("#contenidoNoticia").val();
   var fotoNoticia = $("#foto").val().split(/(\\|\/)/g).pop();

   var idASADA = getCookie("asada");
   var result;
    
    $.ajax({
       url : "php/adm_functions.php", // the resource where youre request will go throw
       type : "POST", // HTTP verb
       data : { action: 'hacerNoticia', titulo1: tituloNoticia, contenido1: contenidoNoticia, asada1: idASADA, foto1: fotoNoticia },
       dataType: "json",
       success: function(data){
           location.assign("http://asadacr.000webhostapp.com/adm_noticias.html");
           alert("Se ha publicado la noticia exitosamente");
        },
        error: function (data){
            console.log(data.responseText);
            alert("Se ha publicado la noticia exitosamente");
        }
    });
    
  /*
  $.post("php/adm_hacernoticia.php",{titulo1: tituloNoticia, contenido1: contenidoNoticia, asada1: idASADA, foto1: fotoNoticia},
  function(data)
  {
    //alert(data);
      console.log(data);
  });
    */

});
});

function submitForm() {
    console.log("submit event");
    var fd = new FormData(document.getElementById("fileinfo"));
    fd.append("label", "WEBUPLOAD");
    $.ajax({
      url: "php/upload.php",
      type: "POST",
      data: fd,
      processData: false,  // tell jQuery not to process the data
      contentType: false   // tell jQuery not to set contentType
    }).done(function( data ) {
        /*console.log("PHP Output:");
        console.log( data );
        result = data;
        alert(result);*/
        location.assign("http://asadacr.000webhostapp.com/adm_noticias.html");
        return false;
    });
    //location.assign("http://asadacr.000webhostapp.com/adm_noticias.html");
    //return false;
}