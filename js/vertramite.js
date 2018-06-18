//<span class="form-label">Label numero 1:</span>
//<input type="text" name="">

$(document).ready(function(){
  var usuario = getCookie("usuario");
  document.getElementById('usuarioConectado').innerHTML = usuario;
  var nombreASADA = getCookie("nombreASADA");
  document.getElementById('headerASADA').innerHTML = "Está conectado a: " + nombreASADA;
  
  var nombre = document.getElementById("nombre");
  $.getJSON("../php/getNombreTramite.php",function(data){
    $.each(data,function(index,item) 
    {
        nombre.innerHTML = item.nombre;
    });
  });
  
  var table = document.getElementById("campos");
  $.getJSON("../php/adm_resolverTramite.php",function(data){
    $.each(data,function(index,item) 
    {
        if(item.tipoCampo === '1'){
            table.innerHTML += "<span value='" + item.nombre + "' class='form-label'>" + item.nombre + "</span>";
            table.innerHTML += "<input type='text' id='" + item.idCAMPO + "' disabled>";
        }
        else{
            table.innerHTML += "<span value='" + item.nombre + "' class='form-label'>" + item.nombre + "</span>";
            table.innerHTML += "<input type='text' id='" + item.idCAMPO + "' disabled>";
        }
    });
   });
   alert("Campos cargados exitosamente.");
   $.getJSON("../php/getCamposTramite.php",function(data){
    $.each(data,function(index,item) 
    {
        var element = document.getElementById(item.idCAMPO);
        element.setAttribute("value", item.valor);
    });
   });
   
   $.getJSON("../php/getEstadoTramite.php",function(data){
    $.each(data,function(index,item) 
    {
        table.innerHTML += "<span class='form-label'>Estado de la solicitud</span>";
        table.innerHTML += "<input type='text' value='" + item.nombre + "' disabled>";
    });
   });
   
   $("#guardar").click(function(){
        var nombreASADA = getCookie("nombreASADA");    
        var doc = new jsPDF();
        var x = 25;
        
        doc.setFontSize(30);
        doc.text(15, 25, nombreASADA);
        x = x + 15;
        
        doc.setTextColor(150);
        doc.setFontSize(20);
        doc.text(15, x, document.getElementById("nombre").innerHTML);
        x = x + 10;
        
        doc.setTextColor(150);
        doc.setFontSize(13);
        doc.text(15, x, "Número de trámite:");
        x = x + 6;
                
        doc.setTextColor(1);
        doc.text(15, x, getCookie("tramite"));
        x = x + 10;
        
        $('#campos').children().each(function(){
            if(this.tagName == "SPAN"){
                doc.setTextColor(150);
                doc.setFontSize(13);
                doc.text(15, x, this.innerHTML + ":");
                x = x + 6;
            }
            else if(this.tagName == "INPUT"){
                doc.setTextColor(1);
                doc.text(15, x, this.value);
                x = x + 10;
            }
        });
        
        $.getJSON("../php/getFechaTramite.php",function(data){
            $.each(data,function(index,item) 
            {
                doc.setTextColor(150);
                doc.setFontSize(13);
                doc.text(15, x, "Fecha del trámite:");
                x = x + 6;
                
                doc.setTextColor(1);
                doc.text(15, x, item.fecha);
                x = x + 10;
                
                var usuario = getCookie("usuario");
                var nombreArchivo = usuario + " - " + document.getElementById("nombre").innerHTML + " - ID #" + getCookie("tramite") + ".pdf";
                
                doc.save(nombreArchivo);
                alert("Archivo generado exitosamente");
            });
        });
        
        
   });

});