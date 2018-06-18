$(document).ready(function(){
  var usuario = getCookie("usuario");
  document.getElementById('usuarioConectado').innerHTML = usuario;
  var nombreASADA = getCookie("nombreASADA");
  document.getElementById('headerASADA').innerHTML = "Está conectado a: " + nombreASADA;

  var table = document.getElementById("tramites");

  $.ajax({
     url : "../php/general_functions.php", // the resource where youre request will go throw
     type : "POST", // HTTP verb
     data : { action: 'seleccionartramite' },
     dataType: "json",
     success: function(data){
       $.each(data,function(index,item)
       {
        var row = table.insertRow(1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);

        cell1.innerHTML = item.nombre;
        cell2.innerHTML = item.descripcion;
        if(item.idTRAMITE==0){
           cell3.innerHTML = "<a name='editar' id='0' class='tramite-bttn' onclick='myFunction(0)' href='http://asadacr.000webhostapp.com/solicitudAsada.html'>Realizar</a>";
        }
        else if(item.idTRAMITE==1){
           cell3.innerHTML = "<a name='editar' id='1' class='tramite-bttn' onclick='myFunction(1)' href='http://asadacr.000webhostapp.com/llenartramite_sol.html'>Realizar</a>";
        }
        else if(item.idTRAMITE==2){
           cell3.innerHTML = "<a name='editar' id='2' class='tramite-bttn' onclick='myFunction(2)' href='http://asadacr.000webhostapp.com/llenartramite_disp.html'>Realizar</a>";
        }
        else if(item.idTRAMITE==8){
           cell3.innerHTML = "<a name='editar' id='8' class='tramite-bttn' onclick='myFunction(8)' href='http://asadacr.000webhostapp.com/llenartramite_ave.html'>Realizar</a>";
        }
        else{
           cell3.innerHTML = "<a name='editar' id='" + item.idTRAMITE + "' class='tramite-bttn'  onclick='myFunction(" + item.idTRAMITE + ")'>Realizar</a>";
        }
        cell4.innerHTML = "<a class='tramite-bttn' href='http://asadacr.000webhostapp.com/" + item.plantilla + "'>Descargar</a>";
     });
     if(data.length === 0){
       table.innerHTML = "<div class='texto-descripcion'>Esta ASADA no tiene formularios disponibles.</div>";
      }
     },
      error: function (data){
          console.log(data.responseText);
          alert("Ha ocurrido un error.");
      }
  });

  /*
  $.getJSON("../php/seleccionartramite.php",function(data){
    $.each(data,function(index,item)
    {
     var row = table.insertRow(1);
     var cell1 = row.insertCell(0);
     var cell2 = row.insertCell(1);
     var cell3 = row.insertCell(2);
     var cell4 = row.insertCell(3);

     cell1.innerHTML = item.nombre;
     cell2.innerHTML = item.descripcion;
     if(item.idTRAMITE==0){
        cell3.innerHTML = "<a name='editar' id='0' class='tramite-bttn' onclick='myFunction(0)' href='http://asadacr.000webhostapp.com/solicitudAsada.html'>Realizar</a>";
     }
     else if(item.idTRAMITE==1){
        cell3.innerHTML = "<a name='editar' id='1' class='tramite-bttn' onclick='myFunction(1)' href='http://asadacr.000webhostapp.com/llenartramite_sol.html'>Realizar</a>";
     }
     else if(item.idTRAMITE==2){
        cell3.innerHTML = "<a name='editar' id='2' class='tramite-bttn' onclick='myFunction(2)' href='http://asadacr.000webhostapp.com/llenartramite_disp.html'>Realizar</a>";
     }
     else if(item.idTRAMITE==8){
        cell3.innerHTML = "<a name='editar' id='8' class='tramite-bttn' onclick='myFunction(8)' href='http://asadacr.000webhostapp.com/llenartramite_ave.html'>Realizar</a>";
     }
     else{
        cell3.innerHTML = "<a name='editar' id='" + item.idTRAMITE + "' class='tramite-bttn'  onclick='myFunction(" + item.idTRAMITE + ")'>Realizar</a>";
     }
     cell4.innerHTML = "<a class='tramite-bttn' href='http://asadacr.000webhostapp.com/" + item.plantilla + "'>Descargar</a>";
  });
  if(data.length === 0){
    table.innerHTML = "<div class='texto-descripcion'>Esta ASADA no tiene formularios disponibles.</div>";
   }
});
  */

});
