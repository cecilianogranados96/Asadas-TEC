var provincia = "";
var canton = "";
var distrito = "";
  
$(document).ready(function(){
    
    if (getCookie("tipoUsuario") != 1){
        history.go(-1);
    }
    
  var items="";
  var items2="";
  var items3="";
    
    $.ajax({
       url : "php/adm_functions.php", // the resource where youre request will go throw
       type : "POST", // HTTP verb
       data : { action: 'getModificarFontanero' },
       dataType: "json",
       success: function(data){
        $.each(data,function(index,item) {
         document.getElementById("nombre").value = item.nombre;
         document.getElementById("primerApellido").value = item.primerApellido;
         document.getElementById("segundoApellido").value = item.segundoApellido;
         document.getElementById("correo").value = item.correo;
         document.getElementById("contrasena").value = item.contrasena;
         document.getElementById("cedula").value = item.cedula;
         provincia = item.provincia;
         canton = item.canton;
         distrito = item.distrito;
        });
       },
        error: function (data){
            console.log(data.responseText);
            alert("Ha ocurrido un error.");
        }
    });
  
    /*
  $.getJSON("php/adm_modificarFontanero.php",function(data){
    $.each(data,function(index,item) 
    {
     document.getElementById("nombre").value = item.nombre;
     document.getElementById("primerApellido").value = item.primerApellido;
     document.getElementById("segundoApellido").value = item.segundoApellido;
     document.getElementById("correo").value = item.correo;
     document.getElementById("contrasena").value = item.contrasena;
     document.getElementById("cedula").value = item.cedula;
     provincia = item.provincia;
     canton = item.canton;
     distrito = item.distrito;
    });
   });
    */
    
  /*
    alert(provincia + " and provincia is of type" + typeof provinicia);
    $.getJSON("php/getProvincias.php",function(data){

        items+="<option value='0' disabled>Provincia</option>";
        $.each(data,function(index,item) 
        {
          if(item.idPronvicia != provincia){
              items+="<option value='"+item.idProvincia+"'>"+item.nombre+"</option>";
          }
          else{
              alert("id: " + provincia + " nombre provincia: " + item.nombre);
              items+="<option value='"+item.idProvincia+"' selected>"+item.nombre+"</option>";
          }
          
        });
        
         $("#provincia").html(items); 
    });
    
    $.post("php/getCantonesID.php",{provincia1: provincia}, function(data) {
 
        var cantones = JSON.parse(data);
        items2+="<option value='0' disabled>Cantón</option>";
        $.each(cantones,function(index,item) 
        {
            if(item.idCanton != canton){
              items2+="<option value='"+item.idCanton+"'>"+item.nombre+"</option>";
            }
            else{
              alert("id: " + canton + " nombre canton: " + item.nombre);
              items2+="<option value='"+item.idCanton+"' selected>"+item.nombre+"</option>";
            }
        });
        
        $("#canton").html(items2); 
      });
      
      $.post("php/getDistritosID.php",{canton1: canton}, function(data) {
        var distritos = JSON.parse(data);
        alert(distritos);
        items3+="<option value='0' disabled>Distrito</option>";
        $.each(distritos,function(index,item) 
        {
          alert(item.nombre);
          if(item.idDistrito != distrito){
              items3+="<option value='"+item.idDistrito+"'>"+item.nombre+"</option>";
            }
            else{
              items3+="<option value='"+item.idDistrito+"' selected>"+item.nombre+"</option>";
            }
        });
        
        $("#distrito").html(items3); 
      });
   */ 

$("#Guardar").click(function(){
   //alert("estoy entranda");
   var nombre = $("#nombre").val();
   var primerApellido = $("#primerApellido").val();
   var segundoApellido = $("#segundoApellido").val();
   var correo = $("#correo").val();
   var contrasena = $("#contrasena").val();
   var cedula = $("#cedula").val();
   var telefono = $("#telefono").val();
   //var direccionExacta = $("#direccionExacta").val();
   //var distrito = $('#distrito').find(":selected").text();
   //alert("ya asigne las variables");
  /* 
   alert("nombre: " + nombre);
   alert("primerApellido: " + primerApellido);
   alert("segundoApellido: " + segundoApellido);
   alert("correo: " + correo);
   alert("contraseña: " + contrasena);
   alert("cedula: " + cedula);
   alert("telefono: " + telefono);
   alert("direccionExacta: " + direccionExacta);
   alert("distrito: " + distrito);
*/
   
    $.ajax({
       url : "php/adm_functions.php", // the resource where youre request will go throw
       type : "POST", // HTTP verb
       data : { action: 'getModificarFontanero', nombre1: nombre, primerApellido1: primerApellido, segundoApellido1: segundoApellido, correo1: correo, contrasena1: contrasena, telefono1: telefono },
       dataType: "json",
       success: function(data){
           alert("Se ha editado exitosamente");
            location.assign("http://asadacr.000webhostapp.com/adm_fontaneros.html");
        },
        error: function (data){
            console.log(data);
            alert("Se ha editado exitosamente");
        }
    });
    
    /*
  $.post("php/editarFontanero.php",{nombre1: nombre, primerApellido1: primerApellido, segundoApellido1: segundoApellido, correo1: correo, contrasena1: contrasena, telefono1: telefono}, function(data, status) {
   location.assign("http://asadacr.000webhostapp.com/adm_fontaneros.html");
}).fail(function(err, status) {
    alert("El fontanero fue editado de forma exitosa.");
    location.assign("http://asadacr.000webhostapp.com/adm_fontaneros.html");
});
    */

    location.assign("http://asadacr.000webhostapp.com/adm_fontaneros.html");

});
});