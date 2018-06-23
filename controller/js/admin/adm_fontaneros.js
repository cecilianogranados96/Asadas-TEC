$(document).ready(function(){
    
    if (getCookie("tipoUsuario") != 1){
        history.go(-1);
    }
    
  var table = document.getElementById("fontaneros");
    
    $.ajax({
       url : "php/adm_functions.php", // the resource where youre request will go throw
       type : "POST", // HTTP verb
       data : { action: 'fontaneros' },
       dataType: "json",
       success: function(data){
        $.each(data,function(index,item) {
             var nombreCompleto = item.nombre + " " + item.primerApellido + " " + item.segundoApellido;

             var row = table.insertRow(1);
             var cell1 = row.insertCell(0);
             var cell2 = row.insertCell(1);
             var cell3 = row.insertCell(2);
             var cell4 = row.insertCell(3);

             cell1.innerHTML = nombreCompleto;
             cell2.innerHTML = item.nombreUsuario;
             cell3.innerHTML = "<a id='editar' name='editar' title='" + item.idPERSONA + "' class='tramite-bttn'  onclick='myFunction(" + item.idPERSONA + ")'>Editar</a>";
             cell4.innerHTML = "<a class='tramite-bttn' onclick='borrar(" + item.idPERSONA + ")'>Eliminar</a>";
          });
          if(data.length === 0){
            table.innerHTML = "<div class='texto-descripcion'>No hay fontaneros registrados.</div>";
            }
       },
        error: function (data){
            console.log(data.responseText);
            alert("Ha ocurrido un error.");
        }
    });
    
    /*
  $.getJSON("php/adm_fontaneros.php",function(data){
    $.each(data,function(index,item) 
    {
     var nombreCompleto = item.nombre + " " + item.primerApellido + " " + item.segundoApellido;
    
     var row = table.insertRow(1);
     var cell1 = row.insertCell(0);
     var cell2 = row.insertCell(1);
     var cell3 = row.insertCell(2);
     var cell4 = row.insertCell(3);

     cell1.innerHTML = nombreCompleto;
     cell2.innerHTML = item.nombreUsuario;
     cell3.innerHTML = "<a id='editar' name='editar' title='" + item.idPERSONA + "' class='tramite-bttn'  onclick='myFunction(" + item.idPERSONA + ")'>Editar</a>";
     cell4.innerHTML = "<a class='tramite-bttn' onclick='borrar(" + item.idPERSONA + ")'>Eliminar</a>";
  });
  if(data.length === 0){
    table.innerHTML = "<div class='texto-descripcion'>No hay fontaneros registrados.</div>";
   }
});
    */
});