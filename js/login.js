$(document).ready(function(){
    
    var cookies = document.cookie.split(";");
    for(var i=0; i < cookies.length; i++) {
        var equals = cookies[i].indexOf("=");
        var name = equals > -1 ? cookies[i].substr(0, equals) : cookies[i];
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    }
    
    /*
    var table = document.getElementById("asadas");
    $.getJSON("../php/asadas.php",function(data){
        $.each(data,function(index,item) 
        {
        table.innerHTML += "<div><a>"+item.nombre+"</a></div>";

      });
    });
    */

    $("#login").click(function(){
    var email = $("#email").val();
    var password = $("#password").val();
    // Checking for blank fields.
    if( email === '' || password === '')
    {
        $('input[type="text"],input[type="password"]').css("border","2px solid red");
        $('input[type="text"],input[type="password"]').css("box-shadow","0 0 3px red");
    } else {
        
        
        $.post("../php/login.php",{ email1: email, password1:password},
        function(data) {
            if(data=='inv'){
                alert("Ingreso inválido.");
            }else if(data =='no'){
                alert("Usuario o contraseña incorrecta.");
            } else if(data=='si'){
                setCookie("usuario", email, 1);
                var tipo = getCookie("tipoUsuario");
                if(tipo == '0'){
                    location.assign("http://asadacr.000webhostapp.com/selectasada.html");
                }
                else if(tipo == '1'){
                    location.assign("http://asadacr.000webhostapp.com/adm_inicio.html");
                }
                else if(tipo == '2'){
                    location.assign("http://asadacr.000webhostapp.com/master-inicio.html");
                }
                else{
                    alert("Tipo incorrecto.");
                }
            }
        });
    }
    });
});