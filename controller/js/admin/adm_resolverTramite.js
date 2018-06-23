//<span class="form-label">Label numero 1:</span>
//<input type="text" name="">

$(document).ready(function(){
    
    if (getCookie("tipoUsuario") != 1){
        history.go(-1);
    }
    
  var usuario = getCookie("usuario");
  document.getElementById('usuarioConectado').innerHTML = usuario;
  var nombreASADA = getCookie("nombreASADA");
  document.getElementById('headerASADA').innerHTML = "EstÃ¡ conectado a: " + nombreASADA;
  
  var nombre = document.getElementById("nombre");
  $.getJSON("php/getNombreTramite.php",function(data){
    $.each(data,function(index,item) 
    {
        nombre.innerHTML = item.nombre;
    });
  });
  
  var table = document.getElementById("campos");
  
    $.ajax({
       url : "php/adm_functions.php", // the resource where youre request will go throw
       type : "POST", // HTTP verb
       data : { action: 'resolverTramite' },
       dataType: "json",
       success: function(data){
        $.each(data,function(index,item) 
        {
            if(item.idCAMPO === '33'){
                table.innerHTML += "<span class='form-label'>Fontanero que atiende el problema:</span> <select class='form-select' id='fontaneros'> </select>";
            }
            else if(item.idCAMPO === '34'){
                table.innerHTML += "<span class='form-label'>" + item.nombre + "</span>";
                table.innerHTML += "<input type='date' id='" + item.idCAMPO + "'>";
            }
            else if(item.tipoCampo === '1'){
                table.innerHTML += "<span class='form-label'>" + item.nombre + "</span>";
                table.innerHTML += "<input type='text' id='" + item.idCAMPO + "' disabled>";
            }
            else{
                table.innerHTML += "<span class='form-label'>" + item.nombre + "</span>";
                table.innerHTML += "<input type='text' id='" + item.idCAMPO + "'>";
            }
        });
       },
        error: function (data){
            console.log(data.responseText);
            alert("Ha ocurrido un error.");
        }
    });
    
    /*
    $.getJSON("php/adm_resolverTramite.php",function(data){
    $.each(data,function(index,item) 
    {
        if(item.idCAMPO === '33'){
            table.innerHTML += "<span class='form-label'>Fontanero que atiende el problema:</span> <select class='form-select' id='fontaneros'> </select>";
        }
        else if(item.idCAMPO === '34'){
            table.innerHTML += "<span class='form-label'>" + item.nombre + "</span>";
            table.innerHTML += "<input type='date' id='" + item.idCAMPO + "'>";
        }
        else if(item.tipoCampo === '1'){
            table.innerHTML += "<span class='form-label'>" + item.nombre + "</span>";
            table.innerHTML += "<input type='text' id='" + item.idCAMPO + "' disabled>";
        }
        else{
            table.innerHTML += "<span class='form-label'>" + item.nombre + "</span>";
            table.innerHTML += "<input type='text' id='" + item.idCAMPO + "'>";
        }
    });
   });
   */
   
   alert("Campos cargados exitosamente.");
   $.getJSON("php/getCamposTramite.php",function(data){
    $.each(data,function(index,item) 
    {
        var element = document.getElementById(item.idCAMPO);
        element.setAttribute("value", item.valor);
    });
   });
    
    
    $.ajax({
       url : "php/adm_functions.php", // the resource where youre request will go throw
       type : "POST", // HTTP verb
       data : { action: 'fontaneros' },
       dataType: "json",
       success: function(data){
        var fontaneros = "";
        $.each(data,function(index,item) 
        {
            var nombreCompleto = item.nombre + " " + item.primerApellido + " " + item.segundoApellido;

            fontaneros+="<option>"+nombreCompleto+"</option>";
        });
        $("#fontaneros").html(fontaneros); 
       },
        error: function (data){
            console.log(data.responseText);
            alert("Ha ocurrido un error.");
        }
    });
   
    /*
   $.getJSON("php/adm_fontaneros.php",function(data){
    var fontaneros = "";
    $.each(data,function(index,item) 
    {
        var nombreCompleto = item.nombre + " " + item.primerApellido + " " + item.segundoApellido;
        
        fontaneros+="<option>"+nombreCompleto+"</option>";
    });
    $("#fontaneros").html(fontaneros); 
   });
    */
   
   $.getJSON("php/getEstadoTramite.php",function(data){
    $.each(data,function(index,item) 
    {
        document.getElementById("opciones").value = item.estado;
    });
   });
   
   $("#guardar").click(function(){
    var e = document.getElementById("opciones");
    var estado = e.options[e.selectedIndex].value;
    
    var tramite = getCookie("tramite");
    var usuario = getCookie("usuario");
    var input = [];
    var inputid = [];
    
    $('#campos').children().each(function () {
        if(this.disabled === false){
            alert(this.value);
            inputid.push(this.id);
            input.push(this.value);
        }
    });
    
    var valores = input.join(',');
    var ids = inputid.join(',');
    
    
    $.post("php/updateFormulario.php",{tramite1: tramite, usuario1: usuario, valores1: valores, ids1: ids}, function(data) {

    });
    
    $.post("php/updateEstadoTramite.php",{estado1: estado}, function(data, status) {
            alert("TrÃ¡mite guardado de forma exitosa.");
            location.assign("http://asadacr.000webhostapp.com/adm_tramitesPendientes.html");
    }).fail(function(err, status) {
        alert("TrÃ¡mite guardado de forma exitosa.");
        location.assign("http://asadacr.000webhostapp.com/adm_tramitesPendientes.html");
    });
    location.assign("http://asadacr.000webhostapp.com/adm_tramitesPendientes.html");
   });

});