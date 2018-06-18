$(document).ready(function(){

  var items="";
  
  $.getJSON("../php/getProvincias.php",function(data){

items+="<option value='0' disable selected>Provincia</option>";
    $.each(data,function(index,item) 
    {
      items+="<option value='"+item.idProvincia+"'>"+item.nombre+"</option>";
    });

    $("#provincia").html(items); 
  });


        $("#guardarAsada").click(function(){

            var nombre = $("#nombre").val();
            var cedulaJur = $("#cedulaJuridica").val();
            var telefono =  $("#telefono").val();
            var fecha = $("#fechaFundacion").val();	            
            var provincia = $('#provincia').find(":selected").val();
            var canton = $('#canton').find(":selected").val();
            var distrito = $('#distrito').find(":selected").val();
            var historia = $("#historia").val(); 
            var mision = $("#mision").val();
            var vision = $("#vision").val();
            var horario = $("#horario").val();

            var logo = $("#logo").val();
            logo =  logo.replace(/^.*\\/, "");


            // Checking for blank fields.
            if( nombre == "" || cedulaJur == "" || telefono == "" || fecha == "" || provincia == "" || canton == "" || distrito == "" || historia == "" || mision  == "" || vision  == "" || logo  == "" || horario == "")
            {
                alert("Uno de los campos está vacío.");

            } else {
                $.post("../php/registrarASADA.php",{nombre1:nombre, cedulaJur1:cedulaJur, telefono1:telefono, fecha1:fecha, provincia1:provincia, canton1:canton, distrito1:distrito, historia1:historia, mision1:mision, vision1:vision , logo1:logo, horario1:horario}, function(data) {


              
                });
            }
        });
});

function submitForm() {
            alert("starting");
            console.log("submit event");
            var fd = new FormData(document.getElementById("fileinfo"));
            fd.append("label", "WEBUPLOAD");
            $.ajax({
              url: "../php/upload.php",
              type: "POST",
              data: fd,
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
            }).done(function( data ) {
                alert("done");
                console.log("PHP Output:");
                console.log( data );
                result = data;
                alert(result);
            });
            alert("officially done");
            location.assign("http://asadacr.000webhostapp.com/adm_noticias.html");
            return false;
}