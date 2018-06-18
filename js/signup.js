$(document).ready(function(){
  //alert("play");
  var items="";
  
  $.getJSON("../php/getProvincias.php",function(data){

items+="<option value='0' disabled>Provincia</option>";
    $.each(data,function(index,item) 
    {
      items+="<option value='"+item.idProvincia+"'>"+item.nombre+"</option>";
    });

    $("#provincia").html(items); 
  });

  $.getJSON("../php/getASADAS.php",function(data){
    $.each(data,function(index,item) 
    {
      checklist+="<option value='"+item.idProvincia+"'>"+item.nombre+"</option>";
    });

    $("#provincia").html(items); 
  });

$("#registrarse").click(function(){
   var nombre = $("#nombre").val();
   var primerApellido = $("#primerApellido").val();
   var segundoApellido = $("#segundoApellido").val();
   var password = $("#password").val();
   var email = $("#email").val();
   var cedula = $("#cedula").val();
   var telefono = $("#telefono").val();
   var direccionExacta = $("#direccionExacta").val();

   var provincia = $('#provincia').find(":selected").text();
   var canton = $('#canton').find(":selected").text();
   var distrito = $('#distrito').find(":selected").text();


//alert("nombre: " + nombre+" primer "+primerApellido+" segundo "+ segundoApellido + "pass" + password+ "email:"+email+" cedula "+ cedula + " telefono " + telefono +" distrito "+distrito + " dirección "+direccionExacta);

if (nombre === '')
{
  alert("Datos incompletos.");
}

else
{
  $.post("../php/signup.php",{nombre1: nombre, primerApellido1: primerApellido, segundoApellido1: segundoApellido, password1:password, email1: email, cedula1: cedula,telefono1:telefono, distrito1:distrito, direccionExacta1: direccionExacta },
  function(data)
  {
    //alert("uprising");
    //alert(data);
    if (data == 'no')
    {
        alert("No se pudo registrar al usuario. Revise sus datos.");
    }
    else if (data == 'si')
    {
        alert("Usuario registrado exitosamente.");
        //alert(email);
        setCookie("usuario", email, 1);
        setCookie("tipoUsuario", 0, 1);
        location.assign("http://asadacr.000webhostapp.com/index.html");
    }
    else
    {
        alert("El usuario no pudo ser creado. Revise sus datos.");
    }
    });
    //alert("no problems");
    location.assign("http://asadacr.000webhostapp.com/index.html");
}


});
});