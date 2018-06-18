$(document).ready(function(){
  var items="";
  $.getJSON("../php/selectasada.php",function(data){
    $.each(data,function(index,item) 
    {
      items+="<option value='"+item.idASADA+"'>"+item.nombre+"</option>";
    });
    $("#listaASADAS").html(items); 
  });

});

function getASADASeleccionada(){
  var idASADA = $('#listaASADAS').find(":selected").val();
  var nombreASADA = $('#listaASADAS').find(":selected").text();
  setCookie("asada", idASADA, 1);
  setCookie("nombreASADA", nombreASADA, 1);
  var tipoUsuario = getCookie("tipoUsuario");
  if(tipoUsuario==0){
     location.assign("http://asadacr.000webhostapp.com/iniciocliente.html");
  }
  else if(tipoUsuario==1){
     location.assign("http://asadacr.000webhostapp.com/adm_inicio.html");
  }
  else if(tipoUsuario==2){
     location.assign("http://asadacr.000webhostapp.com/master-inicio.html");
  }

  return idASADA;
}