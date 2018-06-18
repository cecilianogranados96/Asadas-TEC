$(document).ready(function(){
    
    if (getCookie("tipoUsuario") != 1){
        history.go(-1);
    }
    
    var titulo = document.getElementById("titulo");
    $.getJSON("../php/getNombreFormulario.php",function(data){
        $.each(data,function(index,item) 
        {
            titulo.innerHTML = item.nombre;
        });
    });
    
    $("#guardar").click(function(){
       var plantilla = $("#plantilla").val().split(/(\\|\/)/g).pop();
      
        $.ajax({
           url : "../php/adm_functions.php", // the resource where youre request will go throw
           type : "POST", // HTTP verb
           data : { action: 'subirPlantilla', plantilla1: plantilla },
           dataType: "json",
           success: function(data){
               alert("Se ha subido exitosamente");
			},
            error: function (data){
                console.log(data);
                alert("Se ha subido exitosamente");
            }
        });
        
        /*
      $.post("../php/adm_subirPlantilla.php",{plantilla1: plantilla},
      function(data)
      {
        //alert(data);
        //location.assign("http://asadacr.000webhostapp.com/adm_plantillas.html");
          console.log(data);
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
        location.assign("http://asadacr.000webhostapp.com/adm_plantillas.html");
        return false;
    });
}