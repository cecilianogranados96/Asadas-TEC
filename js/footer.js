$(document).ready(function(){
  
    var mainFooter = document.getElementById("mainFooter");
    mainFooter.innerHTML += "<div id='footerASADA' class='footer-left'>" +
                                "<h3>ASADAS inscritas</h3>" +
                            "</div>" +
                            "<div id='footerContacto' class='footer-right'>" +
                            "</div>" +
                            "<div class='footer-bottom' id='footerBottom'>" +
                                "<div> Tecnológico de Costa Rica ® " + (new Date()).getFullYear() + "</div>" +
                            "</div>";
    
    var table = document.getElementById("footerASADA");
    $.getJSON("php/getASADAS.php",function(data){
        $.each(data,function(index,item) 
        {
            table.innerHTML += "<div><a>" + item.nombre + "</a></div>";
        });
    });

    var tableContacto = document.getElementById("footerContacto");
    $.getJSON("php/getContacto.php",function(data){
        if(data.length == 1 && data[0].value == null){
            tableContacto.innerHTML += "<h3>Contacto</h3>";
            $.each(data,function(index,item)
            {
                 tableContacto.innerHTML += "<div><a>Teléfono: +506 " + item.telefono + "</a></div>";
                 tableContacto.innerHTML += "<div><a>Correo electrónico: " + item.correo + "</a></div>";
            });
        }
    });
    
});