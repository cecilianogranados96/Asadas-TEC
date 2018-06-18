$(document).ready(function(){

    if (getCookie("tipoUsuario") != 2){
        history.go(-1);
    }

  var table = document.getElementById("fontaneros");

  $.ajax({
     url : "../php/master_functions.php", // the resource where youre request will go throw
     type : "POST", // HTTP verb
     data : { action: 'verFontaneros' },
     dataType: "json",
     success: function(data){
       $.each(data,function(index,item)
       {
          var nombreCompleto = item.nombre + " " + item.primerApellido + " " + item.segundoApellido;

          var row = table.insertRow(1);
          var cell1 = row.insertCell(0);
          var cell2 = row.insertCell(1);
          var cell3 = row.insertCell(2);
          var cell4 = row.insertCell(3);

          cell1.innerHTML = nombreCompleto;
          cell2.innerHTML = item.asada;
          cell3.innerHTML = item.nombreUsuario;
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
  $.getJSON("../php/master_verFontaneros.php",function(data){
    $.each(data,function(index,item)
    {
     var nombreCompleto = item.nombre + " " + item.primerApellido + " " + item.segundoApellido;

     var row = table.insertRow(1);
     var cell1 = row.insertCell(0);
     var cell2 = row.insertCell(1);
     var cell3 = row.insertCell(2);
     var cell4 = row.insertCell(3);

     cell1.innerHTML = nombreCompleto;
     cell2.innerHTML = item.asada;
     cell3.innerHTML = item.nombreUsuario;
     cell4.innerHTML = "<a class='tramite-bttn' onclick='borrar(" + item.idPERSONA + ")'>Eliminar</a>";

  });
  if(data.length === 0){
    table.innerHTML = "<div class='texto-descripcion'>No hay fontaneros registrados.</div>";
   }
});
  */
});
