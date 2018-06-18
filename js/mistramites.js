$(document).ready(function(){

  if (getCookie("tipoUsuario") != 0){
    history.go(-1);
  }

  var usuario = getCookie("usuario");
  document.getElementById('usuarioConectado').innerHTML = usuario;
  var nombreASADA = getCookie("nombreASADA");
  nombreASADA = nombreASADA.replace(/\+/g,' ');
  setCookie("nombreASADA", nombreASADA, 1);
  document.getElementById('headerASADA').innerHTML = "Está conectado a: " + nombreASADA;

  var table = document.getElementById("tramites");

  $.ajax({
     url : "../php/general_functions.php", // the resource where youre request will go throw
     type : "POST", // HTTP verb
     data : { action: 'mistramites' },
     dataType: "json",
     success: function(data){
       $.each(data,function(index,item)
       {
        var row = table.insertRow(1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);

        cell1.innerHTML = item.idFORMULARIO;
        cell2.innerHTML = item.fecha;
        cell3.innerHTML = item.nombre;
        cell4.innerHTML = item.estado;
        cell5.innerHTML = "<a id='editar' name='editar' title='" + item.idFORMULARIO + "' class='tramite-bttn'  onclick='myFunction(" + item.idFORMULARIO + ")'>Consultar</a>";
      });
      if(data.length === 0){
       table.innerHTML = "<div class='texto-descripcion'>No hay trámites enviados.</div>";
      }
     },
      error: function (data){
          console.log(data.responseText);
          alert("Ha ocurrido un error.");
      }
  });

  /*
  $.getJSON("../php/mistramites.php",function(data){
    $.each(data,function(index,item)
    {
     var row = table.insertRow(1);
     var cell1 = row.insertCell(0);
     var cell2 = row.insertCell(1);
     var cell3 = row.insertCell(2);
     var cell4 = row.insertCell(3);
     var cell5 = row.insertCell(4);

     cell1.innerHTML = item.idFORMULARIO;
     cell2.innerHTML = item.fecha;
     cell3.innerHTML = item.nombre;
     cell4.innerHTML = item.estado;
     cell5.innerHTML = "<a id='editar' name='editar' title='" + item.idFORMULARIO + "' class='tramite-bttn'  onclick='myFunction(" + item.idFORMULARIO + ")'>Consultar</a>";
  });
  if(data.length === 0){
    table.innerHTML = "<div class='texto-descripcion'>No hay trámites enviados.</div>";
   }
});
  */
});
