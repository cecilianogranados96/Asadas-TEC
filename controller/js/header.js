$(document).ready(function(){
    var mainHeader = document.getElementById("mainHeader");
    var headerMenu;
    var tipo = getCookie("tipoUsuario");
    var usuario = getCookie("usuario");
    var nombreASADA = getCookie("nombreASADA");
    
    //Agrega la base del header
    mainHeader.innerHTML += "<div class='header-logo'></div>" +
                            "<div class='header-right'>" +
                                "<div id='descripcionUsuario' class='header-top'>" +
                                    "<div class='header-top-logo'>" +
                                        "<span id='headerASADA' name='headerASADA' class='header-top-nombreasada'>Está conectado a:</span>" +
                                    "</div>" +
                                    "<div class='header-top-usuario'>" +
                                        "<div class='header-icono'><img class='icono-usuario' src='images/icono_usuario.png'></div>" +
                                        "<div id='nav' class='header-icono-texto'>" +
                                            "<ul>" +
                                                "<li> <a id='usuarioConectado' name='usuarioConectado' href='#'>xxxx@xxxxx.com</a>" +
                                                    "<ul id='opcionesUsuario'>" +
                                                    "<li><a href='index.html'>Cerrar sesión</a></li>" +
                                                    "</ul>" +
                                                "</li>" +
                                            "</ul>" +
                                        "</div>" +
                                    "</div>" +
                                "</div>" +
                                "<div class='header-bottom' id='headerMenu'>" +
                                "</div>" +
                            "</div>";
    
    //Obtiene el menu insertado en el header
    headerMenu = document.getElementById("headerMenu");
    
    //Si estoy en el login, registro o informacion de asadas
    if(window.location.pathname == '/index.html' || window.location.pathname == '/asadas.html' ||
       window.location.pathname == '/signup.html' || window.location.pathname == '/'){ //Login
        //Borro la informacion supersior sobre el ususario conectado
        document.getElementById("descripcionUsuario").innerHTML = "";
        //Inserto las opciones de menu
        headerMenu.innerHTML += "<a class='header-bttn' href='index.html'>Inicio</a>" +
			                    "<a class='header-bttn' href='asadas.html'>Nuestros Usuarios</a>"
    }
    
    else if(window.location.pathname == '/selectasada.html'){
        document.getElementById("descripcionUsuario").innerHTML = "";
    }
    
    else if(tipo == '1'){ //Admins
        
        //Inserto las opciones de menu
        headerMenu.innerHTML += "<a class='header-bttn' href='adm_inicio.html'>Inicio</a>" +
                                "<a class='header-bttn' href='adm_verNoticias.html'>Noticias</a>" +
                                "<a class='header-bttn' href='sobreasada_admin.html'>Sobre Nosotros</a>" +
                                "<a class='header-bttn' href='contacto.html'>Contáctenos</a>"        
    }
    else if(tipo == '2'){ //Master
        
        //Inserto la opcion de menu
        headerMenu.innerHTML += "<a class='header-bttn' href='master-inicio.html'>Inicio</a>";
    }
    
    else if(tipo == '0'){ //Cliente
        
        //Inserto la opcion de ver mis tramites
        document.getElementById("opcionesUsuario").innerHTML += "<li><a href='mistramites.html'>Mis trámites</a></li>";
        //Inserto las opciones de menu
        headerMenu.innerHTML += "<a class='header-bttn' href='iniciocliente.html'>Inicio</a>" +
                                "<a class='header-bttn' href='seleccionartramite.html'>Trámites</a>" +
                                "<a class='header-bttn' href='noticias.html'>Noticias</a>" +
                                "<a class='header-bttn' href='sobreasada.html'>Sobre Nosotros</a>" +
                                "<a class='header-bttn' href='contactoCliente.html'>Contáctenos</a>"        
    }
    
});