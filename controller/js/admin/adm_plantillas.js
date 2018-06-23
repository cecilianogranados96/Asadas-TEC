$(document).ready(function(){
    
    if (getCookie("tipoUsuario") != 1){
        history.go(-1);
    }
    
  var usuario = getCookie("usuario");
  document.getElementById('usuarioConectado').innerHTML = usuario;
  var nombreASADA = getCookie("nombreASADA");
  document.getElementById('headerASADA').innerHTML = "Está conectado a: " + nombreASADA;

  var table = document.getElementById("plantillas");
    
    $.ajax({
       url : "php/adm_functions.php", // the resource where youre request will go throw
       type : "POST", // HTTP verb
       data : { action: 'plantillas' },
       dataType: "json",
       success: function(data){
        $.each(data,function(index,item) 
            {
             var row = table.insertRow(1);
             var cell1 = row.insertCell(0);
             var cell2 = row.insertCell(1);
             var cell3 = row.insertCell(2);

             cell1.innerHTML = item.nombre;
             cell2.innerHTML = "<a class='tramite-bttn' onclick='subir(" + item.idTRAMITE + ")'>Subir plantilla</a>";
             cell3.innerHTML = "<a class='tramite-bttn' href='http://asadacr.000webhostapp.com/" + item.plantilla + "'>Ver plantilla</a>";
          });
        if(data.length === 0){
            table.innerHTML = "<div class='texto-descripcion'>No hay formularios registrados.</div>";
        }
       },
        error: function (data){
            console.log(data.responseText);
            alert("Ha ocurrido un error.");
        }
    });
    
    /*
  $.getJSON("php/adm_plantillas.php",function(data){
    $.each(data,function(index,item) 
    {
     var row = table.insertRow(1);
     var cell1 = row.insertCell(0);
     var cell2 = row.insertCell(1);
     var cell3 = row.insertCell(2);

     cell1.innerHTML = item.nombre;
     cell2.innerHTML = "<a class='tramite-bttn' onclick='subir(" + item.idTRAMITE + ")'>Subir plantilla</a>";
     cell3.innerHTML = "<a class='tramite-bttn' href='http://asadacr.000webhostapp.com/" + item.plantilla + "'>Ver plantilla</a>";
  });
    if(data.length === 0){
        table.innerHTML = "<div class='texto-descripcion'>No hay formularios registrados.</div>";
    }
});
    */
});