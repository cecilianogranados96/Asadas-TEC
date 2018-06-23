$(document).ready(function(){
    
    if (getCookie("tipoUsuario") != 2){
        history.go(-1);
    }
    
  setCookie("tipo", "a", 1);
  setCookie("estado", "a", 1);
  setCookie("asadaFiltro", "a", 1);
  var usuario = getCookie("usuario");
  document.getElementById('usuarioConectado').innerHTML = usuario;

  
  var selectTramite = document.getElementById("tipo");
  $.getJSON("php/getTramitesNombre.php",function(data){
        $.each(data,function(index,item) 
        {
            var o = document.createElement("option");
            o.setAttribute("value", item.idTRAMITE);
            o.innerHTML = item.nombre;
            selectTramite.appendChild(o);
        });
    });
    
    var estadoTramite = document.getElementById("estado");
  $.getJSON("php/getEstadoSolicitud.php",function(data){
        $.each(data,function(index,item) 
        {
            var o = document.createElement("option");
            o.setAttribute("value", item.idESTADO_SOLICITUD);
            o.innerHTML = item.nombre;
            estadoTramite.appendChild(o);
        });
    });
    
    var selectASADA = document.getElementById("asada");
  $.getJSON("php/getASADAS.php",function(data){
        $.each(data,function(index,item) 
        {
            var o = document.createElement("option");
            o.setAttribute("value", item.idASADA);
            o.innerHTML = item.nombre;
            selectASADA.appendChild(o);
        });
    });
  
  var table = document.getElementById("tramites");
  $.getJSON("php/master_tramitesPendientes.php", function(data){
        $.each(data,function(index,item) 
        {
            var row = table.insertRow(1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            var cell7 = row.insertCell(6);
    
            cell1.innerHTML = item.idFORMULARIO;
            cell2.innerHTML = item.fecha;
            cell3.innerHTML = item.nombre;
            cell4.innerHTML = item.direccion;
            cell5.innerHTML = item.estadoSolicitud;
            cell6.innerHTML = item.asada;
            cell7.innerHTML = "<a class='tramite-bttn' onclick='revisar(" + item.idFORMULARIO + ")'>Revisar</a>";
        });
        if(data.length === 0){
            table.innerHTML = "<div class='texto-descripcion'>No hay trámites registrados.</div>";
        }
    });

    $("#refrescar").click(function(){
        //alert("hey");
        
        var tipo = document.getElementById("tipo");
        var strTipo = tipo.options[tipo.selectedIndex].value;
        setCookie("tipo", strTipo, 1);
        
        var estado = document.getElementById("estado");
        var strEstado = estado.options[estado.selectedIndex].value;
        setCookie("estado", strEstado, 1);
        
        var asada = document.getElementById("asada");
        var strAsada = asada.options[asada.selectedIndex].value;
        setCookie("asadaFiltro", strAsada, 1);
    
       var table = document.getElementById("tramites");
       table.innerHTML = "<tr> <th>Número de trámite</th> <th>Fecha</th> <th>Tipo de trámite</th> <th>Dirección</th> <th>Estado</th> <th>ASADA</th> <th>Ver más</th> </tr>";
       $.getJSON("php/master_tramitesPendientes.php", function(data){
        $.each(data,function(index,item) 
        {
            var row = table.insertRow(1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            var cell7 = row.insertCell(6);
    
            cell1.innerHTML = item.idFORMULARIO;
            cell2.innerHTML = item.fecha;
            cell3.innerHTML = item.nombre;
            cell4.innerHTML = item.direccion;
            cell5.innerHTML = item.estadoSolicitud;
            cell6.innerHTML = item.asada;
            cell7.innerHTML = "<a class='tramite-bttn' onclick='revisar(" + item.idFORMULARIO + ")'>Revisar</a>";
        });
        if(data.length === 0){
            table.innerHTML = "<div class='texto-descripcion'>No hay trámites registrados.</div>";
        }
       });
       
    });
});