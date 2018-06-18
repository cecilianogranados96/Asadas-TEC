$(document).ready(function(){
  var usuario = getCookie("usuario");
  document.getElementById('usuarioConectado').innerHTML = usuario;
  var nombreASADA = getCookie("nombreASADA");
  document.getElementById('headerASADA').innerHTML = "Está conectado a: " + nombreASADA;

  var table = document.getElementById("contacto");
    
    /*
  $.getJSON("../php/contacto.php",function(data){
    $.each(data,function(index,item) 
    {
    table.innerHTML = "<tr> <th scope='row'>Teléfono</th> <td>" + item.telefono + "</td> </tr> <tr> <th scope='row'>Correo electrónico</th> <td>" + item.correo + "</td> </tr> <tr> <th scope='row'>Horario de oficinas</th><td>" 
+ item.horario + "</td> </tr>";

   var facebook = document.getElementById("facebook");
   facebook.href = item.link;

    });
  });
    */
    
    $.ajax({
       url : "../php/adm_functions.php", // the resource where youre request will go throw
       type : "POST", // HTTP verb
       data : { action: 'contacto' },
       dataType: "json",
       success: function(data){
        $.each(data,function(index,item) 
        {
            table.innerHTML = "<tr> <th scope='row'>Teléfono</th> <td>" + item.telefono + "</td> </tr> <tr> <th scope='row'>Correo electrónico</th> <td>" + item.correo + "</td> </tr> <tr> <th scope='row'>Horario de oficinas</th><td>" + item.horario + "</td> </tr>";

           var facebook = document.getElementById("facebook");
           facebook.href = item.link;
        });
       },
        error: function (data){
            console.log(data.responseText);
            alert("Ha ocurrido un error.");
        }
    });
    
});