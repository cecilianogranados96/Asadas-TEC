<?php 

session_start();

include "config.php";
include "controller/funciones.php";
if (file_exists("view/header.php")) {
    include "view/header.php";
}
if (file_exists("controller/header.php")) {
    include "controller/header.php";
}
if(isset($_GET['pag'])){
    if (file_exists("controller/".$_GET['pag'].".php")) {
       include "controller/".$_GET['pag'].".php";
    }
    if (file_exists("view/".$_GET['pag'].".php")) {
       include "view/".$_GET['pag'].".php";
    }else{
        include "view/general/inicio.php";
    }  
}else{
    include "view/general/inicio.php";    
}
if (file_exists("view/fotter.php")) {
    if(isset($_GET['pag'])){
        if($_GET['pag'] != 'general/test' and $_GET['pag'] != 'general/nuevo_pass')
            include "view/fotter.php";
    }else{
        include "view/fotter.php";
    }
}
?>
