//<span class="form-label">Label numero 1:</span>
//<input type="text" name="">

$(document).ready(function(){
  var usuario = getCookie("usuario");
  document.getElementById('usuarioConectado').innerHTML = usuario;

  var nombre = document.getElementById("nombre");
  $.getJSON("php/getNombreTramite.php",function(data){
    $.each(data,function(index,item)
    {
        nombre.innerHTML = item.nombre;
    });
  });

  var table = document.getElementById("campos");
  $.getJSON("php/adm_resolverTramite.php",function(data){
    $.each(data,function(index,item)
    {
        if(item.tipoCampo === '1'){
            table.innerHTML += "<span class='form-label'>" + item.nombre + "</span>";
            table.innerHTML += "<input type='text' id='" + item.idCAMPO + "' disabled>";
        }
        else{
            table.innerHTML += "<span class='form-label'>" + item.nombre + "</span>";
            table.innerHTML += "<input type='text' id='" + item.idCAMPO + "'>";
        }
    });
   });

   alert("Campos cargados exitosamente.");
   $.getJSON("php/getCamposTramite.php",function(data){
    $.each(data,function(index,item)
    {
        var element = document.getElementById(item.idCAMPO);
        element.setAttribute("value", item.valor);
    });
   });

   $.getJSON("php/getEstadoTramite.php",function(data){
    $.each(data,function(index,item)
    {
        document.getElementById("opciones").value = item.estado;
    });
   });

   $("#guardar").click(function(){
    var e = document.getElementById("opciones");
    var estado = e.options[e.selectedIndex].value;

    $.ajax({
       url : "php/master_functions.php", // the resource where youre request will go throw
       type : "POST", // HTTP verb
       data : { action: 'resolverTramite', estado1: estado },
       dataType: "json",
       success: function(data){
         alert("Trámite guardado de forma exitosa.");
         location.assign("http://asadacr.000webhostapp.com/master_tramitesPendientes.html");
  },
        error: function (data){
          alert("Trámite guardado de forma exitosa.");
          location.assign("http://asadacr.000webhostapp.com/master_tramitesPendientes.html");
        }
    });

    /*
    $.post("php/updateEstadoTramite.php",{estado1: estado}, function(data, status) {
            alert("Trámite guardado de forma exitosa.");
            location.assign("http://asadacr.000webhostapp.com/master_tramitesPendientes.html");
    }).fail(function(err, status) {
        alert("Trámite guardado de forma exitosa.");
        location.assign("http://asadacr.000webhostapp.com/master_tramitesPendientes.html");
    });
    location.assign("http://asadacr.000webhostapp.com/master_tramitesPendientes.html");
    */
    
   });
});
