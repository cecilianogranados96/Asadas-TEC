$(document).ready(function(){
    var sidebarMenu = document.getElementById("sidebarMenu");    
    var tipo = getCookie("tipoUsuario");
    if(tipo == '1'){
        
        sidebarMenu.innerHTML += "<a href='adm_tramitesPendientes.html'>Trámites</a>" +
                                "<a href='adm_admins.html'>Administradores</a>" +
                                "<a href='adm_plantillas.html'>Plantillas</a>" +
                                "<a href='adm_fontaneros.html'>Fontaneros</a>" +
                                "<a href='adm_juntaDirectiva.html'>Junta Directiva</a>" +
                                "<a href='adm_estaAsociacion.html'>Esta Asociación</a>" +
                                "<a href='adm_noticias.html'>Administrar Noticias</a>" +
                                "<a href='adm_crearFormulario.html'>Crear Formulario</a>";
        
    }
    else if(tipo == '2'){
        
        sidebarMenu.innerHTML += "<a href='master_tramitesPendientes.html'>Trámites</a>" +
                                 "<a href='master_verFontaneros.html'>Fontaneros</a>" +
                                 "<a href='master_admins.html'>Administradores</a>" +
                                 "<a href='master_crearASADA.html'>Crear ASADA</a>";
    }

    
});