$(document).ready(function(){
    
    if (getCookie("tipoUsuario") != 1){
        history.go(-1);
    }
    
  var table = document.getElementById("noticias");
    
    $.ajax({
       url : "../php/adm_functions.php", // the resource where youre request will go throw
       type : "POST", // HTTP verb
       data : { action: 'noticias' },
       dataType: "json",
       success: function(data){
        $.each(data,function(index,item) 
        {
         var row = table.insertRow(1);
         var cell1 = row.insertCell(0);
         var cell2 = row.insertCell(1);
         var cell3 = row.insertCell(2);
         var cell4 = row.insertCell(3);

         var fecha = item.fechaPublicacion;
         cell1.innerHTML = fecha.substr(0, fecha.indexOf(' '));
         cell2.innerHTML = item.titulo;
         cell3.innerHTML = "<a id='editar' name='editar' title='" + item.idNOTICIA + "' class='tramite-bttn'  onclick='myFunction(" + item.idNOTICIA + ")'>Editar</a>";
         cell4.innerHTML = "<a class='tramite-bttn' onclick='borrar(" + item.idNOTICIA + ")'>Eliminar</a>";
        });
        if(data.length === 0){
            table.innerHTML = "<div class='texto-descripcion'>No hay noticias registradas.</div>";
        }
       },
        error: function (data){
            console.log(data.responseText);
            alert("Ha ocurrido un error.");
        }
    });
    
    /*
  $.getJSON("../php/adm_noticias.php",function(data){
    $.each(data,function(index,item) 
    {
     var row = table.insertRow(1);
     var cell1 = row.insertCell(0);
     var cell2 = row.insertCell(1);
     var cell3 = row.insertCell(2);
     var cell4 = row.insertCell(3);

     var fecha = item.fechaPublicacion;
     cell1.innerHTML = fecha.substr(0, fecha.indexOf(' '));
     cell2.innerHTML = item.titulo;
     cell3.innerHTML = "<a id='editar' name='editar' title='" + item.idNOTICIA + "' class='tramite-bttn'  onclick='myFunction(" + item.idNOTICIA + ")'>Editar</a>";
     cell4.innerHTML = "<a class='tramite-bttn' onclick='borrar(" + item.idNOTICIA + ")'>Eliminar</a>";
  });
  if(data.length === 0){
    table.innerHTML = "<div class='texto-descripcion'>No hay noticias registradas.</div>";
  }
});
    */
});