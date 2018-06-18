$(document).ready(function(){
    
    if (getCookie("tipoUsuario") != 1){
        history.go(-1);
    }
    
    var usuario = getCookie("usuario");
    document.getElementById('usuarioConectado').innerHTML = usuario;
    var nombreASADA = getCookie("nombreASADA");
    document.getElementById('headerASADA').innerHTML = "Está conectado a: " + nombreASADA;

    var table = document.getElementById("admins");
        
    $.ajax({
       url : "../php/adm_functions.php", // the resource where youre request will go throw
       type : "POST", // HTTP verb
       data : { action: 'admins' },
       dataType: "json",
       success: function(data){
        $.each(data,function(index,item) {
            var nombreCompleto = item.nombre + " " + item.primerApellido + " " + item.segundoApellido;

            var row = table.insertRow(1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);

            cell1.innerHTML = nombreCompleto;
            cell2.innerHTML = item.nombreUsuario;

            var name = getCookie("usuario");

            if(item.nombreUsuario !== name){
             cell3.innerHTML = "<a class='tramite-bttn' onclick='borrar(" + item.idPERSONA + ")'>Eliminar</a>";
            }
        })
       },
        error: function (data){
            console.log(data.responseText);
            alert("Ha ocurrido un error.");
        }
    });
    
/*
  $.getJSON("../php/adm_admins.php",function(data){
    $.each(data,function(index,item) 
    {
     var nombreCompleto = item.nombre + " " + item.primerApellido + " " + item.segundoApellido;
    
     var row = table.insertRow(1);
     var cell1 = row.insertCell(0);
     var cell2 = row.insertCell(1);
     var cell3 = row.insertCell(2);

     cell1.innerHTML = nombreCompleto;
     cell2.innerHTML = item.nombreUsuario;
     
     var name = getCookie("usuario");
     
     if(item.nombreUsuario !== name){
         cell3.innerHTML = "<a class='tramite-bttn' onclick='borrar(" + item.idPERSONA + ")'>Eliminar</a>";
     }

  });

});
*/
});